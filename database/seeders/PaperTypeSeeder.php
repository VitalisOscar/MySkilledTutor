<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaperTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Essay'],
            ['name' => 'Research Paper'],
            ['name' => 'Term Paper'],
            ['name' => 'Coursework'],
            ['name' => 'Book Report'],
            ['name' => 'Book Review'],
            ['name' => 'Movie Review'],
            ['name' => 'Dissertation'],
            ['name' => 'Thesis'],
            ['name' => 'Research Proposal'],
            ['name' => 'Annotated Bibliography'],
            ['name' => 'Case Study'],
            ['name' => 'Article'],
            ['name' => 'Article Critique'],
            ['name' => 'Lab Report'],
            ['name' => 'Speech/Presentation'],
            ['name' => 'Math Problem'],
            ['name' => 'Statistics Project'],
            ['name' => 'Other'],
        ];

        \App\Models\PaperType::insert($data);
    }
}
