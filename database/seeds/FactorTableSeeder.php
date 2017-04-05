<?php

use App\Models\Exercise;
use App\Models\Factor;
use Illuminate\Database\Seeder;

class FactorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = Exercise::all();
        foreach ($exercises as $exercise) {
            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text' => 'Planning and preparation'
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text' => 'Communication and interaction'
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text' => 'Teaching for learning'
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text' => 'Managing the learning environment'
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text' => 'Student Evaluation'
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text' => 'Professionalism'
            ]);
        }
    }
}
