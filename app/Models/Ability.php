<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ability
 *
 * @package App\Models
 */
class Ability extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_ability')->withTimestamps();
    }
}
