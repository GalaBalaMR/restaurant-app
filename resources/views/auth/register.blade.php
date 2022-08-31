<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="m-auto text-center mt-3" id="register-form">
            @csrf

            <!-- Name -->
            
            <div class="col-lg-4 col-md-6 form-group mt-3 m-auto">
                <input type="text" class="form-control" name="name" id="name" placeholder="Tvoje Meno" data-rule="name"  :value="old('name')" required autofocus>
            </div>

            <!-- Email Address -->
            
            <div class="col-lg-4 col-md-6 form-group mt-3 m-auto">
                <input type="email" class="form-control" name="email" id="email" placeholder="Tvoj Email" data-rule="email"  :value="old('email')" required>
            </div>
            

            <!-- Password -->
            
            <div class="col-lg-4 col-md-6 form-group mt-3 m-auto">
                <input type="password" class="form-control" name="password" id="password" placeholder="Tvoje Heslo" :value="old('password')" required autocomplete="new-password">
            </div>

            <!-- Confirm Password -->
            
            <div class="col-lg-4 col-md-6 form-group mt-3 m-auto">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Potvrď heslo" required>
            </div>

            <div class="flex items-center justify-end mt-4 mb-3">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button type="submit" class="book-a-table-btn border border-none">Registrovať sa</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
