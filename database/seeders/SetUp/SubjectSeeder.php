<?php

namespace Database\Seeders\SetUp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exams\Subject;
use App\Models\Exams\Exam;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utme_subjects_ids = [];
       collect([
            "Agricultural Science", "Arabic", "Art", "Biology", "Chemistry", "Christian Religious Studies", "Commerce", "Economics", "French", "Geography",
            "Government", "Hausa", "History", "Home Economics", "Computer Studies","Physical and Health Education",
            "Igbo", "Islamic Studies", "Literature in English", "Mathematics", "Music", "Physics", "Principles of Accounts", "Use of English",
            "Yoruba"
          ])->each(function($s) use(&$utme_subjects_ids){
            $su = Subject::factory()
            ->create(['name' => $s]);
            array_push($utme_subjects_ids, $su->id);
          });

          $e = Exam::where('name_id', 'utme')->first();

          $e->subjects()->sync($utme_subjects_ids);




        $waec_ssce_internal_ids = [];
      collect([
            "COMMERCE", "FINANCIAL ACCOUNTING", "CHRISTIAN RELIGIOUS STUDIES", "ECONOMICS", "GEOGRAPHY", "GOVERNMENT", "ISLAMIC STUDIES", "LITERATURE IN ENGLISH",
            "CIVIC EDUCATION", "ENGLISH LANGUAGE", "HAUSA", "IGBO", "YORUBA", "FURTHER MATHEMATICS", "GENERAL MATHEMATICS", "AGRICULTURAL SCIENCE",
            "BIOLOGY", "CHEMISTRY", "PHYSICS"
          ])->each(function($s) use(&$waec_ssce_internal_ids){
            $su = Subject::factory()
            ->create(['name' => $s]);
            array_push($waec_ssce_internal_ids, $su->id);
          });

          $e = Exam::where('name_id', 'waec_ssce_internal')->first();

          $e->subjects()->sync($waec_ssce_internal_ids);

        
        
    }
}
