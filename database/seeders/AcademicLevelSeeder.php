<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademicLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'High School'],
            ['name' => 'College'],
            ['name' => 'University'],
            ['name' => 'Masters'],
            ['name' => 'PhD'],
        ];

        \App\Models\AcademicLevel::insert($data);
    }
}
