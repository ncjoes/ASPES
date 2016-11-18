<?php
/**
 * Project: aspes.msc
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    9/16/2016
 * Time:    11:06 PM
 **/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invitation
 *
 * @package App\Models
 */
class Invitation extends Model
{
    const ROLE_EVALUATOR = 1;
    const ROLE_SUBJECT = 2;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * @param $role
     *
     * @return bool
     */
    public function isRole($role)
    {
        return $this->role === $role;
    }
}
