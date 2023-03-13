<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormDataRequest;

class HomeController extends Controller
{
    public function create(FormDataRequest $request){
        \DB::table('customers_info')->insert($request->all());

        return response()->json(['status' => 'success'], 200);
    }
}
