<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class NewTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Auditory'
        ]);
        Tag::create([
            'name' => 'Visual'
        ]);
        Tag::create([
            'name' => 'Tactile'
        ]);
        Tag::create([
            'name' => 'ISTJ'
        ]);
        Tag::create([
            'name' => 'ISFJ'
        ]);
        Tag::create([
            'name' => 'INFJ'
        ]);
        Tag::create([
            'name' => 'INTJ'
        ]);
        Tag::create([
            'name' => 'ISTP'
        ]);
        Tag::create([
            'name' => 'ISFP'
        ]);
        Tag::create([
            'name' => 'INFP'
        ]);
        Tag::create([
            'name' => 'INTP'
        ]);
        Tag::create([
            'name' => 'ESTP'
        ]);
        Tag::create([
            'name' => 'ESFP'
        ]);
        Tag::create([
            'name' => 'ENTP'
        ]);
        Tag::create([
            'name' => 'ESTJ'
        ]);
        Tag::create([
            'name' => 'ESFJ'
        ]);
        Tag::create([
            'name' => 'ENFJ'
        ]);
        Tag::create([
            'name' => 'ENTJ'
        ]);
        Tag::create([
            'name' => 'ENFP'
        ]);
    }
}
