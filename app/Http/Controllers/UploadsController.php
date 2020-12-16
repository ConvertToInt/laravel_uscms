<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UploadsController extends Controller
{
    public function index(){
        $uploads = Upload::with('user')->get();
        return view('uploads.index', ['uploads' => $uploads]);
    }

    public function create(){
        return view('uploads.create');
    }

    public function store(Request $request){
        $upload = new Upload;
        $upload->mimeType = $request->file('upload')->getMimeType();
        $upload->origName = $request->file('upload')->getClientOriginalName();
        $upload->path = $request->file('upload')->store('uploads');
        $upload->title = $request->title;
        $upload->content = $request->content;
        $upload->user_id = Auth::id();
        $upload->save();
        
        return view('uploads.create', ['upload'=>$upload]);

        
                /* ['id'=>$upload->id,
                'path'=>$upload->path,
                'origName'=>$upload->origName,
                'mimeType'=>$upload->mimeType,
                'title'=>$upload->title,
                'content'=>$upload->content] */
    }

    public function show(Upload $upload,$origName=''){
        $upload = Upload::findOrFail($upload->id);
        //return response()->file(storage_path() . '/app/' . $upload->path);
        return view('uploads.show', ['upload'=>$upload]);
    }

    public function file(Upload $upload,$origName=''){
        $upload = Upload::findOrFail($upload->id);
        return response()->file(storage_path() . '/app/' . $upload->path);
    }

    public function edit(Upload $upload){
        return view('uploads.edit',
                    ['id'=>$upload->id,
                    'path'=>$upload->path,
                    'origName'=>$upload->origName,
                    'mimeType'=>$upload->mimeType,
                    'title'=>$upload->title,
                    'content'=>$upload->content]);
    }

    public function update(Request $request, Upload $upload){
        $upload = Upload::findOrFail($upload->id);
        $upload->title = $request->title;
        $upload->content = $request->content;
        if ($request->hasFile('upload')){
            Storage::delete($upload->path);  
            $upload->origName = $request->file('upload')->getClientOriginalName();
            $upload->path = $request->file('upload')->store('uploads');
            $upload->mimeType = $request->file('upload')->getClientMimeType();
        }
        $upload->save();
        return back();
    }

    public function destroy(Upload $upload){
        $upload = Upload::findOrFail($upload->id);
        Storage::Delete($upload->path);
        $upload->delete();
        return back()->with(['operation'=>'deleted', 'id'=>$upload->id]);
    }
}
