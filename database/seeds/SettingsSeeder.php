<?php

use App\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'en' => [
                'title' => 'Gaudeamus',
                'address' => '42 Tumanyan St, Yerevan 0002, Армения',
                'footer_title' => 'Gaudeamus Translation and Interpretation',
                'footer_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type.',
            ],
            'ru' => [
                'title' => 'Gaudeamus',
                'address' => '42 Tumanyan St, Yerevan 0002, Армения',
                'footer_title' => 'Gaudeamus Translation and Interpretation',
                'footer_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type.',
            ],
            'hy' => [
                'title' => 'Gaudeamus',
                'address' => '42 Թումանյան փողոց, Երևան 0002',
                'footer_title' => 'Gaudeamus Translation and Interpretation',
                'footer_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type.',
            ],
            'logo' => 'company-logo.jpg',
            'logo_sm' => 'company-logo-sm.jpg',
            'email' => 'info@gaudeamus.com',
            'viber' => '+37411 56 16 78',
            'whatsapp' => '+37411 56 16 78',
            'map_html' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3047.9728804019132!2d44.508568315831866!3d40.18741697939238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abd1db4502f61%3A0x6e9670a2876e4843!2zR2F1ZGVhbXVzIFRyYW5zbGF0aW9uICYgSW50ZXJwcmV0YXRpb24v1LnVodaA1aPVtNWh1bbVudWh1a_VodW2INWu1aHVvNWh1bXVuNaC1anVtdW41oLVttW21aXWgA!5e0!3m2!1sru!2s!4v1600120477745!5m2!1sru!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>',
        ]);
    }
}
