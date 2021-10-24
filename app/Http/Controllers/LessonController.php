<?php

namespace App\Http\Controllers;

use App\Task;
use App\Lesson;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function mypage()
    {
        $lessons = Auth::user()->lessons()->get();
        return view('lessons.mypage', compact('lessons'));
    }

    public function index($id)
    {
        if(!ctype_digit($id)){
            return redirect('/mypage')->with('flash_message', __('Invalid operation was performed.'));
        }
        $lesson = Lesson::find($id);
        $tasks = $lesson->statuses()->with('tasks')->get();

        return view('lessons.lessonDetail', compact('lesson','tasks'));
    }

    public function store(LessonRequest $request)
    {
        $lesson = new Lesson;
        Auth::user()->lessons()->save($lesson->fill($request->all()));

        return redirect('/mypage')->with('flash_message', __('Registered.'));
    }

    public function edit($id)
    {
        if(!ctype_digit($id)){
            return redirect('/mypage')->with('flash_message', __('Invalid operation was performed.'));
        }

        $lesson = Auth::user()->lessons()->find($id);
        return view('lessons.edit', compact('lesson'));
    }

    public function update(LessonRequest $request, $id)
    {
        if(!ctype_digit($id)){
            return redirect('/mypage')->with('flash_message', __('Invalid operation was performed.'));
        }

        $lesson = Lesson::find($id);
        $lesson->fill($request->all())->save();
        
        return redirect('/mypage')->with('flash_message', __('Registered.'));
    }

    public function destroy($id)
    {
        if(!ctype_digit($id)){
            return redirect('/mypage')->with('flash_message', __('Invalid operation was performed.'));
        }

        Lesson::find($id)->delete();

        return redirect('/mypage')->with('flash_message', __('Deleted.'));
    }
}
