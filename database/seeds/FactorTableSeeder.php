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

            //Course Factors
            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'This course was well organized',
                'type'        => Factor::TYPE_COURSE,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The textbook, assigned reading and/or class activities for this course improved my knowledge.',
                'type'        => Factor::TYPE_COURSE,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The class assignment related well to the course objectives the grading in this course was fair',
                'type'        => Factor::TYPE_COURSE,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'My understanding of the issues covered greatly improved',
                'type'        => Factor::TYPE_COURSE,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The activities and information presented in the classroom complemented rather than duplicated the assigned readings',
                'type'        => Factor::TYPE_COURSE,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'Taking everything into account, I would recommend this course to another student',
                'type'        => Factor::TYPE_COURSE,
            ]);

            //Instructor Factors
            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor was willing to work with students seeking help.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor is knowledgeable about the subject.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor present and explained material well.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor encouraged participation from the students with question, demonstration or exercises.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor was respectful of students with different background.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor created an environment where students could openly discuss and/or raise questions.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor improved my motivation to do work in this course.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor taught this course as scheduled (ie, attendance).',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'I would recommend this instructor to another student.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'Taking everything into account, the instructor’s teaching was effective.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor relationship with me is satisfactory.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor was available to me when I needed course material classification.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'I am  afraid of expressing my views to this instructor.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'I express my views freely to this instructor.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor sold the book for this course to me.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor wrote the names of students who purchased he/her book.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);

            factory(Factor::class)->create([
                'exercise_id' => $exercise->id,
                'text'        => 'The instructor demanded some forms of gratification form me.',
                'type'        => Factor::TYPE_INSTRUCTOR,
            ]);
        }
    }
}
