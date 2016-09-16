<?php
/**
 * Project: flexbook.zeesaa.com
 * Author:  J. C. Nwobodo (Fibonacci)
 * Date:    8/8/2016
 * Time:    11:45 AM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public static function findByName($name)
    {
        return self::where('name', $name)->first();
    }
}