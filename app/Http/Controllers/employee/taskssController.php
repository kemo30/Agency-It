<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class taskssController extends Controller
{
    public function index(){

        $tsaks =task::where('employee_id', Auth::user()->id)->where('status',0)->paginate();
        return view('employee.tasks.index',[
            'tasks' => $tsaks,
        ]);
    }

    public function show(task $task){
        return view('employee.tasks.show',[
            'task' => $task,
        ]);
    }

    public function submitPage(task $task){
        if($task->status == 0){
        return view('employee.tasks.submit',[
            'task' => $task
        ]); 
        }else{
            session()->flash('error','this task already submited');
           return Redirect('employee/tasks');
        } 
    }

    public function submit(Request $request,task $task){
        if($task->status == 0){
        $request->validate([
            'submit_details' => 'require',
        ]);
        
        $task->update([
            'status' => 1,
            'submit_details' => $request->submit_details
        ]);
        session()->flash('success','task is submited success');
        return Redirect('employee/tasks');
    
    
        }else{
        session()->flash('error','this task already submited');
        return Redirect('employee/tasks');
        } 
    }
}
