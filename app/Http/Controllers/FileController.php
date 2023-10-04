<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $request->file->storeAs($request->path,Str::random(3).'_'.$request->file->getClientOriginalName(),'public');

        return  redirect()->route('testFiles');

    }

    public function index()
    {
        return view('testFilesForm');
    }

    public function test()
    {
        return view('testFiles');
    }


}
