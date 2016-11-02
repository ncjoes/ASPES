<?php

use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\Factor;

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
            factory(Factor::class, rand(5, 8))->create([
                'exercise_id' => $exercise->id
            ]);
        }
    }
}
