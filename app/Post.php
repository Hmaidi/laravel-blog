<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected  $tabe='posts';
    public $primaryKey ='id';
    public $timestamps= true;

     public function user()
    {
       return $this->belongsTo('App\user');
    }
}
