<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Storage;

class FileController extends Controller
{
    public function getDataFiles($id){

        $files = DB::table('files')->where('forder_id', $id)->orderBy('id', 'desc')->get();

        return $files;
    }

    public function upload(Request $request, $id){
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf,html|max:2048'
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');

        DB::table('files')->insert([
            'name' => $file->getClientOriginalName(),
            'name_generate' => $filename,
            'type' => $file->guessExtension(),
            'size' => $file->getSize(),
            'forder_id' => $id
        ]);
        return response()->json([
            'message' => 'File uploaded successfully',
            'filename' => $filename
        ]);
    }

    public function download($id){
        $file = DB::table('files')->where('id', $id)->first();
        $path = storage_path('app/public/uploads/' . $file->name_generate);

        return response()->download($path);
    }

    public function delete($id){
        $file = DB::table('files')->where('id', $id)->first();
        unlink(storage_path('app/public/uploads/' . $file->name_generate));
        $result = DB::table('files')->where('id', $id)->delete();

        return $result;
    }

    public function search(Request $request){
        $files = DB::table('files')->where('name', 'like', '%'.$request->keyword.'%')->get();
        return $files;
    }
}
