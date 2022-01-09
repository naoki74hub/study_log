<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTaskRequest;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Folder $folder)
    {
        $folders = Auth::user()->folders;
        $tasks = $folder->tasks;
        
        return view('tasks/index', [
             'folders' => $folders,
             'current_folder_id' => $folder->id,
             'tasks' => $tasks,
        ]);
    }
    
    public function create(Folder $folder)
    {
        return view('tasks/create', ['folder' => $folder]); 
    }
    
    public function store(Folder $folder, Task $task, CreateTaskRequest $request)
    {
        $task->title = $request->input('title');
        $task->estimate_hour = $request->input('estimate_hour');
        $task->due_date = $request->input('due_date');
        
        $folder->tasks()->save($task);
        
         return redirect()->route('folders.tasks.index', ['folder' => $folder->id]);
    }
    
    public function edit(Folder $folder, Task $task)
    {
       
        return view('tasks/edit', ['task' => $task]);
    }
    
    
    public function update(Folder $folder, Task $task, CreateTaskRequest $request)
    {
        $task->title = $request->input('title');
        $task->status = $request->input('status');
        $task->estimate_hour = $request->input('estimate_hour');
        $task->due_date = $request->input('due_date');
        
        $task->save();
        
        return redirect()->route('folders.tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }
    
    
    public function destroy(Task $task)
    {
        $task->delete();
        
        return redirect()->route('folders.tasks.index', [
            'folder' => $task->folder_id,
            ]);
    }
}
