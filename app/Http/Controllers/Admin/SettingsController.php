<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentGateways;
use App\PhoneNumbers;
use App\Settings;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingsController extends AdminController
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings = Settings::first();
        $paymentGateways = PaymentGateways::withTrashed()->get();

        return view('admin.settings.index', compact('settings', 'paymentGateways'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {

        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%address%' => 'required|string',
            '%footer_title%' => 'required|string',
            '%footer_description%' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            'logo_sm' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        $request->validate($rules);
        $inputs = $request->all();

        $setting = Settings::findOrFail($id);

        // Logo
        if ($request->hasFile('logo')) {

            $image = $request->file('logo');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/site');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['logo'] = $input['imagename'];
        }

        // Logo sm
        if ($request->hasFile('logo_sm')) {

            $image = $request->file('logo_sm');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/site');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['logo_sm'] = $input['imagename'];
        }

        if (!empty($request->input('phone_number'))) {

            PhoneNumbers::truncate();

            foreach ($request->input('phone_number') as $key => $number) {
                $phoneNumber = new PhoneNumbers();
                $phoneNumber->setting_id = 1;
                $phoneNumber->phone_number = $request->input('phone_number')[$key];
                $phoneNumber->is_main_number = ($key == 0) ? 1 : 0;
                $phoneNumber->save();
            }
        }

        $setting->update($inputs);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $settings = Settings::findOrFail($request->id);

        if(file_exists(asset('storage/site/'.$settings->logo))) {
            unlink(asset('storage/site/'.$settings->logo));
        }

        if(file_exists(asset('storage/site/'.$settings->logo_sm))) {
            unlink(asset('storage/site/'.$settings->logo_sm));
        }

        return response()->json(['status' => true]);
    }
}
