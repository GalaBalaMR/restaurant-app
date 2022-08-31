<x-admin-layout>
    
    <div class="d-flex justify-content-between  mb-3">
        <h1 class="display-4 border-bottom">Vytvoriť menu</h1>
        <div class="d-flex align-items-center">        
            <a class="btn btn-success" href="{{ route('admin.menus.index') }}">
                Prehľad menu
            </a>
        </div>
    </div>

    

    <form action="{{ route('admin.menus.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
      
        <!-- Name input -->
        <input class="form-control" type="text" name="name" placeholder="Meno" id="name" aria-label="default input example">
        <label class="form-label mb-3" for="namecategory">Meno menu</label>
        
        <input class="form-control" type="number" min="0.00" max="10000.00" step="0.01" id="price" name="price" placeholder="Cena" aria-label="default input example">
        <label class="form-label mb-3" for="price">Cena Menu</label>

      
        <!-- Description input -->
        <div class="form-outline mb-4">
          <textarea class="form-control" id="descriptioncategory"  placeholder="Opis" rows="3" name="description"></textarea>
          <label class="form-label" for="descriptioncategory">Opis menu</label>
        </div>

        {{-- choose image input --}}
        <div class="input-group mb-1">
            <input type="file" class="form-control" id="inputGroupFile02" name="image">
        </div>

        {{-- select for category of food --}}
        <select class="form-select" name="categories[]" aria-label="Default select example" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" >{{ $category->name }}</option>
            @endforeach
        </select>

        
      
       
      
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mb-4">Vytvoriť</button>
      </form>

     
</x-admin-layout>
