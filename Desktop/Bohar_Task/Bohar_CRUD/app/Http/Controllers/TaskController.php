<?php

namespace App\Http\Controllers;

use App\Events\popupMessage;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function view_all_tasks()
    {
        $tasks = Task::where('user_id', '=', Auth::id())->get();
        return view('Task.all_tasks', compact('tasks'));
    }



    /**
     * Show the task create form for creating a new task.
     */
    public function newtask()
    {
        return view('Task.task_form');
    }

    /**
     * create new task.
     */
    public function create(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'status'=>'required'
            ]);


        $task = new Task;
        $task->user_id = $id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');

        if ($task->save()) {
            event(new popupMessage($task->id, 'created successfully'));
            return back();
        } else {
            return redirect()->route('task.view');
        }
    }

    /**
     * Display update task view.
     */
    public function update_task(Task $task)
    {

        return view('Task.update_task', compact('task'));
    }

    /**
     * Display the specified resource.
     */
    public function view(Task $task)
    {

        return view('Task.view_tasks', compact('task'));
    }



    /**
     * Update the specified task .
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'status'=>'required'
        ]);

        $update = $task->update($request->all());
        if ($update) {
            event(new popupMessage($task->id, 'updated success'));
            return redirect()->route('all_tasks');
        }
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {

        if (!$task) {
            return back()->with('fail', 'Task not found.');
        }

        $delete = $task->delete();
        if ($delete) {
            event(new popupMessage($task->id, 'deleted successfully'));
            return back();
        } else {
            return back()->with('fail', 'Deletion attempt failed.');
        }
    }
}
