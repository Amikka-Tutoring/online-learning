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

    }
}
