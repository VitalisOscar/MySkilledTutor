<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
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
                'username' => 'admin',
                'email' => 'admin@myskilledtutor.com',
                'password' => Hash::make('password')
            ],
        ];

        foreach ($data as $datum) {
            if(!\App\Models\Admin::where('username', $datum['username'])->exists())
                \App\Models\Admin::create($datum);
        }
    }
}
