<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\EditorUpload;
use Illuminate\Http\Request;

class SummernoteController extends Controller
{
    public function upload(Request $request)
    {
        return EditorUpload::store($request, 'summernote');
    }
}
