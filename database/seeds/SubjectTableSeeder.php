<?php

use App\Models\Exercise;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = Exercise::all();
        $users = User::all()->random(3);

        foreach ($exercises as $exercise) {
            foreach ($users as $user) {
                factory(Subject::class)->create([
                    'exercise_id' => $exercise->id,
                    'user_id'     => $users->random()->id,
                ]);
            }
        }
    }
}
