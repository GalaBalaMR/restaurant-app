<x-admin-layout>

    
    <div class="d-flex justify-content-between  mb-3">
        <h1 class="display-4 border-bottom">Editovať kategóriu</h1>
        <div class="d-flex align-items-center">        
            <a class="btn btn-success" href="{{ route('admin.categories.index') }}">
                Prehľad kategórií
            </a>
        </div>
    </div>

    

    <form action="{{ route('admin.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
      
        <!-- Name input -->
        <input class="form-control" type="text" name="name" placeholder="Meno" id="namecategory" aria-label="default input example" value="{{ old('name', $category->name) }}">
        <label class="form-label mb-3" for="namecategory">Meno kategórie</label>

      
        <!-- Description input -->
        <div class="form-outline mb-4">
          <textarea class="form-control" id="descriptioncategory" rows="4" name="description">{{ old('description', $category->description) }}</textarea> 
          
          <label class="form-label" for="descriptioncategory">Opis kategórie</label>
        </div>
        <div class="">
            <img src="{{ Storage::url($category->image) }}" style="width: 200px" class="img-thumbnail m-auto mb-2" alt="">
        </div>

        <div class="input-group mb-1">
            <input type="file" class="form-control" id="inputGroupFile02" name="image">
        </div>
      
       
      
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mb-4">Editovať</button>
      </form>

</x-admin-layout>