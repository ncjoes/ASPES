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
            foreach (range(0, 7) as $value) {
                factory(Comment::class)->create([
                    'exercise_id' => $exercise->id,
                    'value'       => $value,
                    'grade'       => ($value * 10),
                    'type'        => Comment::TYPE_COURSE,
                ]);
            }

            factory(Comment::class)->create([
                'exercise_id' => $exercise->id,
                'value'       => 'Yes',
                'grade'       => 1,
                'type'        => Comment::TYPE_INSTRUCTOR,
            ]);

            factory(Comment::class)->create([
                'exercise_id' => $exercise->id,
                'value'       => 'No',
                'grade'       => 0,
                'type'        => Comment::TYPE_INSTRUCTOR,
            ]);
        }
    }
}
