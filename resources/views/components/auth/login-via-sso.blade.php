<div class="relative flex items-center justify-center text-center">
    <div class="absolute border-t border-gray-200 w-full h-px"></div>
    <p class="inline-block relative bg-gray-50 text-sm p-2 rounded-md font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-100">
        {{ __('Or login via') }}
    </p>
</div>

<div class="grid gap-4">
    <x-filament::button
            color="primary"
            :outlined="true"
            tag="a"
            {{-- href="https://iracode.com" --}}
            :href="route('auth.sso.login')"
            :spa-mode="false"
            target="_blank"
    >
           <span class="flex gap-2 justify-center items-center">
                <img src="{{ Vite::asset('resources/assets/images/iracode.webp') }}" alt="iracode" class="w-8 h-8">
            پنجره هوشمند ایراکد من
           </span>
    </x-filament::button>
</div>
