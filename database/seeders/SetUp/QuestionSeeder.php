<?php

namespace Database\Seeders\SetUp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exams\Question;
use App\Models\Exams\Subject;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $subjects = Subject::all();
        //$years = collect(["1996","1997","1998","1999","2000","2001","2002","2003","2004","2005","2006","2007"])->shuffle();
        $years = collect(["1996"])->shuffle();
        for($i = 0; $subjects->count() > $i; $i++){
            $subject = ($subjects->toArray())[$i];
            $subject_model = Subject::find($subject['id']);
            $questions_id = [];
            for($b = 0; rand(1,$years->count()) > $b; $b++ ){
                $year = ($years->toArray())[$b];
                for($a = 0; $a < 2; $a++){
                    $staff = rand(1,1);
                    $q = Question::factory()->create(['created_by' => $staff, 'year' => $year, 'number' => $a+1]);
                    array_push($questions_id, $q->id);                       
                }
            }
            
           // dd($questions_id);
            $subject_model->questions()->sync($questions_id);
            
        }
        
    }
}
