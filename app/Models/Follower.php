<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follower extends Model
{
    use SoftDeletes;
    protected $table = 'followers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'partner_id', 'user_id',
    ];

    protected $dates = ['deleted_at'];
}
