<?php

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\Logo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;

class SubmitController extends Controller
{
    public function index(){
        return view('submit.index');
    }

    public function logo_index(){
        return view('submit.logo.index');
    }

    public function logo_add(Request $request){
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logoname' => 'required',
        ]);

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $extorig = $file->getExtension();

        $imageName = \Storage::putFile('logos', new UploadedFile($file->path(), $file->getClientOriginalName()));
        //dd($file);

        $l = new Logo;
        $l->extension = \Storage::mimeType($imageName);
        $l->filename = str_replace($extorig, '', $imageName);
        $l->title = $request->get('logoname');
        $l->user_id = \Auth::id();


        $l->save();

        event(new Obyx('logo-add', \Auth::id()));

        return redirect()->route('submit.logo.success');
    }

}
