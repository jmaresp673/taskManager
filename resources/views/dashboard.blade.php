<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-main-container>
            <x-secondary-container>
                <x-text>
                    You're logged in!
                </x-text>
            </x-secondary-container>
        </x-main-container>
    </div>
</x-app-layout>
