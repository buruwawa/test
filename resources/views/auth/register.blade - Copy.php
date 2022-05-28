<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <span class="brand-text"><img style="height: 60px;" alt="Logo"
                src="../../assets/images/misc/logo.svg" /></span>
        </x-slot>

   <div>
                              @if($message= Session::get('success'))
<div class="alert alert-success" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
    <span aria-hidden="true">&times;</span></button>
    <strong>Well done!</strong> {{ $message }}
</div>
@endif
@if($message= Session::get('delete'))
<div class="alert alert-danger" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
    <span aria-hidden="true">&times;</span></button>
    <strong>Attention!</strong> {{ $message }}
</div>
@endif
@if($message= Session::get('error'))

<div class="alert alert-danger" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
    <span aria-hidden="true">&times;</span></button>
    <strong>Sorry!</strong> {{ $message }}
</div>
@endif
{{-- Validation error message --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
            </div>
            <hr>
        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('user-register.store') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Full Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
              <div>
                <x-jet-label for="department" value="{{ __('Department') }}" />
 <select name="department" id="department" class="block mt-1 w-full" required>
                        <option value="">--- Select Department ---</option>
                            @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->department_name}}</option>

                            @endforeach
                        </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
