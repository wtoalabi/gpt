<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Exams\Subject;
use App\Models\Exams\Question;


class GenerateQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void {
        $uploadsDirectory = storage_path('uploads');
        $txtFiles = File::files($uploadsDirectory);

        foreach ($txtFiles as $txtFile) {
            if ($txtFile->getExtension() === 'txt') {
                $plainTextContent = File::get($txtFile->getPathname());
                $lines = explode("\n", $plainTextContent);
                dd($lines);

                $year = null;
                $subjectId = null;
                $questions = [];
                $currentQuestion = null;

                foreach ($lines as $line) {
                    if (Str::startsWith($line, 'year:')) {
                        $year = (int) preg_replace('/\D/', '', $line);
                    } elseif (Str::startsWith($line, 'subject_id:')) {
                        $subjectId = (int) preg_replace('/\D/', '', $line);
                    } elseif (preg_match('/^\d+\.\s/', $line)) {
                        if ($currentQuestion !== null) {
                            $questions[] = $currentQuestion;
                        }
                
                        $questionNumber = (int) preg_replace('/\D/', '', $line);
                        $question = preg_replace('/^\d+\.\s/', '', $line);
                
                        $currentQuestion = [
                            'year' => $year,
                            'number' => $questionNumber,
                            'question' => $question,
                            'options' => []
                        ];
                    } elseif (preg_match('/^[A-E]\.\s/', $line)) {
                        if ($currentQuestion !== null) {
                            [$optionKey, $optionValue] = explode('. ', $line, 2);
                            $currentQuestion['options'][$optionKey] = $optionValue;
                        }
                    } elseif (\Str::startsWith($line, 'Follow the instructions')) {
                        if ($currentQuestion !== null) {
                            $currentQuestion['intro'] = $line;
                        }
                    }
                }


                if ($currentQuestion !== null) {
                    $questions[] = $currentQuestion;
                }

                $questionsID = [];
                foreach ($questions as $questionData) {
                    $question = new Question([
                        'year' => $questionData['year'],
                        'created_by' => 1,
                        'number' => $questionData['number'],
                        'question' => $questionData['question'],
                        'options' => json_encode($questionData['options']),
                        'intro' => $questionData['intro'] ?? null
                    ]);
                   // $question->save();

                }

                //$subject = Subject::find($subjectId);
    
               // $subject->questions()->sync($questionsID);

            }
            dd($questions);

        }
    }
}
