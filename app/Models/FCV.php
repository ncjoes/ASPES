<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:33 PM
 **/

namespace App\Models;

use App\Models\DataTypes\FuzzyNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FCV
 *
 * @package App\Models
 */
class FCV extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $casts = ['value' => 'array'];
    protected $table = 'fcvs';

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
    public function comparisons()
    {
        return $this->hasMany(Comparison::class, 'fcv__id');
    }

    public function getValue()
    {
        if (FuzzyNumber::checkIfTriple($this->value))
            return new FuzzyNumber($this->value);

        return null;
    }
}
