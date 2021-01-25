<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Blog;
use App\CompanyLogos;
use App\Credentials;
use App\Customers;
use App\Http\Controllers\Controller;
use App\OurTeam;
use App\Page;
use App\PaymentGateways;
use App\PhoneNumbers;
use App\Product;
use App\ProductFiles;
use App\Settings;
use App\TranslationServices;
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

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
        }
    }

    public function removeBlogImage(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!empty($request->post('file_id'))) {
            $blog = Blog::findOrFail($request->post('file_id'));

            if (!empty($blog)) {
                unlink(storage_path('app/public/blog/'.$blog->image));
                $blog->update(['image' => null]);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
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
                $settings->update(['logo' => 'logo.png']);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
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
                $settings->update(['logo_sm' => 'logo_sm.png']);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
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

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
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

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
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
                $customers->update(['image' => 'customer-default.png']);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removePhoneNumber(Request $request) {
        if (!empty($request->post('id'))) {
            $number = PhoneNumbers::findOrFail($request->post('id'));

            if (!empty($number)) {
                $number->delete();

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
        }
    }

    public function removePaymentGatewayIcon(Request $request) {
        if (!empty($request->post('file_id'))) {
            $paymentGateway = PaymentGateways::findOrFail($request->post('file_id'));

            if (!empty($paymentGateway)) {
                unlink(storage_path('app/public/payment-gateway/'.$paymentGateway->icon));
                $paymentGateway->update(['image' => 'payment-gateway.png']);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeProductImage(Request $request) {
        if (!empty($request->post('file_id'))) {
            $files = ProductFiles::where('id', $request->post('file_id'))->firstOrFail();
            $bxFileDelete = $this->diskFileDelete($files->bx_file_id);

            if (isset($bxFileDelete['result']) && !empty($bxFileDelete['result'])) {
                if (!empty($files->preview_image)) {
                    unlink(storage_path('app/public/products/'.$files->file));
                    $files->update(['bx_file_id' => null, 'bx_folder_id' => null, 'url' => null, 'file' => null]);
                } else {

                    // Check folder in bitrix24 disk
                    $checkFolderExisting = $this->diskFolderGet($files->bx_folder_id);

                    if (isset($checkFolderExisting['result'])) {
                        $deleteFolder = $this->diskStorageDeleteFolderTree($checkFolderExisting['result']['ID']);
                    }

                    $files->forceDelete();
                }

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.There was a problem with bitrix file deletion') . ' Error: ' . $bxFileDelete['error_description']]);
            }

        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeProductPreviewImage(Request $request) {
        if (!empty($request->post('file_id'))) {
            $files = ProductFiles::where('id', $request->post('file_id'))->firstOrFail();

            if (!empty($files)) {
                if (!empty($files->file)) {
                    unlink(storage_path('app/public/'.$files->preview_image));
                    $files->update(['preview_image' => null]);
                } else {
                    ProductFiles::destroy($request->post('file_id'));
                }

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeTranslationServiceImage(Request $request)
    {
        if (!empty($request->post('file_id'))) {
            $translationServices = TranslationServices::findOrFail($request->post('file_id'));

            if (!empty($translationServices)) {
                unlink(storage_path('app/public/translation-services/'.$translationServices->icon));
                $translationServices->update(['icon' => null]);

                return response()->json(['status' => true, 'title' => 'Success', 'message' => __('admin.File successfully removed!')]);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
            }
        } else {
            return response()->json(['status' => false, 'title' => 'Error', 'message' => __('admin.Cannot find image!')]);
        }
    }
}
