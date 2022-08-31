<x-guest-layout>
<!-- ======= Book A Table Section ======= -->
<section id="book-a-table" class="book-a-table">
    <div class="container">

      <div class="section-title" id="reservation-step-one">
        <h2>Book a <span>Table</span></h2>
        <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
      </div>

      <form action="{{ route('reservations.store.step.one') }}" method="post" id="reservation-form" >
        @csrf
        <div class="row">

          <div class="col-lg-4 col-md-6 form-group">
            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Tvoje Meno" data-rule="minlen:4"value="{{ old('first_name') }}">
          </div>
          
          <div class="col-lg-4 col-md-6 form-group">
            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Tvoje Priezvisko"   value="{{ old('last_name') }}">
          </div>

          <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Tvoj Email" data-rule="email"  value="{{ old('email') }}">
          </div>

          <div class="col-lg-4 col-md-6 form-group mt-3 ">
            <input type="tel" class="form-control" name="telephone_number" id="phone" placeholder="Tvoje Číslo" data-msg="Vlož číslo" value="{{ old('telephone_number') }}">
          </div>

          <div class="col-lg-4 col-md-6 form-group mt-3">
            <input type="datetime-local" class="form-control"  id="res_date" name="res_date" placeholder="Dátum Rezervácie" data-rule="minlen:4"  value="{{ old('res_date') }}">
          </div>

          <div class="col-lg-4 col-md-6 form-group mt-3">
            <input type="number" class="form-control" name="guest_number" id="people" placeholder="# počet hostí" data-rule="minlen:1"  value="{{ old('guest_number') }}"> 
          </div>

          {{-- select for table --}}
          <div class="col-lg-4 col-md-6 form-group mt-3">
            <select class="form-select @error('table_id') border-danger @enderror" name="table_id" aria-label="Default select example" id="table"> 
                @foreach($tables as $table)  
                    <option class="form-control" value="{{ $table->id }}" >{{ $table->name }} ({{ $table->guest_number }})</option>
                @endforeach
            </select>
          </div>

            {{-- show which terms is reserver --}}
          @foreach($tables as $table)
            <div class="row row-table" id="table-{{ $table->id }}">
            
                <p class="m-1" > <strong>{{ $table->name; }} - prehľad rezervácií</strong></p> 
                <ul class="d-flex justify-content-start flex-wrap">
                @foreach($table->reservations->sortByDesc('res_date')->reverse() as $res)
                    @if(\Carbon\Carbon::parse($res->res_date)->format('m d, H') > $now)
                        <li class="border p-2 list-group-item">{{ \Carbon\Carbon::parse($res->res_date)->translatedFormat('F d, H') }}:00</li>
                    @endif
                    
                @endforeach
                </ul>
            </div>
          @endforeach

          <label class="form-label mb-3" for="table">Výber stola</label>
          </div>
          </div>
          <div class="text-center"><button type="submit">Uložiť rezerváciu</button></div>
        </form>

    </div>
  </section><!-- End Book A Table Section -->



</x-guest-layout>