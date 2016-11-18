<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['slug', 'first_name', 'last_name', 'email', 'phone', 'password'];
    protected $hidden   = ['password', 'remember_token'];
    protected $dates    = ['deleted_at'];

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    const ROLE_ADMIN    = 'admin';
    const ROLE_ACADEMIA = 'academia';

    const ER_SUBJECT   = 'subjects';
    const ER_EVALUATOR = 'evaluators';

    const IMAGE_DIR = 'public/profile-photos';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * @param Role $role
     *
     * @return mixed
     */
    public function hasRole(Role $role)
    {
        return $this->roles->contains($role);
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        $role = Role::where('name', self::ROLE_ADMIN)->first();

        return $this->hasRole($role);
    }

    /**
     * @return mixed
     */
    public function isAcademia()
    {
        $role = Role::where('name', self::ROLE_ACADEMIA)->first();

        return $this->hasRole($role);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function abilities()
    {
        $abilities = collect();
        foreach ($this->roles as $role) {
            $abs = Role::all()->find($role->id)->abilities;
            foreach ($abs as $ab) {
                if (!$abilities->contains($ab->key)) {
                    $abilities->put($ab->key, $ab);
                }
            }
        }

        return $abilities;
    }

    /**
     * @return bool
     */
    public function hasAllAbilities()
    {
        $user_abilities = $this->abilities();
        foreach ($user_abilities as $u_a) {
            if ($u_a->key === '*') {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $ability
     *
     * @return bool
     */
    public function hasAbility($ability)
    {
        foreach ($this->abilities() as $u_a) {
            if ($u_a->key === '*' || strcasecmp($u_a->key, $ability) === 0) {
                return true;
            }
        }

        return false;
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exercises($role = self::ER_EVALUATOR)
    {
        return $this->belongsToMany(Exercise::class, $role);
    }

    /**
     * @param string $role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations($role = 'invited')
    {
        if ($role === 'invited') {
            return $this->hasMany(Invitation::class, 'recipient_id');
        }

        return $this->hasMany(Invitation::class, 'sender_id');
    }

    /**
     * @return string
     */
    public function name()
    {
        $name = $this->first_name.(empty($this->middle_name) ? '' : " {$this->middle_name}")." {$this->last_name}";

        return ucwords($name);
    }

    /**
     * @return string
     */
    public function getSlugAttribute($slug)
    {
        if (!empty($this->attributes['slug']))
            return $this->attributes['slug'];

        return $this->first_name.'.'.$this->last_name;
    }

    public static function makeSlug($names)
    {
        $slug = str_replace('-', '.', str_slug(strtolower($names)));
        if (is_object(self::findBySlug($slug)))
            return $slug.random_int(1, 99);

        return $slug;
    }

    /**
     * @return string
     */
    public function getFirstNameAttribute($first_name)
    {
        return ucwords($first_name);
    }

    /**
     * @return string
     */
    public function getLastNameAttribute($last_name)
    {
        return ucwords($last_name);
    }

    /**
     * @return string
     */
    public function getMiddleNameAttribute($middle_name)
    {
        return ucwords($middle_name);
    }

    /**
     * @return string
     */
    public function getPhotoUrl()
    {
        if ($this->hasPhotoOnLd())
            return normalizeUrl(asset(str_replace('public', 'storage', self::IMAGE_DIR).'/'.$this->photo));
        else
            return $this->photo;
    }

    public function hasPhotoOnLd()
    {
        return !starts_with($this->photo, 'http');
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public static function findByEmail($email)
    {
        return self::where('email', $email)->first();
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    /**
     * @param $phone
     *
     * @return mixed
     */
    public static function findByPhone($phone)
    {
        return self::where('phone', $phone)->first();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @return array
     */
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
