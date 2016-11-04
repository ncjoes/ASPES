<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:28 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
     * @return Factor || null
     */
    public function parent()
    {
        return self::find($this->parent_id);
    }

    public function siblings()
    {
        if(is_object($this->parent())) {
            return $this->parent()->children();
        }
        else{
            return $this->exercise->factors;
        }
    }

    /**
     * @return Collection || null
     */
    public function children()
    {
        return self::where('parent_id', $this->id)->get();
    }

    public function calculateWeight()
    {
        if($this->hasSubFactors()) {

        }
        else {

        }
    }

    public function hasSubFactors()
    {
        return $this->children()->count() > 0;
    }
}
