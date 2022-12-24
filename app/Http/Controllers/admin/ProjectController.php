<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // return data table page for all projects useing paginate 15 items evry page 
    public function index()
    {
       $projects= Project::paginate();
        return view('admin.projects.index',[
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     // return create new project page
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     // stor data function useing eloquent 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255'
        ]);

        Project::create($request->all());
        session()->flash('success','project create success');

        return Redirect('dashboard/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // return project show page
    public function show(Project $project)
    {
        return view('admin.projects.show',[
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //return project edit page
    public function edit(Project $project)
    {
        return view('admin.projects.edit',[
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // update projet function
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255'
        ]);

        $project->update($request->all());
        session()->flash('success','project update success');
        return Redirect('dashboard/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      // delete project function 
    public function destroy(Project $project)
    {
        $project->delete();
        session()->flash('success','project delete success');
        return Redirect('dashboard/projects');
    }
}
