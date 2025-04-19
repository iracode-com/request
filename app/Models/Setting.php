<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'address',
        'copyright',
        'site_logo',
        'site_favicon',
        'theme_color',
        'support_email',
        'support_phone',
        'google_analytics_id',
        'posthog_html_snippet',
        'seo_title',
        'seo_keywords',
        'seo_metadata',
        'email_settings',
        'email_from_address',
        'email_from_name',
        'social_network',
    ];

    protected function casts(): array
    {
        return [
            'social_network' => 'array',
            'email_settings' => 'array',
            'seo_metadata'   => 'array',
        ];
    }
}
