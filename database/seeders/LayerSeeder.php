<?php

namespace Database\Seeders;

use App\Models\Layer;
use Illuminate\Database\Seeder;

class LayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Layer::create([
            'name' => 'English Strategy',
        ]);

        $children_1 = Layer::create([
            'name' => 'Concision',
            'parent_id' => $parent->id
        ]);
        $children_2 = Layer::create([
            'name' => 'Transition Words',
            'parent_id' => $parent->id
        ]);

        $grand_children = Layer::create([
            'name' => 'Wordy Phrases',
            'parent_id' => $children_1->id
        ]);
        $grand_children_1 = Layer::create([
            'name' => 'Redundancy',
            'parent_id' => $children_1->id
        ]);
    }
}
