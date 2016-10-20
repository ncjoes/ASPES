<?php
/**
 * Project: smartdata.zeesaa.com
 * Author:  J. C. Nwobodo (Fibonacci)
 * Date:    8/8/2016
 * Time:    11:45 AM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package App\Models
 */
class Role extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function _findByName($name)
    {
        return self::where('name', $name)->first();
    }
}