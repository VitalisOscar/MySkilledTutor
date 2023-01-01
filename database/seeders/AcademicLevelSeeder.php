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

        foreach($data as $datum){
            if(!\App\Models\AcademicLevel::where('name', $datum['name'])->exists())
                \App\Models\AcademicLevel::create($datum);
        }
    }
}
