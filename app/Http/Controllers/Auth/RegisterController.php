<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
//        $this->redirectTo = redirect('/');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required_if:person_type,0', 'string', 'max:255'],
            'last_name' => ['required_if:person_type,0', 'string', 'max:255'],
            'username' => ['required_if:person_type,0', 'string', 'max:255'],
            'company' => ['required_if:person_type,1', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required_if:person_type,1', 'phone:AM'], // AM Change to $this->getGeocodeCountryCode()
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($data['person_type'] == 0) {
            $createBx24User = $this->contactAdd([
                'NAME' => $data['name'],
                'LAST_NAME' => $data['last_name'],
                'TYPE_ID' => 'CLIENT',
                'PHONE' => [
                    ['VALUE' => !empty($data['phone']) ? $data['phone'] : null, 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [
                    ['VALUE' => $data['email'], 'VALUE_TYPE' => 'WORK']
                ],
            ], [
                'REGISTER_SONET_EVENT' => 'Y'
            ]);
        } else {
            $createBx24User = $this->companyAdd([
                'TITLE' => $data['company'],
                'COMPANY_TYPE' => 'CUSTOMER',
                'OPENED' => 'Y',
                'PHONE' => [
                    ['VALUE' => $data['phone'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [
                    ['VALUE' => $data['email'], 'VALUE_TYPE' => 'WORK']
                ],
            ]);
        }

        return User::create([
            'bx_user_id' => $createBx24User['result'],
            'name' => !empty($data['name'])? $data['name'] : null,
            'last_name' => !empty($data['last_name'])? $data['last_name'] : null,
            'username' => !empty($data['username'])? $data['username'] : null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => !empty($data['phone'])? $data['phone'] : null,
            'company' => !empty($data['company'])? $data['company'] : null,
            'address' => !empty($data['address'])? $data['address'] : null,
            'contact_person' => !empty($data['contact_person'])? $data['contact_person'] : null,
            'tax_code' => !empty($data['tax_code'])? $data['tax_code'] : null,
            'person_type' => $data['person_type'],
        ]);
    }
}
