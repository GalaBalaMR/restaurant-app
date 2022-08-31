<x-admin-layout>
    
    <div class="d-flex justify-content-between  mb-3">
        <h1 class="display-4 border-bottom">Editovať stôl</h1>
        <div class="d-flex align-items-center">        
            <a class="btn btn-success" href="{{ route('admin.tables.index') }}">
                Editovať stôl
            </a>
        </div>
    </div>

    

    <form action="{{ route('admin.tables.update', $table->id) }}" method="post">
        @csrf
        @method('PUT')
      
        <!-- Name input -->
        <input class="form-control" type="text" name="name" placeholder="Meno" id="name" aria-label="default input example" value="{{ old('name', $table->name) }}">
        <label class="form-label mb-3" for="name">Meno stolu</label>
        
        <input class="form-control" type="number"id="guest_number" name="guest_number" placeholder="Počet hostí" aria-label="default input example" value="{{ old('guest_number', $table->guest_number) }}">
        <label class="form-label mb-3" for="price">Počet hostí</label>

        <select class="form-select" name="status" aria-label="Default select example"> 
            @foreach(config('enums.TableStatus') as $value)  
            <option value="{{ $value }}" >{{ $value }}</option>
        @endforeach
        </select>
        <label class="form-label mb-3" for="status">Status</label>


        <select class="form-select" name="location" aria-label="Default select example"> 
            @foreach(config('enums.TableLocation') as $value)  
                <option value="{{ $value }}" >{{ $value }}</option>
            @endforeach
        </select>
        <label class="form-label mb-3" for="location">Lokácia stola</label>
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mb-4">Editovať</button>
      </form>

     
</x-admin-layout>
