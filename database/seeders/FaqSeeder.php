<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'question' => 'How much do you charge per question',
                'answer' => 'Our prices are curated to be fair for every student. We therefore charge questions based on the requirements. The higher the pages and the more urgent the task, the higher the price.'
            ]
        ];

        foreach ($data as $datum) {
            if(!\App\Models\Faq::where('question', $datum['question'])->exists())
                \App\Models\Faq::create($datum);
        }
    }
}
