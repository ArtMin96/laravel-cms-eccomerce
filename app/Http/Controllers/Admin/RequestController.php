<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RequestController extends AdminController
{

    /**
     * Unique slug
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function slug(Request $request)
    {
        $slug = SlugService::createSlug(Page::class, 'alias', $request->en_name);
        return response()->json(['slug' => $slug]);
    }

    public function removeBannerImage(Request $request)
    {
        if (!empty($request->post('file_id'))) {
            $banner = Banner::findOrFail($request->post('file_id'));

            if (!empty($banner)) {
                unlink(storage_path('app/public/banner/'.$banner->image));
                $banner->update(['image' => null]);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => 'File successfully removed!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
        }
    }
}
