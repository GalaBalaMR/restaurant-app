<x-admin-layout>
    
    <div class="d-flex justify-content-between  mb-3">
        <h1 class="display-4 border-bottom">Vytvoriť rezerváciu</h1>
        <div class="d-flex align-items-center">        
            <a class="btn btn-success" href="{{ route('admin.reservations.index') }}">
                Prehľad rezervácií
            </a>
        </div>
    </div>

    

    <form action="{{ route('admin.reservations.store') }}" method="post">
        @csrf
        
      
        <!-- Name input -->
        <input class="form-control @error('first_name') border-danger @enderror" type="text" name="first_name" placeholder="Meno" id="name" aria-label="default input example" 
        value="{{ old('first_name') }}">
        <label class="form-label mb-3" for="name">Meno</label>
        
        {{-- last name input --}}
        <input class="form-control @error('last_name') border-danger @enderror" type="text" name="last_name" placeholder="Priezvisko" id="last_name" aria-label="default input example"
        value="{{ old('last_name') }}">
        <label class="form-label mb-3" for="last_name">Priezvisko</label>
       
        {{-- email input --}}
        <input class="form-control @error('email') border-danger @enderror" type="email" name="email" placeholder="Email" id="email" aria-label="default input example"
        value="{{ old('email') }}">
        <label class="form-label mb-3" for="email">Email</label>

        {{-- telephone number input --}}
        <input class="form-control @error('telephone_number') border-danger @enderror" type="tel"id="telephone_number" name="telephone_number" placeholder="Telefónne číslo" aria-label="default input example" value="{{ old('telephone_number') }}">
        <label class="form-label mb-3" for="telephone_number">Telefónne číslo</label>
        
        {{-- number of guest input --}}
        <input class="form-control @error('guest_number') border-danger @enderror" type="number"id="guest_number" name="guest_number" placeholder="Počet hostí" aria-label="default input example"
        value="{{ old('guest_number') }}">
        <label class="form-label mb-3" for="price">Počet hostí</label>
        
        {{-- date of reservation input --}}
        <input class="form-control @error('res_date') border-danger @enderror" type="datetime-local" id="res_date" name="res_date" placeholder="Dátum rezervácie" aria-label="default input example"
        value="{{ old('res_date') }}" min="{{ $min }}" max="{{ $max }}">
        <label class="form-label mb-3" for="res_date">Dátum rezervácie</label>

        {{-- select for table --}}
        <select class="form-select @error('table_id') border-danger @enderror" name="table_id" aria-label="Default select example" id="table"> 
            @foreach($tables as $table)  
                <option value="{{ $table->id }}" >{{ $table->name }} ({{ $table->guest_number }})</option>
            @endforeach
        </select>
        {{-- show which terms is reserver --}}
        @foreach($tables as $table)
        <div class="row row-table" id="table-{{ $table->id }}">
        
            <p class="m-1" > <strong>{{ $table->name; }} - prehľad rezervácií</strong></p> 
            <ul class="d-flex justify-content-start flex-wrap">
            @foreach($table->reservations->sortByDesc('res_date')->reverse() as $res)
                @if(\Carbon\Carbon::parse($res->res_date)->format('m d, H') > $now )
                    <li class="border p-2">{{ \Carbon\Carbon::parse($res->res_date)->translatedFormat('F d, H') }}:00 </li>
                @endif
                
            @endforeach
            </ul>

        
        </div>
        @endforeach

        <label class="form-label mb-3" for="table">Výber stola</label>
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mb-4">Vytvoriť</button>
      </form>

</x-admin-layout>
