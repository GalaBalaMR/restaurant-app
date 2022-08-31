<x-admin-layout>

    <div class="d-flex justify-content-between  mb-3">
        <h1 class="display-4 border-bottom">Editovať rezerváciu</h1>
        <div class="d-flex align-items-center">        
            <a class="btn btn-success" href="{{ route('admin.reservations.index') }}">
                Prehľad rezervácii
            </a>
        </div>
    </div>

    

    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="post">
        @csrf
        @method('PUT')
      <!-- Name input -->
      <input class="form-control" type="text" name="first_name" placeholder="Meno" id="name" aria-label="default input example" value="{{ old('first_name', $reservation->first_name) }}">
      <label class="form-label mb-3" for="name">Meno</label>
      
      {{-- last name input --}}
      <input class="form-control" type="text" name="last_name" placeholder="Priezvisko" id="last_name" aria-label="default input example" value="{{ old('last_name', $reservation->last_name) }}">
      <label class="form-label mb-3" for="last_name">Priezvisko</label>
     
      {{-- email input --}}
      <input class="form-control" type="email" name="email" placeholder="Email" id="email" aria-label="default input example" value="{{ old('email', $reservation->email) }}">
      <label class="form-label mb-3" for="email">Email</label>

      {{-- telephone number input --}}
      <input class="form-control" type="tel"id="telephone_number" name="telephone_number" placeholder="Telefónne číslo" aria-label="default input example" value="{{ old('telephone_number', $reservation->telephone_number) }}">
      <label class="form-label mb-3" for="telephone_number">Telefónne číslo</label>
      
      {{-- number of guest input --}}
      <input class="form-control" type="number"id="guest_number" name="guest_number" placeholder="Počet hostí" aria-label="default input example" value="{{ old('guest_number', $reservation->guest_number) }}">
      <label class="form-label mb-3" for="price">Počet hostí</label>
      
      {{-- date of reservation input --}}
      <input class="form-control" type="datetime-local"id="res_date" name="res_date" placeholder="Dátum rezervácie" aria-label="default input example" value="{{ old('res_date', $reservation->res_date) }}">
      <label class="form-label mb-3" for="res_date">Dátum rezervácie</label>

      {{-- select for table --}}
      <select class="form-select" name="table_id" aria-label="Default select example" id="table"> 
          @foreach($tables as $table)  
              <option value="{{ $table->id }}" >{{ $table->name }}</option>
          @endforeach
      </select>
      <label class="form-label mb-3" for="table">Výber stola</label>
      
      <!-- Submit button -->
      <button type="submit" class="btn btn-primary mb-4">Vytvoriť</button>
    </form>
     
</x-admin-layout>
