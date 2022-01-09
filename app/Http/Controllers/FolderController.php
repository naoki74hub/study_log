<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;
use App\Models\Task;

class FolderController extends Controller
{
    public function create()
    {
        return view('folders/create');
    }
    
    public function store(FolderRequest $request, Folder $folder)
    {
        
        $folder->title = $request->input('title');
        Auth::user()->folders()->save($folder);
        
        return redirect()->route('folders.tasks.index', ['folder' => $folder]);
    }
    
    public function edit(Folder $folder)
    {
        return view('folders/edit', compact('folder'));
    }
    
    public function update(FolderRequest $request, Folder $folder)
    {
        $folder->title = $request->input('title');
        $folder->save();
        
        return redirect()->route('folders.tasks.index', ['folder' => 1]);
    }
    
    public function destroy(Folder $folder)
    {
      $folder->delete();
       
      return redirect()->route('folders.tasks.index', ['folder' => 1]);
    }
}
