<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tasks = task::paginate();
        return view('admin.tasks.index',[
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // to can edmin select the project for this task 
        $projects = Project::all()->pluck('id','name');

        //to can admin select employee for this task to work in it
        $employees = User::where('is_admin',0)->pluck('id','name');


        return view('admin.tasks.create',[
            'projects' => $projects,
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->valdate([
            'employee_id' => 'required|int|exists:users,id',
            'project_id' => 'required|int|exists:projects,id',
            'name' => 'required|string|min:2|max:255',
            'details' =>  'required',

        ]);

        session()->flash('success','task create success');

        task::create($request->all());
        return Redirect('dashboard/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        return view('admin.tasks.show',[
            'task' => $task, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
        // to can edmin select the project for this task 
        $projects = Project::all()->pluck('id','name');

        //to can admin select employee for this task to work in it
        //can admin reassign employee when edit just select new empolyees from employees list 
        $employees = User::where('is_admin',0)->pluck('id','name');

        return view('admin.tasks.edit',[
            'task' => $task,
            'projects' => $projects,
            'employees' => $employees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,task $task)
    {
        $request->valdate([
            'employee_id' => 'required|int|exists:users,id',
            'project_id' => 'required|int|exists:projects,id',
            'name' => 'required|string|min:2|max:255',
            'details' =>  'required',

        ]);

        $task->update($request->all());

        session()->flash('success','task update success');

        return Redirect('dashboard/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        $task->delete();
        
        session()->flash('success','task delete success');

        return Redirect('dashboard/tasks');

    }
}
