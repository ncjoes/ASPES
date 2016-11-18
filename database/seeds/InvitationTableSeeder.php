<?php

use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\Invitation;

class InvitationTableSeeder extends Seeder
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
            factory(Invitation::class, rand(50, 70))->create([
                'exercise_id' => $exercise->id,
                'sender_id'=> $exercise->creator->id,
                'role'=>Invitation::ROLE_EVALUATOR
            ]);
        }
    }
}
