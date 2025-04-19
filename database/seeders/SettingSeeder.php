<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::query()->create([
            'site_name'        => 'شرکت ایراکد',
            'site_description' => 'شرکت ایراکد',
            'address'          => 'تهران',
            'site_logo'        => 'images/site_logo.png',
            'site_favicon'     => 'images/site_logo.png',
            'theme_color'      => '#0A4071',
            'support_email'    => 'info@iracode.com',
            'support_phone'    => '021000000',
            'copyright'        => 'تمامی حقوق متعلق به شرکت ایراکد می باشد.',
            'social_network'   => [
                'whatsapp'  => 'https://api.whatsapp.com/send?phone=',
                'instagram' => null,
                "youtube"   => null,
                "facebook"  => null,
                "linkedin"  => null,
                "telegram"  => null,
                "pinterest" => null,
                "x_twitter" => null
            ],
            'seo_title'        => 'شرکت ایراکد',
            'seo_keywords'     => 'شرکت ایراکد',
        ]);
    }
}
