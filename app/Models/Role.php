<?php

/**
 * Project: flexbook.zeesaa.com
 * Author:  J. C. Nwobodo (Fibonacci)
 * Date:    8/8/2016
 * Time:    11:45 AM
 * */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App\Models
 */
class Role extends Model
{
    /**
     * @param $name
     *
     * @return mixed
     */
    public static function findByName($name)
    {
        return self::where('name', $name)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'role_ability')->withTimestamps();
    }
}
