<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="text-center col-lg-8 col-sm-10 m-auto mt-3">
            {{ __('Zabudol si heslo? Žiadny problém, pošleme ti email s reset linkom') }}
        </div>

        <!-- Session Status -->
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}" class="m-auto text-center mt-3">
            @csrf

            <!-- Email Address -->
            <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0 m-auto">
                <input type="email" class="form-control" name="email" id="email" placeholder="Tvoj Email" data-rule="email"  :value="old('email')" required autofocus>
            </div>

            
            <button type="submit" class="book-a-table-btn border border-none mt-3">Resetovať heslo</button>
            
        </form>
    </x-auth-card>
</x-guest-layout>
