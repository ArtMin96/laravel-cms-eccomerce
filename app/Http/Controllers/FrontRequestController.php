<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FrontRequestController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeUserImage(Request $request) {
        if (!empty($request->post('file_id'))) {
            $user = User::findOrFail($request->post('file_id'));

            if (!empty($user)) {
                unlink(storage_path('app/public/users/'.$user->image));
                $user->image = null;
                $user->update();

                return response()->json(['status' => true, 'title' => 'Success', 'message' => 'File successfully removed!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
        }
    }
}
