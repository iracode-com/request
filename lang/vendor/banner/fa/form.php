<?php

return [
    'tabs' => [
        'general' => 'عمومی',
        'styling' => 'ظاهر',
        'scheduling' => 'زمانبندی',
    ],
    'fields' => [
        'id' => 'شناسه',
        'name' => 'نام',
        'content' => 'محتوا',
        'render_location' => 'محل نمایش',
        'render_location_help' => 'با تنظیم محل نمایش، می توانید انتخاب کنید که یک بنر در کجای صفحه نمایش داده شود.',
        'render_location_options' => [
            'panel' => [
                'header' => 'سر صفحه',
                'page_start' => 'شروع صفحه',
                'page_end' => 'پایان صفحه',
            ],
            'authentication' => [
                'login_form_before' => 'بالای فرم ورود',
                'login_form_after' => 'پایین فرم ورود',
                'password_reset_form_before' => 'بالای فرمت تغییر رمز عبور',
                'password_reset_form_after' => 'پایین فرم تغییر رمز عبور',
                'register_form_before' => 'بالای فرم ثبت نام',
                'register_form_after' => 'پایین فرم ثبت نام',
            ],
            'global_search' => [
                'before' => 'قبل کادر جست و جو',
                'after' => 'بعد کادر جست و جو',
            ],
            'page_widgets' => [
                'header_before' => 'قبل سر صفحه',
                'header_after' => 'بعد سر صفحه',
                'footer_before' => 'بالای فوتر',
                'footer_after' => 'پایین فوتر',
            ],
            'sidebar' => [
                'nav_start' => 'بالای منوهای پنل',
                'nav_end' => 'پایین منوهای پنل',
            ],
            'resource_table' => [
                'before' => 'بالای جداول',
                'after' => 'پایین جداول',
            ],
        ],
        'scope' => 'موقعیت',
        'scope_help' => 'موقعیت بنر در واقع محل نمایش در پنل را نشان میدهد',
        'options' => 'تنظیمات',
        'can_be_closed_by_user' => 'بنر میتواند توسط کاربر بسته شود',
        'can_truncate_message' => 'کوچک بودن محتوای بنر',
        'is_active' => 'فعال است',
        'text_color' => 'رنگ متن',
        'icon' => 'آیکون',
        'icon_color' => 'رنگ آیکون',
        'background' => 'پس زمینه',
        'background_type' => 'نوع پس زمینه',
        'background_type_solid' => 'پر رنگ',
        'background_type_gradient' => 'طیف رنگ',
        'start_color' => 'رنگ شروع',
        'end_color' => 'رنگ پایان',
        'start_time' => 'تاریخ شروع',
        'start_time_reset' => 'بازنشانی زمان شروع',
        'end_time' => 'تاریخ پایان',
        'end_time_reset' => 'بازنشانی زمان پایان',
    ],
    'badges' => [
        'scheduling_status' => [
            'active' => 'فعال',
            'scheduled' => 'زمانبندی شده',
            'expired' => 'منقضی شده',
        ],
    ],
    'actions' => [
        'help' => 'راهنما',
        'reset' => 'بازنشانی',
    ],
];
