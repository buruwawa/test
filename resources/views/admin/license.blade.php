<x-guest-layout>
    <x-jet-authentication-card alert alert-warning>
        <x-slot name="logo">
            <span class="brand-text"><img style="height: 60px;" alt="Logo"
                src="../../assets/images/misc/logo.svg" /></span>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div></div>
        <h1 class="text-danger">License error</h1>
        <p>Sorry! your license is not active</p>
        <p>Activate your account
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="https://moxa.co.tz/#services">
                {{ __('Activate Now') }}
            </a>
            </p>
        <p>Or contact support desk +255757</p>
    </x-jet-authentication-card>
</x-guest-layout>
