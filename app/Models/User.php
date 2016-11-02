<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const ROLE_ADMIN = 'admin';
    const ROLE_ACADEMIA = 'academia';

    const ER_SUBJECT = 'subjects';
    const ER_EVALUATOR = 'evaluators';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /**
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exercises($role=self::ER_EVALUATOR)
    {
        return $this->belongsToMany(Exercise::class, $role);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sent_invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * @return string
     */
    public function names()
    {
        return ($this->first_name." ".$this->middle_name." ".$this->last_name);
    }

    /**
     * @param Role $role
     * @return mixed
     */
    public function hasRole(Role $role)
    {
        return $this->roles->contains($role);
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return in_array($this::ROLE_ADMIN, $this->roles->pluck('name')->all());
    }

    /**
     * @param $email
     * @return mixed
     */
    public static function getByEmail($email)
    {
        return self::where('email', $email);
    }
}
