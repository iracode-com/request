@php
    $setting = \App\Models\Setting::first();
    $currentRouteName = \Request::route()->getName();
    $mustRenderedSectionByRouteName = !in_array($currentRouteName, [
        'filament.admin.auth.login',
        'filament.admin.auth.register',
    ]);

@endphp
@if($mustRenderedSectionByRouteName)
    <footer class="bottom-0 text-sm left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow flex items-center justify-center md:p-6 dark:bg-gray-800 dark:border-gray-600">
        @if($setting?->site_logo)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($setting->site_logo) }}" class="mx-1" width="32" height="32" alt="footer_logo" />
        @endif
        <span class="text-gray-500 sm:text-center dark:text-gray-400">
            {{ $setting?->copyright ?? "سازمان جهاد کشاورزی" }}
        </span>
        @if($setting?->support_email && $setting?->support_phone)
            <div class="bottom-0 text-sm text-gray-500 z-20 bg-white flex items-center justify-center md:p-6 dark:bg-gray-800 dark:border-gray-600">
                {{ __("Contact Info") . " : " . $setting?->support_email . ' - ' . $setting?->support_phone }}
            </div>
        @endif
    </footer>
@endif