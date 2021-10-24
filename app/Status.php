<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['sutatuse_name', 'slug', 'order'];

    public $timestamps = false;

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task')->orderBy('order');
    }

}
