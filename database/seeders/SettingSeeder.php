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
        $settings = [
            [
                'key' => 'site_name',
                'group' => 'general',
                'type' => 'text',
                'label' => 'Site Name',
                'value' => 'CompresslyPro',
                'description' => 'The name of the site used in titles and text.',
            ],
            [
                'key' => 'site_description',
                'group' => 'general',
                'type' => 'textarea',
                'label' => 'Site Description',
                'value' => 'Free online image compression and conversion tools.',
                'description' => 'Default meta description for the site.',
            ],
            [
                'key' => 'header_menu',
                'group' => 'navigation',
                'type' => 'json',
                'label' => 'Header Menu Links',
                'value' => json_encode([
                    ['label' => 'Compress', 'url' => '/tools/compress'],
                    ['label' => 'Convert', 'url' => '/tools/convert'],
                    ['label' => 'Resize', 'url' => '/tools/resize'],
                    ['label' => 'PDF', 'url' => '/tools/image-to-pdf'],
                    ['label' => 'Blog', 'url' => '/blog'],
                ]),
                'description' => 'Array of links for the top navigation.',
            ],
            [
                'key' => 'footer_menu',
                'group' => 'navigation',
                'type' => 'json',
                'label' => 'Footer Links',
                'value' => json_encode([
                    ['label' => 'About Us', 'url' => '/about'],
                    ['label' => 'Contact', 'url' => '/contact'],
                    ['label' => 'Privacy Policy', 'url' => '/privacy-policy'],
                    ['label' => 'Terms of Service', 'url' => '/terms'],
                ]),
                'description' => 'Array of links for the footer.',
            ],
            [
                'key' => 'ads_enabled',
                'group' => 'ads',
                'type' => 'boolean',
                'label' => 'Enable Google Ads',
                'value' => json_encode(false),
                'description' => 'Toggle Ads on or off site-wide.',
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
