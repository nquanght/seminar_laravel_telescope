<?php

namespace App\Http\Controllers;

use App\Events\WriteLogEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all()->toArray();

        return response()->json($users);;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $newUser = DB::transaction(function () use ($request) {
            $dataAdd = $request->toArray();
            $dataAdd['password'] = bcrypt($dataAdd['password']);

            $userModel = new User();
            $userModel->fill($dataAdd);
            $userModel->save();

            return $userModel->toArray();
        });

        event(new WriteLogEvent($newUser));

        return response()->json($newUser);
    }

    public function show($id)
    {
        $foundUser = User::find($id)->toArray();

        event(new WriteLogEvent($foundUser));

        return response()->json($foundUser);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $userUpdated = DB::transaction(function () use ($request, $id) {
            $dataUpdate = $request->toArray();
            $dataUpdate['password'] = bcrypt($dataUpdate['password']);

            $foundUser = User::find($id);
            $foundUser->fill($dataUpdate);
            $foundUser->save();

            return $foundUser->toArray();
        });

        event(new WriteLogEvent($userUpdated));

        return response()->json($userUpdated);
    }

    public function destroy($id)
    {
        $foundUser = User::find($id);
        $foundUser->delete();

        event(new WriteLogEvent($foundUser));

        return response()->json($foundUser);
    }

}
