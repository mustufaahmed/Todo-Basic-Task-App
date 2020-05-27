<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function index()
    {
    	# code...
    	return view('welcome');
    }

    public function create()
    {
    	# code...
    	$tasks = Task::orderBy('created_at','asc')->paginate(5);
    	return view('tasks',compact('tasks'));
    }

    public function store(Request $request)
    {
    	# code...
    	$request->validate([
    		'name' => 'required|max:255',
    	]);

    	Task::create([
    		'name' => $request->name
    	]);

    	return redirect()->route('task.create')->with('successMsg','Task Added Successfully');
    }

    public function delete($id)
    {
    	# code...
    	Task::findOrFail($id)->delete();
    	return redirect()->route('task.create')->with('successMsg','Task Removed Successfully');;
    }
}
