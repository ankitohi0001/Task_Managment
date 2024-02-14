<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::all();
        $tasks=Task::all();
        return view('users.index',compact('users','tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'user_type' => 'required',
        ]);
      $user = new User();
      $user ->name = $request->name;
      $user ->email = $request->email;
      $user ->password = Hash::make($request->password);
      $user ->user_type = $request->user_type;
      $user->save();
      return redirect('/admin/users');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function userTaskList($user_id)
    {
        $userTasks = Task::where('user_id', $user_id)->get();
        $user = User::findOrFail($user_id);

        return view('tasks.index', compact('userTasks', 'user'));
    }
}
