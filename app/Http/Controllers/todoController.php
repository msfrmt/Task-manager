<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use DB;
use Session;
use App\Models\User;
use Illuminate\Http\Request;

class todoController extends Controller
{
    public function index()
    {
        return view('auth.login1');
    }

    public function saveTask(Request $request)
    {
        //task::create($request->all());
        $task = new Tasks();
        $task->user_id             = auth()->user()->id;
        $task->task_name           = $request->task_name;
        $task->completion_date     = $request->completion_date;
        $task->completion_status   = $request->completion_status;

        $task->save();
        return redirect('/todo/add')->with('message', 'Task added successfully');;
    }

    public function add()
    {
        return view('admin.todo.add-task');
    }
    public function undoneTask($id)
    {
        $task = Tasks::find($id);
        $task->completion_status = 0;
        $task->save();

        return redirect('/todo/manage')->with('message', 'task undone');
    }

    public function doneTask($id)
    {
        $task = Tasks::find($id);
        $task->completion_status = 1;
        $task->save();

        return redirect('/todo/manage')->with('message', 'task completed successfully');
    }

    public function editTask($id)
    {
        $task = Tasks::find($id);

        return view('admin.todo.edit-task', ['task' => $task]);
    }

    public function updateTask(Request $request)
    {

        $task = new Tasks();
        $task = Tasks::find($request->task_id);

        $task->task_name         =  $request->task_name;
        $task->completion_date   =  $request->completion_date;
        $task->completion_status =  $request->completion_status;
        $task->save();

        return redirect('/todo/manage')->with('message', 'Task status updated');
    }

    public function deleteTask($id)
    {

        $task = Tasks::find($id);
        $task->delete();

        return redirect('/todo/manage')->with('message', 'task deleted');
    }


    public function manageTask()
    {
        // ->where('Completion_Status', '=', 0)
        $task = auth()->User()->tasks()->where('completion_date', '>=', date('Y-m-d'))
            ->latest()
            ->get();
        return view('admin.todo.manage-task', ['tasks' => $task]);
    }

    public function historyTask()
    {

        $task = auth()->user()->tasks()->whereDate('Completion_Date', '<', date('Y-m-d H:s:i'))
            ->orWhere('Completion_Status', '=', 1)
            ->get();

        return view('admin.todo.history', ['tasks' => $task]);
    }

    public function ClearHistory()
    {
        $task = auth()->user()->tasks()->where('Completion_Date', '<', date('Y-m-d H:s:i'))
            ->orWhere('Completion_Status', '=', 1)->delete();
        return redirect('task/history')->with('message', 'HistoryItem deleted');
    }
    public function searchByDate(Request $req)
    {
        $task = auth()->User()->tasks()->where('completion_date', '>=', $req->from)
            ->where('completion_date', '<=', $req->to)
            ->where('Completion_Status', '=', 0)->latest()
            ->get();
        return view('admin.todo.manage-task', ['tasks' => $task]);
    }
    public function searchByDateQ($id)
    {
        if ($id != 1) {
            $paramDate = date('Y-m-d');
        } else {
            $paramDate = date('Y-m-d', strtotime("yesterday"));
        }
        $task = auth()->User()->tasks()->where('completion_date', '=', $paramDate)
            ->where('Completion_Status', '=', 0)->latest()
            ->get();
        // print_r($task);
        // die();
        return view('admin.todo.manage-task', ['tasks' => $task]);
    }

    public function searchByName(Request $req)
    {
        $task = auth()->User()->tasks()->where('task_name', 'LIKE', "%{$req->terms}%")
            ->get();
        return view('admin.todo.manage-task', ['tasks' => $task]);
    }
}
