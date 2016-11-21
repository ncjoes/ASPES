<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/20/2016
 * Time:    5:15 PM
 **/

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\ExerciseController;
use App\Models\Exercise;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = ['title' => 'Admin Dashboard'];

        return iResponse('admin.dashboard', $data);
    }

    public function listExercises(Request $request)
    {
        $data = ExerciseController::instance()->getExerciseList($request);

        return iResponse('admin.exercises', $data);
    }

    public function viewExercise(Request $request)
    {
        if ($request->has('id')) {
            /**
             * @var Exercise $exercise
             */
            if (is_object($exercise = Exercise::find($request->input('id')))) {
                $data = ExerciseController::instance()->getExerciseList($request);
                $data = array_merge($data, ExerciseController::instance()->getExerciseRelations($exercise));

                return iResponse('admin.view_exercise', $data);
            }
        }

        return abort(404);
    }

    public function editExercise(Request $request)
    {
        if ($request->has('id')) {
            /**
             * @var Exercise $exercise
             */
            if (is_object($exercise = Exercise::find($request->input('id')))) {
                $data = ExerciseController::instance()->getExerciseList($request);
                $data = array_merge($data, ExerciseController::instance()->getExerciseRelations($exercise));

                return iResponse('admin.edit_exercise', $data);
            }
        }

        return abort(404);
    }

    public function saveExercise()
    {
        return ['title' => 'Updating Exercises...'];
    }

    public function deleteExercise()
    {
        return ['title' => 'Deleting exercises...'];
    }

    public function listUsers()
    {
        return ['title' => 'Fetching users list...'];
    }

    public function getUserInfo()
    {
        return ['title' => 'Fetching user information...'];
    }

    public function deleteUser()
    {
        return ['title' => 'Deleting users...'];
    }

    public function settings()
    {
        return ['title' => 'App Settings'];
    }

    public function listNotifications()
    {
        return ['title' => 'Fetching notifications list...'];
    }

    public function getNotificationInfo()
    {
        return ['title' => 'Fetching notification information...'];
    }

    public function updateNotification()
    {
        return ['title' => 'Updating notifications...'];
    }

    public function deleteNotification()
    {
        return ['title' => 'Deleting notifications...'];
    }

}
