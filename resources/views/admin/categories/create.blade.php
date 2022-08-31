<x-admin-layout>
    
    <div class="d-flex justify-content-between  mb-3">
        <h1 class="display-4 border-bottom">Vytvoriť kategóriu</h1>
        <div class="d-flex align-items-center">        
            <a class="btn btn-success" href="{{ route('admin.categories.index') }}">
                Prehľad kategórií
            </a>
        </div>
    </div>

    

    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
      
        <!-- Name input -->
        <input class="form-control" type="text" name="name" placeholder="Meno" id="namecategory" aria-label="default input example">
        <label class="form-label mb-3" for="namecategory">Meno kategórie</label>

      
        <!-- Description input -->
        <div class="form-outline mb-4">
          <textarea class="form-control" id="descriptioncategory"  placeholder="Opis" rows="3" name="description"></textarea>
          <label class="form-label" for="descriptioncategory">Opis kategórie</label>
        </div>

        <div class="input-group mb-1">
            <input type="file" class="form-control" id="inputGroupFile02" name="image">
            <label class="input-group-text" for="inputGroupFile02">Vybrať obrázok</label>
        </div>
      
       
      
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mb-4">Vytvoriť</button>
      </form>

</x-admin-layout>
