<x-guest-layout>
    <x-auth-card>

        <form method="POST" action="{{ route('login') }}" class="m-auto text-center mt-3" id="login-form">
            @csrf

            
            <!-- Email Address -->
            
            <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0 m-auto">
                <input type="email" class="form-control" name="email" id="email" placeholder="Tvoj Email" data-rule="email"  :value="old('email')" required autofocus>
            </div>

            <!-- Password -->
            
            <div class="col-lg-4 col-md-6 form-group mt-2 m-auto">
                <input class="form-control" id="password" placeholder="Tvoje heslo" type="password" name="password" required autocomplete="current-password" >
            </div>
            

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4 mb-3">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="book-a-table-btn border border-none">Prihlásiť sa</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
