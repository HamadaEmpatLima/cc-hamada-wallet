<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'              => 'Hamada Ananta Burhanuddin',
                'email'             => 'hamada.undetected@gmail.com',
                'password'          => bcrypt('12345678'),
                'email_verified_at' => now()
            ]
        ];

        for ($i = 0; $i < count($users); $i++) {
            User::updateOrCreate([
                'id' => $i + 1
            ], [
                'name'              => $users[$i]['name'],
                'email'             => $users[$i]['email'],
                'password'          => $users[$i]['password'],
                'email_verified_at' => $users[$i]['email_verified_at'],
            ]);
        }

        Team::updateOrCreate([
            'id' => 1
        ],[
            'user_id'       => 1,
            'name'          => "Hamada's Team",
            'personal_team' => 1
        ]);
    }
}
