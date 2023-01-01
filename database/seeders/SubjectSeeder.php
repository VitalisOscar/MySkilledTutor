<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Accounting'],
            ['name' => 'Agriculture'],
            ['name' => 'Anthropology'],
            ['name' => 'Architecture'],
            ['name' => 'Art'],
            ['name' => 'Astronomy'],
            ['name' => 'Biology'],
            ['name' => 'Business'],
            ['name' => 'Chemistry'],
            ['name' => 'Communications'],
            ['name' => 'Computer Science'],
            ['name' => 'Creative Writing'],
            ['name' => 'Criminology'],
            ['name' => 'Dance'],
            ['name' => 'Economics'],
            ['name' => 'Education'],
            ['name' => 'Engineering'],
            ['name' => 'English'],
            ['name' => 'Environmental Science'],
            ['name' => 'Film'],
            ['name' => 'Finance'],
            ['name' => 'Geography'],
            ['name' => 'Geology'],
            ['name' => 'Health'],
            ['name' => 'History'],
            ['name' => 'Hospitality'],
            ['name' => 'Human Resources'],
            ['name' => 'Information Technology'],
            ['name' => 'International Relations'],
            ['name' => 'Journalism'],
            ['name' => 'Law'],
            ['name' => 'Linguistics'],
            ['name' => 'Literature'],
            ['name' => 'Management'],
            ['name' => 'Marketing'],
            ['name' => 'Mathematics'],
            ['name' => 'Medicine'],
            ['name' => 'Music'],
            ['name' => 'Nursing'],
            ['name' => 'Philosophy'],
            ['name' => 'Physics'],
            ['name' => 'Political Science'],
            ['name' => 'Psychology'],
            ['name' => 'Public Relations'],
            ['name' => 'Religion'],
            ['name' => 'Sociology'],
            ['name' => 'Sports'],
            ['name' => 'Statistics'],
            ['name' => 'Theater'],
            ['name' => 'Tourism'],
            ['name' => 'Other'],
        ];

        foreach($data as $datum){
            if(!\App\Models\Subject::where('name', $datum['name'])->exists())
                \App\Models\Subject::create($datum);
        }
    }
}
