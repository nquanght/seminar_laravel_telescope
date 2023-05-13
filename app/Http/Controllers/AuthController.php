<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users);;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $dataAdd = $request->toArray();
        $dataAdd['password'] = bcrypt($dataAdd['password']);

        $userModel = new User();
        $userModel->fill($dataAdd);
        $userModel->save();

        return response()->json($userModel);
    }

    public function show($id)
    {
        $foundUser = User::find($id);

        return response()->json($foundUser);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $dataAdd = $request->toArray();
        $dataAdd['password'] = bcrypt($dataAdd['password']);

        $foundUser = User::find($id);
        $foundUser->fill($dataAdd);
        $foundUser->save();

        return response()->json($foundUser);
    }

    public function destroy($id)
    {
        $foundUser = User::find($id);
        $foundUser->delete();

        return response()->json($foundUser);
    }

}
