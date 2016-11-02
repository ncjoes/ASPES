<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:28 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Factor
 *
 * @package App\Models
 */
class Factor extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $casts = ['weight' => 'array'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comparisons()
    {
        return $this->hasMany(Comparison::class, 'f1_id');
    }

    /**
     * @return mixed
     */
    public function parent()
    {
        return self::find($this->parent_id);
    }

    /**
     * @return mixed
     */
    public function sub_factors()
    {
        return self::where('parent_id', $this->id);
    }
}