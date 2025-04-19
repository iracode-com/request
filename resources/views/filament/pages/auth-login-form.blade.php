@env('local')
    <x-filament::dropdown placement="top-start">
        <x-slot name="trigger">
            <x-filament::button
                    color="gray"
                    icon="heroicon-o-chevron-up-down"
                    class="w-full justify-between"
                    icon-position="after"
                    outlined
            >ورود به عنوان
            </x-filament::button>
        </x-slot>

        <x-filament::dropdown.list>
            <x-filament::dropdown.list.item>
                <x-login-link email='cbiha@expert.com' label='کارشناس فنی'/>
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item>
                <x-login-link email='cbiha@auditor.com' label='ممیز'/>
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item>
                <x-login-link email='cbiha@super-auditor.com' label='سرممیز'/>
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item>
                <x-login-link email='cbiha@technical-manager.com' label='مدیر فنی'/>
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item>
                <x-login-link email='cbiha@technical-reviewer.com' label='بازبین فنی'/>
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item>
                <x-login-link email='cbiha@manager.com' label='مدیر عامل'/>
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item>
                <x-login-link email='cbiha@admin.com' label='مدیر سیستم'/>
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
@endenv
