<?php

use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\FCV;

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
            factory(FCV::class, 5)->create([
                'exercise_id' => $exercise->id
            ]);
        }
    }
}
