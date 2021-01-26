<?php

use Illuminate\Database\Seeder;

class PaymentGatewaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gateways = [
            [
                'name' => 'PayPal',
                'icon' => 'paypal.png',
                'public_key' => 'Khjdi878dhjsiaaA4oosdEee%6uhsj',
                'private_key' => 'Khjdi878dhjsiaaA4oosdEee%6uhsj',
            ],
            [
                'name' => 'Ineco Bank',
                'icon' => 'visa-master.png',
                'public_key' => 'Khjdi878dhjsiaaA4oosdEee%6uhsj',
                'private_key' => 'Khjdi878dhjsiaaA4oosdEee%6uhsj',
            ],
        ];

        foreach ($gateways as $key => $gateway) {
            \App\PaymentGateways::create($gateway);
        }
    }
}
