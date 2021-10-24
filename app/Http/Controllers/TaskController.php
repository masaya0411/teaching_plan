<?php

namespace App\Http\Controllers;

use App\Task;
use App\Lesson;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => ['required', 'string', 'max:255'],
            'time' => ['required', 'integer'],
            'description' => ['required', 'max:255'],
            'lesson_id' => ['required', 'exists:lessons,id'],
            'status_id' => ['required', 'exists:statuses,id']
        ]);

        $task = new Task;
        return $task->create($request->only('task_name', 'time', 'description', 'lesson_id', 'status_id'));
    }

    public function sync(Request $request)
    {
        $this->validate(request(),[
            'columns' => ['required', 'array']
        ]);

        foreach($request->columns as $status) {
            foreach($status['tasks'] as $i => $task){
                $order = $i + 1;
                if($task['status_id'] !== $status['id'] || $task['order'] !== $order) {
                    Task::find($task['id'])
                        ->update(['status_id' => $status['id'], 'order' => $order]);
                }
            }
        }

        $lesson_id = $request->columns[0]['lesson_id'];
        $lesson = Lesson::find($lesson_id);
        return $lesson->statuses()->with('tasks')->get();
    }

    public function destroy(int $taskId)
    {
        $del_task = Task::find($taskId);
        $del_task->delete();

        return (200);
    }
}
