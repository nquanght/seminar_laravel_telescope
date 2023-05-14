<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function index()
    {
        Redis::set('user_name', 'quang');
        $dataRedis = Redis::get('user_name');

        return response()->json($dataRedis);;
    }

    public function store(Request $request)
    {
        //TODO
    }

    public function show($id)
    {
        //TODO
    }

    public function update(Request $request, $id)
    {
        //TODO
    }

    public function destroy($id)
    {
        //TODO
    }
}
