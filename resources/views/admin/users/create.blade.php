<x-admin-layout>
    
    <div class="d-flex justify-content-between  mb-3">
        <h1 class="display-4 border-bottom">Vytvoriť uživateľa</h1>
        <div class="d-flex align-items-center">        
            <a class="btn btn-success" href="{{ route('admin.users.index') }}">
                Prehľad používateľov
            </a>
        </div>
    </div>

    

    <form action="{{ route('admin.users.store') }}" method="post">
        @csrf
        
      
        <!-- Name input -->
        <input class="form-control" type="text" name="name" placeholder="Meno" id="name" aria-label="default input example">
        <label class="form-label mb-3" for="name">Meno uživateľa</label>
        
        {{-- number of guest input --}}
        <input class="form-control" type="email" name="email" id="email" placeholder="Email" aria-label="default input example">
        <label class="form-label mb-3" for="email">Email</label>
        
        {{-- password input --}}
        <input class="form-control" type="password" name="password" id="password" placeholder="Heslo" aria-label="default input example">
        <label class="form-label mb-3" for="password">Heslo</label>

        
        {{-- select for roles --}}
        <select class="form-select" name="role" aria-label="Default select example" multiple>
            @foreach( $roles as $role)
                <option value="{{ $role->name }}" >{{ $role->name }}</option>
            @endforeach
        </select>
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mb-4">Vytvoriť</button>
      </form>

     
</x-admin-layout>
