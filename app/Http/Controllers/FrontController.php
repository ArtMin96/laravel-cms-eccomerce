<?php

namespace App\Http\Controllers;

use Geocoder\Laravel\Facades\Geocoder;
use Illuminate\Http\Request;

class FrontController extends Controller
{

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
