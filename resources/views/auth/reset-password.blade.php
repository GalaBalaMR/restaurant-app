<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <h1 class="text-warning text-center">Resetovanie hesla</h1>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="col-lg-4 col-md-6 form-group m-auto">
                <x-input id="email" class="form-control mt-3" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="col-lg-4 col-md-6 form-group m-auto">

                <x-input id="password" class="form-control mt-3" type="password" name="password" placeholder="Tvoje heslo" required />
            </div>

            <!-- Confirm Password -->
            <div class="col-lg-4 col-md-6 form-group m-auto">

                <x-input id="password_confirmation" class="form-control mt-3"
                                    placeholder="Zopakuj heslo"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <button type="submit" class="book-a-table-btn border border-none d-block m-auto mt-2">Zmeniť heslo</button>
        </form>
    </x-auth-card>
</x-guest-layout>
