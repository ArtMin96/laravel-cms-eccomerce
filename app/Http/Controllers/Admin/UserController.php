<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

class UserController extends AdminController
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => __('admin.User status updated successfully.')]);
    }
}
