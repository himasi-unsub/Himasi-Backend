<x-guest-layout>
    <x-mary-card title="{{ __('Log in') }}" subtitle="{{ __('Log in to your account using your email and password.') }}"
        class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900"
        shadow separator progress-indicator>

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg">

            <x-validation-errors class="mb-4" />

            @session('status')
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
            @endsession

            <x-mary-form method="POST" action="{{ route('login') }}" no-separator wire:submit="login">
                @csrf

                <div>
                    <x-mary-input label="{{ __('Email') }}" id="email" class="block w-full mt-1" type="email"
                        name="email" wire:model="email" :value="old('email')" required autofocus
                        autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-mary-password label="{{ __('Password') }}" id="password" class="block w-full mt-1"
                        type="password" wire:model="password" name="password" required autocomplete="current-password"
                        right />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-mary-checkbox label="{{ __('Remember me') }}" id="remember_me" name="remember" />
                    </label>
                </div>

                <x-slot:actions class="flex items-center justify-end mt-4 align-middle">
                    @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                    <x-mary-button class="ms-4" type="submit" spinner="login">
                        {{ __('Log in') }}
                    </x-mary-button>
                </x-slot:actions>
            </x-mary-form>
        </div>
    </x-mary-card>
</x-guest-layout>