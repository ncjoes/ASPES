<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:28 PM
 **/

namespace App\Models;

use App\Models\DataTypes\FuzzyNumber;
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
    protected $casts = ['weight' => 'float'];

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

    /**
     * @return Collection
     */
    public function siblings()
    {
        if (is_object($this->parent())) {
            return $this->parent()->children();
        }
        else {
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

    /**
     * @return bool
     */
    public function hasSubFactors()
    {
        return $this->children()->count() > 0;
    }

    /**
     * @return float|mixed|number
     */
    public function getRawWeight()
    {
        if ($this->exercise->concluded === false) {
            return $this->calculateRawWeight();
        }

        return $this->weight;
    }

    /**
     * @return float|number
     */
    protected function calculateRawWeight()
    {
        $rb = [];
        if ($this->hasSubFactors()) {
            // ToDo
        }

        $DM = $this->exercise->getDecisionMatrix();
        foreach ($this->siblings() as $factor) {
            $rb[ $factor->id ] = FuzzyNumber::geometricMean($DM[ $factor->id ]);
        }
        $FN = FuzzyNumber::product($rb[ $this->id ], FuzzyNumber::addMany($rb)->reciprocal());

        return $FN->defuzzify(3);
    }
}
