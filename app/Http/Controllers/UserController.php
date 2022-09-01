<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function index()
    {
        if (Gate::allows('is-admin') || Gate::allows('is-editor')) {
            $list = User::all();
            return response()->json(['users' => $list], 200);
        } else {
            return response()->json(['message' => 'You are not authorized to access this resource'], 403);
        }
    }

    public function edit($id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-editor')) {
            $user = User::find($id);
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'You are not authorized to access this resource'], 403);
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('is-admin') || Gate::allows('is-editor')) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->rut_user = $request->rut_user;
            $user->nacionality = $request->nacionality;
            $user->marital_status = $request->marital_status;
            $user->birthday = $request->birthday;
            $user->save();
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'You are not authorized to access this resource'], 403);
        }
    }

    public function destroy($id)
    {
        if (Gate::allows('is-admin')) {
            $user = User::find($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'You are not authorized to access this resource'], 403);
        }
    }

    public function update_role(Request $request, $id)
    {
        if (Gate::allows('is-admin')) {
            $user = User::find($id);
            $user->role = $request->role;
            $user->save();
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'You are not authorized to access this resource'], 403);
        }
    }
}
