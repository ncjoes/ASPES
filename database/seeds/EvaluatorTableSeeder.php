<?php

use App\Models\Evaluator;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Database\Seeder;

class EvaluatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = Exercise::all();
        $u = User::all();

        foreach ($exercises as $exercise) {
            $users = $u->random(8);
            foreach ($users as $user) {
                factory(Evaluator::class)->create([
                    'exercise_id' => $exercise->id,
                    'user_id'     => $user->id,
                    'type'        => Evaluator::DECISION_MAKER,
                ]);
            }

            $users = $u->random(20);
            foreach ($users as $user) {
                factory(Evaluator::class)->create([
                    'exercise_id' => $exercise->id,
                    'user_id'     => $user->id,
                    'type'        => Evaluator::EVALUATOR,
                ]);
            }

        }
    }
}
