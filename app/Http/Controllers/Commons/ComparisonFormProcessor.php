<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/21/2016
 * Time:    3:23 AM
 **/

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Core\ExerciseController;
use App\Models\Evaluator;
use App\Models\Exercise;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;

trait ComparisonFormProcessor
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function processComparisonForm(Request $request)
    {
        /**
         * @var Exercise $exercise
         */
        $exercise = Exercise::find($request->input('exercise-id'));
        $comparisons = $request->input('comparisons');

        if (is_object($exercise) and is_array($comparisons)) {
            /**
             * @var User $user
             */
            $user = $request->user();

            /**
             * @var Invitation $invitation
             */
            $invitation = $user->invitations()->where([
                'exercise_id' => $exercise->id,
                'role' => Invitation::ROLE_DECISION_MAKE,
                'open' => 1
            ])->get();

            if (is_object($invitation)) {
                if (!is_object(
                    $evaluator = Evaluator::where([
                        'exercise_id' => $exercise->id,
                        'user_id' => $user->id,
                        'type' => Evaluator::DECISION_MAKER
                    ])->get()->first())
                ) {
                    $evaluator = Evaluator::create([
                        'exercise_id' => $exercise->id,
                        'user_id' => $user->id,
                        'type' => Evaluator::DECISION_MAKER
                    ]);
                }
                if (ExerciseController::instance()->saveFactorComparisons($evaluator, $comparisons)) {
                    if ($evaluator->hasAcceptableCR(true)) {
                        return ['status' => true, 'message' => 'Saved! Thanks for your wonderful contributions.'];
                    }
                    $evaluator->clearComparisons();

                    return ['status' => false, 'message' => 'Please review your comparisons and try again. They seem not consistent enough.'];
                }
            }

            return ['status' => false, 'message' => 'Access Denied! You are not invited to this exercise.'];
        }

        return ['status' => false, 'message' => 'Data Error!'];
    }
}
