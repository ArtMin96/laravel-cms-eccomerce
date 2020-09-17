<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Credentials;
use App\Customers;
use App\Http\Controllers\Controller;
use App\OurTeam;
use App\Page;
use App\Settings;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeSiteLogoImage(Request $request)
    {
        if (!empty($request->post('file_id'))) {
            $settings = Settings::findOrFail($request->post('file_id'));

            if (!empty($settings)) {
                unlink(storage_path('app/public/site/'.$settings->logo));
                $settings->update(['logo' => null]);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => 'File successfully removed!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeSiteLogoSmImage(Request $request)
    {
        if (!empty($request->post('file_id'))) {
            $settings = Settings::findOrFail($request->post('file_id'));

            if (!empty($settings)) {
                unlink(storage_path('app/public/site/'.$settings->logo_sm));
                $settings->update(['logo_sm' => null]);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => 'File successfully removed!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeOurTeamImage(Request $request) {
        if (!empty($request->post('file_id'))) {
            $ourTeam = OurTeam::findOrFail($request->post('file_id'));

            if (!empty($ourTeam)) {
                unlink(storage_path('app/public/member/'.$ourTeam->image));
                $ourTeam->update(['image' => null]);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => 'File successfully removed!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCredentialImage(Request $request) {
        if (!empty($request->post('file_id'))) {
            $credential = Credentials::findOrFail($request->post('file_id'));

            if (!empty($credential)) {
                unlink(storage_path('app/public/credentials/'.$credential->image));
                $credential->update(['image' => null]);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => 'File successfully removed!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCustomersImage(Request $request) {
        if (!empty($request->post('file_id'))) {
            $customers = Customers::findOrFail($request->post('file_id'));

            if (!empty($customers)) {
                unlink(storage_path('app/public/customers/'.$customers->image));
                $customers->update(['image' => null]);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => 'File successfully removed!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Cannot find image!']);
        }
    }
}
