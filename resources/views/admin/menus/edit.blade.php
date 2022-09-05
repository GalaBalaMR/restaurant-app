<x-admin-layout>
    
    <div class="d-flex justify-content-between  mb-3">
        <h1 class="display-4 border-bottom">Vytvoriť menu</h1>
        <div class="d-flex align-items-center">        
            <a class="btn btn-success" href="{{ route('admin.menus.index') }}">
                Upraviť menu
            </a>
        </div>
    </div>

    

    <form action="{{ route('admin.menus.update', $menu->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Name input -->
        <input class="form-control" type="text" name="name" placeholder="Meno" id="name" aria-label="default input example" value="{{ old('name', $menu->name) }}">
        <label class="form-label mb-3" for="namecategory">Meno menu</label>
        
        <input class="form-control" type="number" min="0.00" max="10000.00" step="0.01" id="price" name="price" placeholder="Cena" aria-label="default input example" value="{{ old('price', $menu->price) }}">
        <label class="form-label mb-3" for="price">Cena Menu</label>

      
        <!-- Description input -->
        <div class="form-outline mb-4">
          <textarea class="form-control" id="description"  placeholder="Opis" rows="3" name="description">{{ old('description', $menu->description) }}</textarea>
          <label class="form-label" for="description">Opis menu</label>
        </div>

        <!-- Ingredients input -->
        <div class="form-outline mb-4">
            <textarea class="form-control" id="ingredientsmenu"  placeholder="Opis" rows="3" name="ingredients">{{ old('description', $menu->ingredients) }}</textarea>
            <label class="form-label" for="ingredientsmenu">Ingrediencie menu</label>
        </div>

        {{-- Old image --}}
        <div class="">
            <img src="{{ Storage::url($menu->image) }}" class="img-thumbnail m-auto mb-2" alt="">
        </div>

        <div class="input-group mb-1">
            <input type="file" class="form-control" id="inputGroupFile02" name="image">
            <label class="input-group-text" for="inputGroupFile02">Vybrať obrázok</label>
        </div>

        <select class="form-select" name="categories[]" aria-label="Default select example" multiple>
            
            @foreach($categories as $category)
                <option value="{{ $category->id }}" >{{ $category->name }}</option>
            @endforeach
          </select>

        
      
       
      
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mb-4">Editovať</button>
      </form>

</x-admin-layout>