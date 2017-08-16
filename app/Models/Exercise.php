<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:09 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Exercise
 *
 * @package App\Models
 */
class Exercise extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates  = ['deleted_at', 'start_at', 'stop_at'];

    const ER_SUBJECT   = 'subjects';
    const ER_EVALUATOR = 'evaluators';

    const IS_LIVE      = 1;
    const IS_DRAFT     = 2;
    const IS_PUBLISHED = 3;

    /**
     * @return array
     */
    public static function states()
    {
        return [
            self::IS_LIVE      => 'Live',
            self::IS_DRAFT     => 'Draft',
            self::IS_PUBLISHED => 'Published',
        ];
    }

    /**
     * @return bool
     */
    public function isLive()
    {
        return $this->state === self::IS_LIVE;
    }

    /**
     * @return bool
     */
    public function isDraft()
    {
        return $this->state === self::IS_DRAFT;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->state === self::IS_PUBLISHED;
    }

    /**
     * @return mixed
     */
    public static function allLive()
    {
        return self::where('state', self::IS_LIVE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function invitedUsers()
    {
        return $this->hasManyThrough(User::class, Invitation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseComments()
    {
        return $this->comments()->where('type', Comment::TYPE_COURSE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instructorComments()
    {
        return $this->comments()->where('type', Comment::TYPE_INSTRUCTOR);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function factors()
    {
        return $this->hasMany(Factor::class);
    }

    public function courseFactors()
    {
        return $this->factors()->where('type', Factor::TYPE_COURSE);
    }

    public function instructorFactors()
    {
        return $this->factors()->where('type', Factor::TYPE_INSTRUCTOR);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluators()
    {
        return $this->hasMany(Evaluator::class);
    }

    /**
     * @param string $role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function concerned_users($role = self::ER_EVALUATOR)
    {
        $builder = $this->belongsToMany(User::class, $role);

        return $role == self::ER_EVALUATOR ? $builder : $builder->withPivot(['id', 'evaluation_matrix']);
    }
}
