<?php

use App\Models\Comparison;
use App\Models\Evaluator;
use App\Models\Exercise;
use App\Models\Factor;
use App\Models\FCV;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class ComparisonTableSeeder extends Seeder
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
         * @var Collection $fcvs
         */
        $fcvs = FCV::all();

        /**
         * @var Exercise $exercise
         */
        foreach ($exercises as $exercise) {
            /**
             * @var Collection $eEvaluators
             */
            $eEvaluators = $exercise->evaluators()->where('type', Evaluator::DM)->get();

            /**
             * @var Collection $eFactors
             */
            $eFactors = $exercise->factors;

            /**
             * @var Evaluator $evaluator
             */
            foreach ($eEvaluators as $evaluator) {

                /**
                 * @var Factor $f1
                 */
                foreach ($eFactors as $f1) {
                    foreach ($eFactors as $f2) {
                        if ($f1->id != $f2->id) {
                            factory(Comparison::class)->create([
                                'f1_id'        => $f1->id,
                                'f2_id'        => $f2->id,
                                'fcv__id'       => $fcvs->random()->id,
                                'evaluator_id' => $evaluator->id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
