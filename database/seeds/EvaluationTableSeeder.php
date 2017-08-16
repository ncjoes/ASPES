<?php

use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\Exercise;
use App\Models\Factor;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class EvaluationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var Collection $exercises
         */
        $exercises = Exercise::all();

        /**
         * @var Exercise $exercise
         */
        foreach ($exercises as $exercise) {
            /**
             * @var Collection $eEvaluators
             */
            $eEvaluators = $exercise->evaluators;

            /**
             * @var Collection $courseFactors
             */
            $courseFactors = $exercise->courseFactors;

            /**
             * @var Collection $instructorFactors
             */
            $instructorFactors = $exercise->instructorFactors;

            /**
             * @var Collection $subjects
             */
            $subjects = $exercise->subjects;
            $sN = $subjects->count();

            /**
             * @var Collection $courseComments
             */
            $courseComments = $exercise->courseComments;

            /**
             * @var Collection $instructorComments
             */
            $instructorComments = $exercise->instructorComments;

            /**
             * @var Evaluator $evaluator
             */
            foreach ($eEvaluators as $evaluator) {

                /**
                 * @var Subject $subject
                 */
                foreach ($subjects->random($sN > 2 ? $sN - 1 : $sN) as $subject) {

                    /**
                     * @var Factor $factor
                     */
                    foreach ($courseFactors as $factor) {
                        factory(Evaluation::class)->create([
                            'evaluator_id' => $evaluator->id,
                            'subject_id'   => $subject->id,
                            'factor_id'    => $factor->id,
                            'comment_id'   => $courseComments->random()->id,
                        ]);
                    }

                    /**
                     * @var Factor $factor
                     */
                    foreach ($instructorFactors as $factor) {
                        factory(Evaluation::class)->create([
                            'evaluator_id' => $evaluator->id,
                            'subject_id'   => $subject->id,
                            'factor_id'    => $factor->id,
                            'comment_id'   => $instructorComments->random()->id,
                        ]);
                    }
                }
            }
        }
    }
}
