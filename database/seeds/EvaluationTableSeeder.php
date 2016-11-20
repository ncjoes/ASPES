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
            $eEvaluators = $exercise->evaluators()->where('type', Evaluator::EVALUATOR)->get();

            /**
             * @var Collection $eFactors
             */
            $eFactors = $exercise->factors;

            /**
             * @var Collection $subjects
             */
            $subjects = $exercise->subjects;
            $sN = $subjects->count();

            /**
             * @var Collection $comments
             */
            $comments = $exercise->comments;

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
                    foreach ($eFactors as $factor) {
                        factory(Evaluation::class)->create([
                            'evaluator_id' => $evaluator->id,
                            'subject_id'  => $subject->id,
                            'factor_id'   => $factor->id,
                            'comment_id'  => $comments->random()->id,
                        ]);
                    }
                }
            }
        }
    }
}
