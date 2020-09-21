<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PhoneNumbers;
use App\Settings;
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
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
//        dd($request);
        $setting = Settings::findOrFail($id);
        $settings = [
            'en' => [
                'title' => $request->input('en_title'),
                'address' => $request->input('en_address'),
                'footer_title' => $request->input('en_footer_title'),
                'footer_description' => $request->input('en_footer_description')
            ],
            'ru' => [
                'title' => $request->input('ru_title'),
                'address' => $request->input('ru_address'),
                'footer_title' => $request->input('ru_footer_title'),
                'footer_description' => $request->input('ru_footer_description')
            ],
            'hy' => [
                'title' => $request->input('hy_title'),
                'address' => $request->input('hy_address'),
                'footer_title' => $request->input('hy_footer_title'),
                'footer_description' => $request->input('hy_footer_description')
            ],
            'viber' => $request->input('viber'),
            'whatsapp' => $request->input('whatsapp'),
            'map_html' => $request->input('map_html'),
        ];

        // Logo
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid()) {

                $this->validate($request, [
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
                ]);
            }
            $image = $request->file('logo');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/site');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $settings['logo'] = $input['imagename'];
        }

        // Logo sm
        if ($request->hasFile('logo_sm')) {
            if ($request->file('logo_sm')->isValid()) {

                $this->validate($request, [
                    'logo_sm' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
                ]);
            }
            $image = $request->file('logo_sm');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/site');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $settings['logo_sm'] = $input['imagename'];
        }

        if (!empty($request->input('phone_number'))) {

            PhoneNumbers::truncate();

            foreach ($request->input('phone_number') as $key => $number) {
//                $validate = $request->validate([
//                    'phone_number' => 'phone:AM'
//                ]);

                $phoneNumber = new PhoneNumbers();
                $phoneNumber->setting_id = 1;
                $phoneNumber->phone_number = $request->input('phone_number')[$key];
                $phoneNumber->is_main_number = ($key == 0) ? 1 : 0;
                $phoneNumber->save();
            }
        }

        $setting->update($settings);

        return redirect()->back();
    }

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
