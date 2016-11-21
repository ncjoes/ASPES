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
            factory(Comment::class)->create([
                'exercise_id' => $exercise->id,
                'value' => 'Excellent',
                'grade' => 100
            ]);

            factory(Comment::class)->create([
                'exercise_id' => $exercise->id,
                'value' => 'Very Good',
                'grade' => 85
            ]);

            factory(Comment::class)->create([
                'exercise_id' => $exercise->id,
                'value' => 'Good',
                'grade' => 70
            ]);

            factory(Comment::class)->create([
                'exercise_id' => $exercise->id,
                'value' => 'Fair',
                'grade' => 55
            ]);

            factory(Comment::class)->create([
                'exercise_id' => $exercise->id,
                'value' => 'Poor',
                'grade' => 40
            ]);
        }
    }
}
