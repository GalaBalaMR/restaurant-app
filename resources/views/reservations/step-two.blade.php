<x-guest-layout>

    {{-- blade for success reservation --}}
    <div class="section-title" id="thanks">
        <h2>Ďakujeme za tvoju <span>Rezerváciu</span></h2>
        @if(session()->has('email'))
        <p>Čaká ťa neprekonateľný zážitok. Poslali sme ti potvrdzujúci email na: 
        <strong>{{ session('email') }}</strong></p>
        @endif
    </div>
</x-guest-layout>