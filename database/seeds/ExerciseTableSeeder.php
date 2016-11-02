<?php

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Exercise::class)->create([
            'title'=>'Best Database Lecturer of the Decade'
        ]);
    }
}
