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
        $folders = Auth::user()->folders()->get();
        $tasks = $folder->tasks()->get();
        
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
    
    public function store(int $id, Task $task, CreateTaskRequest $request)
    {
        $current_folder = Folder::find($id); 
        $task->title = $request->input('title');
        $task->estimate_hour = $request->input('estimate_hour');
        $task->due_date = $request->input('due_date');
        
        $current_folder->tasks()->save($task);
        
         return redirect()->route('folders.tasks.index', ['folder' => $current_folder]);
    }
    
    public function edit(int $id, int $task_id)
    {
        $task = Task::find($task_id);
        
        return view('tasks/edit', ['task' => $task]);
    }
    
    
    public function update(int $id, int $task_id, CreateTaskRequest $request)
    {
        $task = Task::find($task_id);
        $task->title = $request->input('title');
        $task->status = $request->input('status');
        $task->estimate_hour = $request->input('estimate_hour');
        $task->due_date = $request->input('due_date');
        
        $task->save();
        
        return redirect()->route('folders.tasks.index', [
            'folder' => $task->folder_id,
            'task' => $task,
        ]);
    }
    
    
    public function destroy(Folder $folder, int $task_id)
    {
        $task = Task::find($task_id);
        $task->delete();
        
        return redirect()->route('folders.tasks.index', [
            'folder' => $task->folder_id,
            'task' => $task,
            ]);
    }
}