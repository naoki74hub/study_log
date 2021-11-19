<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\FolderRequest;

use App\Models\Folder;

class FolderController extends Controller
{
    public function create()
    {
        return view('folders/create');
    }
    
    public function store(FolderRequest $request, Folder $folder)
    {
        $folder->title = $request->input('title');
        $folder->save();
        return redirect()->route('folders.tasks.index', [$folder->id,]);
    }
}
