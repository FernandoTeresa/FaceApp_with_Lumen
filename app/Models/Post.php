<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=[
        'title', 'content', 'date', 'id_user'
    ];

    public function save($options= []){
        $this->date = date("Y/m/d");
        return parent::save($options);
    }


    public function user(){

        return $this->belongsTo(User::class, 'id_user');
    }

    public function comments(){

        return $this->hasMany(Comment::class, 'id_post')->with('user');
    }



}
