<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commnets extends Model
{
    protected $fillable=[
        'content', 'date', 'id_post','id_user'
    ];
}
