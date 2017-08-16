<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/21/2016
 * Time:    3:22 AM
 **/

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Core\ExerciseController;
use App\Models\Evaluator;
use App\Models\Exercise;
use App\Models\Invitation;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

trait EvaluationFormProcessor
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function processEvaluationForm(Request $request)
    {
        /**
         * @var Subject $subject
         */
        $subject = Subject::find($request->input('subject-id'));
        $evaluations = $request->input('e');

        if (is_object($subject) and is_array($evaluations)) {
            /**
             * @var Exercise $exercise
             */
            $exercise = $subject->exercise;
            /**
             * @var User $user
             */
            $user = $request->user();

            /**
             * @var Invitation $invitation
             */
            $invitation = $user->invitations()->where(['exercise_id' => $exercise->id, 'role' => Invitation::ROLE_EVALUATOR, 'open' => 1])->get();
            if (is_object($invitation)) {
                if (!is_object(
                    $evaluator = Evaluator::where([
                        'exercise_id' => $exercise->id,
                        'user_id' => $user->id,
                    ])->get()->first())
                ) {
                    $evaluator = Evaluator::create([
                        'exercise_id' => $exercise->id,
                        'user_id' => $user->id,
                    ]);
                }
                ExerciseController::instance()->saveSubjectEvaluation($evaluator, $subject, $evaluations);

                return ['status' => true, 'message' => 'Saved! Thanks for your wonderful contributions.'];
            }

            return ['status' => false, 'message' => 'Access Denied! You were not invited to this exercise.'];
        }

        return ['status' => false, 'message' => 'Data Error!'];
    }

}
