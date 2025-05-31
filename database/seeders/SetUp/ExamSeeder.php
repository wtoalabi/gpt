<?php

namespace Database\Seeders\SetUp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exams\Exam;
use App\Models\Exams\Subject;
use App\Models\Exams\ExamSubject;


class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = collect([
            [
                'id' => 'waec_ssce_internal',
                'name' => 'WAEC',
                'subjects' =>[
                  "COMMERCE", "FINANCIAL ACCOUNTING", "CHRISTIAN RELIGIOUS STUDIES", "ECONOMICS", "GEOGRAPHY", "GOVERNMENT", "ISLAMIC STUDIES", "LITERATURE IN ENGLISH",
                  "CIVIC EDUCATION", "ENGLISH LANGUAGE", "HAUSA", "IGBO", "YORUBA", "FURTHER MATHEMATICS", "GENERAL MATHEMATICS", "AGRICULTURAL SCIENCE",
                  "BIOLOGY", "CHEMISTRY", "PHYSICS"
                ]
            ],
            [
                'id' => 'neco_ssce_internal',
                'name' => 'NECO',
                'subjects' =>[
                    "COMMERCE", "FINANCIAL ACCOUNTING", "CHRISTIAN RELIGIOUS STUDIES", "ECONOMICS", "GEOGRAPHY", "GOVERNMENT", "ISLAMIC STUDIES", "LITERATURE IN ENGLISH",
            "CIVIC EDUCATION", "ENGLISH LANGUAGE", "HAUSA", "IGBO", "YORUBA", "FURTHER MATHEMATICS", "GENERAL MATHEMATICS", "AGRICULTURAL SCIENCE",
            "BIOLOGY", "CHEMISTRY", "PHYSICS"
                        ]

                    ],
                    [
                        'id' => 'waec_ssce_external',
                        'name' => 'WAEC/GCE',
                        'subjects' => ["COMMERCE", "FINANCIAL ACCOUNTING", "CHRISTIAN RELIGIOUS STUDIES", "ECONOMICS", "GEOGRAPHY", "GOVERNMENT", "ISLAMIC STUDIES", "LITERATURE IN ENGLISH",
                        "CIVIC EDUCATION", "ENGLISH LANGUAGE", "HAUSA", "IGBO", "YORUBA", "FURTHER MATHEMATICS", "GENERAL MATHEMATICS", "AGRICULTURAL SCIENCE",
                        "BIOLOGY", "CHEMISTRY", "PHYSICS"]
                    ],
                    [
                        'id' => 'neco_ssce_external',
                        'name' => 'NECO/GCE',
                        'subjects' => [
                            "COMMERCE", "FINANCIAL ACCOUNTING", "CHRISTIAN RELIGIOUS STUDIES", "ECONOMICS", "GEOGRAPHY", "GOVERNMENT", "ISLAMIC STUDIES", "LITERATURE IN ENGLISH",
            "CIVIC EDUCATION", "ENGLISH LANGUAGE", "HAUSA", "IGBO", "YORUBA", "FURTHER MATHEMATICS", "GENERAL MATHEMATICS", "AGRICULTURAL SCIENCE",
            "BIOLOGY", "CHEMISTRY", "PHYSICS"
                ]
            ],
            [
                'id' => 'utme',
                'name' => 'JAMB/UTME',
                'subjects' => [
                    "Agricultural Science", "Arabic", "Art", "Biology", "Chemistry", "Christian Religious Studies", "COMMERCE", "Economics", "French", "Geography",
        "Government", "Hausa", "History", "Home Economics", "Computer Studies","Physical and Health Education",
        "Igbo", "Islamic Studies", "Literature in English", "Mathematics", "Music", "Physics", "Principles of Accounts", "Use of English",
        "Yoruba"
                ]
            ],
            [
                'id' => 'ican',
                'name' => 'ICAN',
                'subjects' => [
                    "Quantitative Techniques in Business",
                    "Business and Finance",
                    "Financial Accounting",
                    "Management Information",
                    "Business Law",
                    "Advanced Audit and Assurance",
                    "Strategic Financial Management",
                    "Advanced Taxation",
                    "Case Study",
                    "Financial Reporting",
                    "Audit and Assurance",
                    "Taxation",
                    "Performance Management",
                    "Public Sector Accounting and Finance",
                    "Management, Governance, and Ethics",
                    "Financial Reporting",
                    "Performance Management",
                    "Public Sector Accounting and Finance",
                    "Management, Governance, and Ethics",
                    "Corporate Reporting",
                    "Advanced Audit and Assurance",
                    "Strategic Financial Management",
                    "Advanced Taxation"
                ]
            ],
            [
                'id' => 'law_school',
                'name' => 'Law School',
                'subjects' => [
                    "Criminal Litigation",
                    "Civil Litigation",
                    "Corporate Law",
                    "Property Law",
                    "Law in Practise"
                ]
            ],
        ]);
        
       /**  ->each(function($e){
           
        
            });
            */
            

            for($i = 0; $exams->count() > $i; $i++){
                $e = ($exams->toArray())[$i];
                $exam = Exam::factory()
                ->create([
                    'name_id' => $e['id'],
                    'name' => $e['name'],
                ]);

                for($ii = 0; count($e['subjects']) > $ii; $ii++  ){
                    $subject = $e['subjects'][$ii];
                    $su = Subject::factory()
                    ->create(['name' => $subject]);
                    ExamSubject::create(['exam_id' => $exam->id,'subject_id' => $su->id]);
                }  
            }
        }
}
