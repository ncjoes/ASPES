<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['deleted_at'];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const ROLE_ADMIN = 'admin';
    const ROLE_STAFF = 'staff';
    const ROLE_STUDENT = 'student';

    const ER_SUBJECT = 'subjects';
    const ER_EVALUATOR = 'evaluators';

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function sessions()
    {
        return $this->hasMany('App\Models\Session');
    }

    public function exercises($role=self::ER_EVALUATOR)
    {
        return $this->belongsToMany('App\Models\Exercise', $role);
    }

    public function hasRole(Role $role)
    {
        return $this->roles->contains($role);
    }

    public static function getByEmail($email)
    {
        return self::where('email', $email)->first();
    }

    public function names()
    {
        return ($this->first_name." ".$this->middle_name." ".$this->last_name);
    }
}
