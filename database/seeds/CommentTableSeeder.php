<?php

use App\Models\Comment;
use App\Models\Exercise;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
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
            factory(Comment::class, 5)->create([
                'exercise_id' => $exercise->id,
            ]);
        }
    }
}
