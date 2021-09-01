<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
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
        $user = User::create([
            'name' => 'Edin Vllaqo',
            'email' => 'edin.vllaco@gmail.com',
            'password' => bcrypt('edinedin'),
            'profile_photo_path' => 'https://ui-avatars.com/api/?name=Edin Vllaqo&color=7F9CF5&background=EBF4FF'
        ]);

        UserProfile::create([
            'desire_score' => '60',
            'exam_date' => '2021-09-01',
            'first_time' => '15:10:34',
            'second_time' => '17:10:34',
            'phone' => '045254619',
            'user_id' => $user->id
        ]);
    }
}
