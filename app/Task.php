<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name', 'time', 'description', 'order', 'lesson_id', 'status_id'];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
