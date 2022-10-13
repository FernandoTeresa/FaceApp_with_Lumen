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
}
