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

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = ['title' => 'Admin Dashboard'];

        return iResponse('admin.dashboard', $data);
    }

    public function listExercises()
    {
        return ['title' => 'Fetching exercise list'];
    }

    public function getExerciseInfo()
    {
        return ['title' => 'Fetching exercise information...'];
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
