<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormDataRequest;
use DB;

class HomeController extends Controller
{
    public function create(FormDataRequest $request){
        \DB::table('customers_info')->insert($request->all());

        return response()->json(['status' => 'success'], 200);
    }
    public function getDataHome(){

        $forders = DB::table('forder')->get();
        $files = DB::table('files')->orderBy('id', 'desc')->get();

        return [
            'forders' => $forders,
            'files' => $files
        ];
    }
}
