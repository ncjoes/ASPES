<?php
/**
 * Project: ASPES.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/11/2016
 * Time:    9:42 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subject
 *
 * @package App\Models
 */
class Subject extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates  = ['deleted_at'];
    protected $casts  = ['evaluation_matrix' => 'array'];
    protected $hidden = ['evaluation_matrix'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    /**
     * @return array|mixed
     */
    public function getEvaluationMatrix()
    {
        if ($this->exercise->concluded === false) {
            $this->evaluation_matrix = $this->buildEvaluationMatrix();
            $this->save();
        }

        return $this->evaluation_matrix;
    }

    /**
     * @return array
     */
    protected function buildEvaluationMatrix()
    {
        $counter = [];
        $factors = $this->exercise->factors;
        $comments = $this->exercise->comments;
        $CN = $comments->count();

        /**
         * @var Evaluation $evaluation
         */
        foreach ($this->evaluations as $evaluation) {
            if (isset($counter[ $evaluation->factor->id ][ $evaluation->comment->id ]))
                $counter[ $evaluation->factor->id ][ $evaluation->comment->id ] += 1;
            else
                $counter[ $evaluation->factor->id ][ $evaluation->comment->id ] = 1;
        }

        $MATRIX = [];
        foreach ($counter as $factorId => $factorCommentsCounts) {
            if (sizeof($factorCommentsCounts) < $CN) {
                foreach ($comments as $id => $comment) {
                    if (!isset($factorCommentsCounts[ $factorId ][ $id ]))
                        $factorCommentsCounts[ $factorId ][ $id ] = 0;
                }
            }
            $sum = array_sum($factorCommentsCounts);
            foreach ($factorCommentsCounts as $commentId => $commentsCount) {
                $MATRIX[ $factorId ][ $commentId ] = $commentsCount > 0 ? ($commentsCount / $sum) : $commentsCount;
            }
        }

        return $MATRIX;
    }
}
