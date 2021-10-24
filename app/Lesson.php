<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'date', 'period', 'goal'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($lesson) {
            $lesson->statuses()->createMany([
                [
                    'sutatuse_name' => '導入',
                    'slug' => 'introduction',
                    'order' => 1,
                ],
                [
                    'sutatuse_name' => '展開',
                    'slug' => 'development',
                    'order' => 2
                ],
                [
                    'sutatuse_name' => 'まとめ',
                    'slug' => 'summary',
                    'order' => 3
                ]
            ]);
        });

        static::deleting(function ($lesson) {
            $lesson->tasks()->delete();
            $lesson->statuses()->delete();
        }) ;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function statuses()
    {
        return $this->hasMany('App\Status')->orderBy('order');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
