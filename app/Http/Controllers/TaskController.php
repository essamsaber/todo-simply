<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        return response(Task::all()->jsonSerialize(), 200);
    }



    public function store(Request $request)
    {
       $task = Task::create([
            'title' => $request->title,
            'priority' => $request->priority
        ]);
       return response($task->jsonSerialize(), 201);
    }


    public function destroy(Task $task)
    {
        $task->delete();
    }
}
