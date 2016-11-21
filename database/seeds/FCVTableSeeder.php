<?php

use App\Models\Exercise;
use App\Models\FCV;
use Illuminate\Database\Seeder;

class FCVTableSeeder extends Seeder
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
            factory(FCV::class)->create([
                'exercise_id' => $exercise->id,
                'name' => 'Just Equal',
                'value' => [1, 1, 1]
            ]);

            factory(FCV::class)->create([
                'exercise_id' => $exercise->id,
                'name' => 'Equally important',
                'value' => [1 / 2, 1, 3 / 2]
            ]);

            factory(FCV::class)->create([
                'exercise_id' => $exercise->id,
                'name' => 'Weakly more important',
                'value' => [1, 3 / 2, 2]
            ]);

            factory(FCV::class)->create([
                'exercise_id' => $exercise->id,
                'name' => 'Strongly more important',
                'value' => [3 / 2, 2, 5 / 2]
            ]);

            factory(FCV::class)->create([
                'exercise_id' => $exercise->id,
                'name' => 'Very strongly more important',
                'value' => [2, 5 / 2, 3]
            ]);

            factory(FCV::class)->create([
                'exercise_id' => $exercise->id,
                'name' => 'Absolutely more important',
                'value' => [5 / 2, 3, 7 / 2]
            ]);
        }
    }
}
