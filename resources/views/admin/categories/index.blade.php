<x-admin-layout>
    
        <div class="d-flex justify-content-between m-auto col-9">
            <h1>Kategórie</h1>
            <div>          
              <a class="btn btn-success" href="{{ route('admin.categories.create') }}">Vytvoriť kategóriu</a>
            </div>
        </div>

        
        
        <div class="row col-9 m-auto">
            <table class="table table-striped table-hover text-center d-none d-md-table">
                <thead>
                  <tr>
                    <th scope="col" class="col-2">Name</th>
                    <th scope="col" class="col-2">Description</th>
                    <th scope="col" class="col-2">Image</th>
                    <th scope="col" class="col-2"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td><img class="img-thumbnail" src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" style="height: 100px; width: 150px;"></td>
                    <td class="align-middle">
                      <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning me-2">Editovať</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                              method="POST"
                              onsubmit="return confirm('Určite chceš vymazať?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Vymazať</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>

        <div class="row d-sm-none">
          @foreach($categories as $menu)
          <div class="card m-auto mt-2" style="width: 18rem;">
            <img src="{{ Storage::url($category->image) }}" class="card-img mt-2" alt="...">
            <div class="card-body">
              <h5 class="card-title"><strong>{{ $category->name }}</strong></h5>
              <p class="card-text">{{ $category->description }}</p>
              <div class="d-flex justify-content-center">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning me-2">Editovať</a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                      method="POST"
                      onsubmit="return confirm('Určite chceš vymazať?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Vymazať</button>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    
</x-admin-layout>
