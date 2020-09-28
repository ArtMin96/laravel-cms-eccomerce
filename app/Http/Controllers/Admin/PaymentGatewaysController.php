<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentGateways;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PaymentGatewaysController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentGateways = PaymentGateways::all();
        return view('admin.payment-gateways.index', compact('paymentGateways'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentGateways = PaymentGateways::withTrashed()->find($id);
        return view('admin.payment-gateways.edit', compact('paymentGateways'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'public_key' => 'required|string',
            'private_key' => 'required|string',
        ]);

        $inputs = $request->all();

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/payment-gateways');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['icon'] = $input['imagename'];
        }

        $payment = PaymentGateways::withTrashed()->findOrFail($id);

        if (isset($inputs['deleted_at']) && $inputs['deleted_at'] == 1) {

            $payment->update($inputs);
            $payment->restore();
        } else {
            $payment->update($inputs);
            $payment->delete();
        }

        return redirect()->route('admin.settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $payment = PaymentGateways::findOrFail($request->id);
        $payment->delete();

        return response()->json(['status' => true]);
    }
}
