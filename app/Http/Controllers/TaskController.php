<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use App\Models\status_task;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        if($user_id)
        {
        $tasks = Task::where('user_id', $user_id)->get();
        }else{
            $tasks = Task::all();
        }
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $task = Task::all();
        $projects = Project::all();
        return view('tasks.create',compact('users','task','projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);
        $user = new Task();
        $user ->title = $request->title;
        $user ->description = $request->description;
        $user ->priority = $request->priority;
        $user ->due_date = $request->due_date;
        $user ->user_id = $request->user_id;    
        $user ->status = 'todo';    

        $user->save();
        return redirect()->route( 'tasks.index') ->with('success', 'Task created successfully'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::all(); // Assuming you want to select a user when editing

        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'due_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::findOrFail($id);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->user_id = $request->user_id;
        $task->status = $request->status;

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
    public function updated(Request $request)
    {
        
        $task=Task::where('id',$request->taskId)->update(['status' => $request->newStatus]);
        $status = new status_task();
        $status ->task_id = $request->taskId;
        $status ->user_id = auth()->user()->id;
        $status ->status_id =1;
        $status->save();
    return "done";
    }
}
    