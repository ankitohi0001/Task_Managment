<?php

namespace App\Http\Controllers;

use App\Models\status_task;
use App\Models\Task;
use Illuminate\Http\Request;

class StatusTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuss = status_task::all();
        // return  $tasks= Task::all();
        return view ('status.index',compact('statuss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(status_task $status_task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(status_task $status_task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, status_task $status_task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(status_task $status_task)
    {
        //
    }
}
