<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Easy'
        ]);
        Tag::create([
            'name' => 'Medium'
        ]);
        Tag::create([
            'name' => 'Hard'
        ]);
        Tag::create([
            'name' => 'All'
        ]);
    }
}
