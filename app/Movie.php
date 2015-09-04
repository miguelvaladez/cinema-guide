<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $fillable = ['title'];
    public $timestamps = false;

    public function sessionTimes()
    {
    	return $this->hasMany('App\SessionTime', 'movie_id');
    }
}
