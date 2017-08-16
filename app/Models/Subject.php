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
        if ($this->exercise->isPublished()) {
            $arr = $this->evaluation_matrix;
            if (!is_array($arr)) {
                $arr = $this->evaluation_matrix = $this->buildEvaluationMatrix();
                $this->save();
            }

            return $arr;
        }

        $arr = $this->evaluation_matrix = $this->buildEvaluationMatrix();
        $this->save();

        return $arr;
    }

    /**
     * @return array
     */
    protected function buildEvaluationMatrix()
    {
        $counter = [];
        $factors = $this->exercise->factors;
        $comments = $this->exercise->comments;

        $MATRIX = [];
        foreach ($factors as $factor) {
            foreach ($comments as $comment) {
                $MATRIX[ $factor->id ][ $comment->id ] = 0;
            }
        }

        /**
         * @var Evaluation $evaluation
         */
        foreach ($this->evaluations as $evaluation) {
            if (isset($counter[ $evaluation->factor->id ][ $evaluation->comment->id ]))
                $counter[ $evaluation->factor->id ][ $evaluation->comment->id ] += 1;
            else
                $counter[ $evaluation->factor->id ][ $evaluation->comment->id ] = 1;
        }

        foreach ($counter as $factorId => $factorCommentsCounts) {
            $sum = array_sum($factorCommentsCounts);
            foreach ($factorCommentsCounts as $commentId => $commentsCount) {
                $MATRIX[ $factorId ][ $commentId ] = $sum > 0 ? round($commentsCount / $sum, 3) : 0;
            }
        }

        return $MATRIX;
    }
}
