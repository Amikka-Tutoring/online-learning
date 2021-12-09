<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use App\Models\UserLessonDate;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;
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
        $role1 = new Role([
            'name' => 'Student',
            'slug' => 'student'
        ]);
        $role1->save();
        $role2 = new Role([
            'name' => 'Tutor',
            'slug' => 'tutor'
        ]);
        $role2->save();
        $role3 = new Role([
            'name' => 'Administrator',
            'slug' => 'admin'
        ]);
        $role3->save();
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'profile_photo_path' => 'https://ui-avatars.com/api/?name=John+Doe&color=7F9CF5&background=EBF4FF',
            'role_id' => $role3->id
        ]);
        $user1 = User::create([
            'name' => 'Student',
            'email' => 'student@email.com',
            'password' => bcrypt('password'),
            'profile_photo_path' => 'https://ui-avatars.com/api/?name=Student&color=7F9CF5&background=EBF4FF',
            'role_id' => $role1->id,
        ]);

//        $profile = UserProfile::create([
//            'desire_score' => '60',
//            'exam_date' => '2021-12-12',
//            'reminder_phone' => '(130) 123-4567',
//            'reminder_email' => 'zohopuli@mailinator.com',
//            'tutor_match' => 'ESTJ',
//            'math_score' => '70',
//            'grammar_score' => '80',
//            'reading_score' => '60',
//            'user_id' => $user->id
//        ]);
//
//        $profile->learning_style = 2;
//        $profile->save();
//
//        UserLessonDate::create([
//            'day' => 'Monday',
//            'time' => '15:48',
//            'user_id' => $user->id
//        ]);
//        UserLessonDate::create([
//            'day' => 'Tuesday',
//            'time' => '15:48',
//            'user_id' => $user->id
//        ]);
//
//        $user->enrollments()->create([
//            'course_id' => 1
//        ]);
//        $user->enrollments()->create([
//            'course_id' => 2
//        ]);
    }
}
