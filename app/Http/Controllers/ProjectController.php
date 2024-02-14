<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $projects = Project::all();
        return view ('project.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'manager' => 'required',
            'project_name' => 'required',
            'started_date' => 'required',
        ]);
       $project = new Project();
       $project ->manager = $request->manager; 
       $project ->project_name = $request->project_name; 
       $project ->started_date = $request->started_date; 
       $project ->estimate_time = $request->estimate_time; 
       $project->save();
       return redirect('/admin/project');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('project.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $project ->manager = $request->manager; 
        $project ->project_name = $request->project_name; 
        $project ->started_date = $request->started_date; 
        $project ->estimate_time = $request->estimate_time; 
        $project->save();

        return redirect('project');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
