<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(int $id)
    {
        $folders = Folder::all();
        $current_folder = Folder::find($id);
        $tasks=$current_folder->tasks()->get();
        
        return view('tasks/index',[
             'folders' => $folders,
             'current_folder_id' => $current_folder->id,
             'tasks' => $tasks,
        ]);
    }
    
    
    public function create(int $id)
    {
        return view('tasks/create',['folder_id'=>$id]); 
    }
    
    
    public function store(int $id,CreateTaskRequest $request, Task $task)
    {
        $current_folder = Folder::find($id); 
        
        $task->title = $request->input('title');
        $task->estimate_hour = $request->input('estimate_hour');
    
        $task->due_date = $request->due_date;
        $current_folder->tasks()->save($task);
        
         return redirect()->route('folders.index', [
        'id' => $current_folder->id,
      ]);
    }
    
   
    public function edit(int $id, int $task_id)
    {
        $task = Task::find($task_id);
        
        return view('tasks/edit',[
            'task'=>$task
        ]);
    }
    
    
    public function update(int $id,int $task_id, EditTaskRequest $request)
    {
        $task = Task::find($task_id);
        $task->title = $request->input('title');
        $task->status = $request->input('status');
        $task->estimate_hour = $request->input('estimate_hour');
        $task->due_date = $request->input('due_date');
        
        $task->save();
        
        return redirect()->route('folders.index',[
            'id'=>$task->folder_id,
            'task_id'=>$task->id,
        ]);
    }
    
    
    public function destroy(int $id, int $task_id)
    {
        $task = Task::find($task_id);
        $task->delete();
        
        return redirect()->route('folders.index',[
            'id'=>$task->folder_id,
            'task_id'=>$task->id,
            ]);
    }
}
