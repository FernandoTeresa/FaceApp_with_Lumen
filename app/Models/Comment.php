<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'content', 'date', 'id_post','id_user'
    ];

    public function user(){

        return $this->belongsTo(User::class, 'id_user');

    }

    public function post(){
        return $this->belongsTo(Post::class, 'id_post');
    }




}
