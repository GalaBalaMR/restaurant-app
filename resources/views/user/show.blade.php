
<x-guest-layout>

    <!-- ======= User Reservation ======= -->
    <section id="user-reservation" class="menu">

        <div class="container">
  
          <div class="section-title">
            <h2>Prehľad rezervácií <span>{{ auth()->user()->name }}</span></h2>
          </div>
  
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
              <ul id="menu-flters">
                <li data-filter="*" class="filter-active">Show All</li>
                <li data-filter=".filter-new">Nové rezervácie</li>
                <li data-filter=".filter-old">Staré rezervácie</li>
              </ul>
            </div>
          </div>
  
          <div class="row menu-container">

            @foreach($reservations as $res)

            @if(\Carbon\Carbon::parse($res->res_date)->format('m d, H') > $now)
              <div class="col-lg-6 menu-item filter-new">
            @else
              <div class="col-lg-6 menu-item filter-old">
            @endif
                <div class="menu-content">
                    <a>Dátum rezervácie: {{ \Carbon\Carbon::parse($res->res_date)->translatedFormat('F d, H') }}:00</a>
                </div>
                <div class="menu-ingredients">
                    {{ $res->table->name}} a počet hostí: {{ $res->guest_number }}
                </div>
            </div>
            @endforeach
        </div>
  
        </div>
    </section><!-- End User Reservation Section -->

</x-guest-layout>