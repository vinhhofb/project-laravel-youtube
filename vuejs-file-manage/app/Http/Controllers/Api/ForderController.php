<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Storage;

class ForderController extends Controller
{
    public function listForders(){
        $forders = DB::table('forder')->get();
        $files = DB::table('files')->get();

        return view('welcome',[
            'forders' => $forders,
            'files' => $files
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        $forder = DB::table('forder')->insert($request->all());

        return $forder;
    }

    public function edit($id){
        $forder = DB::table('forder')->where('id', $id)->first();

        return $forder;
    }

    public function editNameForder(Request $request, $id){
        $forder = DB::table('forder')->where('id', $id)->update($request->all());

        return $forder;
    }

    public function delete($id){
        $files = DB::table('files')->where('forder_id', $id)->get();
        foreach ($files as $file) {
            unlink(storage_path('app/public/uploads/' . $file->name_generate));
        }
        $forder = DB::table('forder')->where('id', $id)->delete();
        DB::table('files')->where('forder_id', $id)->delete();

        return $forder;
    }
}
