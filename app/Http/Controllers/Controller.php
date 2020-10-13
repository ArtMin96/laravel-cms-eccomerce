<?php

namespace App\Http\Controllers;

use App\User;
use Geocoder\Laravel\Facades\Geocoder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return |null
     */
    public function user() {
        if (\Auth::check()) {
            return User::find(\Auth::user()->id);
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getGeocode() {
        return Geocoder::geocode(getRealIP())->get();
    }

    /**
     * @return mixed
     */
    public function getGeocodeCountryCode() {
        return Geocoder::geocode(getRealIP())->get()->first()->getCountry()->getCode();
    }
}
