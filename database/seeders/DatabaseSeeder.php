<?php

namespace Database\Seeders;

use App\Models\DiagnosticUserTag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TagSeeder::class,
            NewTagsSeeder::class,
            LayerSeeder::class,
            UserSeeder::class,
            DiagnosticSeeder::class,
            DiagnosticUserTagSeeder::class,
            PracticeExamSeeder::class,
        ]);
    }
}
