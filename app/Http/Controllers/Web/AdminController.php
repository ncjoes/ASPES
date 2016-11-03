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
        $data = $this->getExercises($request);

        return iResponse('admin.exercises', $data);
    }

    public function viewExercise(Request $request)
    {
        if ($request->has('id')) {
            /**
             * @var Exercise $exercise
             */
            if (is_object($exercise = Exercise::find($request->input('id')))) {
                $data = $this->getExercises($request);
                $data = array_merge($data, [
                    'status' => true,
                    'object' => [
                        'id'        => $exercise->id,
                        'main'      => $exercise,
                        'relations' => [
                            'fcvs'       => $exercise->fcvs()->getResults(),
                            'comments'   => $exercise->comments()->getResults(),
                            'factors'    => $exercise->factors()->getResults(),
                            'subjects'   => $exercise->concerned_users(Exercise::ER_SUBJECT)->get(),
                            'evaluators' => $exercise->concerned_users(Exercise::ER_EVALUATOR)->get(),
                        ],
                    ],
                ]);

                return iResponse('admin.view_exercise', $data);
            }
        }

        return abort(404);
    }

    protected function getExercises(Request $request)
    {
        $exercises = Exercise::all()->sortByDesc('id');
        $total = $exercises->count();
        parseListRange($request, $exercises->count(), $from, $to, 200);
        $list = $exercises->take($to - $from + 1); //adding 1 makes the range inclusive

        return ['net_total' => $total, 'list' => $list];
    }

    public function createExercise()
    {
        return ['title' => 'Creating exercise...'];
    }

    public function updateExercise()
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

    public function createUser()
    {
        return ['title' => 'Creating User...'];
    }

    public function updateUser()
    {
        return ['title' => 'Updating users...'];
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
