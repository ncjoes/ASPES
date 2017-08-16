<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:45 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Evaluator
 *
 * @package App\Models
 */
class Evaluator extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates    = ['deleted_at'];
    protected $casts    = ['comparison_matrix' => 'array', 'consistency_ratio' => 'float'];
    protected $hidden   = ['comparison_matrix'];
    protected $fillable = ['exercise_id', 'user_id', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
}
