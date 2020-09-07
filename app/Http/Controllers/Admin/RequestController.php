<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

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
}
