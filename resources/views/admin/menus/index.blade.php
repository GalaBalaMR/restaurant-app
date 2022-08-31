<x-admin-layout>
  
  <div class="d-flex justify-content-between m-auto col-9">
    <h1>Menu</h1>
    <div>          
      <a class="btn btn-success" href="{{ route('admin.menus.create') }}">Vytvoriť menu</a>
    </div>
  </div>

    
    
  <div class="row col-12 col-md-10 m-auto">
        <table class="table table-striped table-hover text-center d-none d-md-table">
            <thead>
              <tr>
                <th scope="col" class="col-">Name</th>
                <th scope="col" class="col-">Description</th>
                <th scope="col" class="col-">Price</th>
                <th scope="col" class="col-">Image</th>
                <th scope="col" class="col-"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($menus as $menu)
              <tr class="">
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->description }}</td>
                <td>{{ $menu->price }}</td>
                <td><img class="img-thumbnail" src="{{ Storage::url($menu->image) }}" alt="{{ $menu->name }}" style="height: 100px; width: 150px;"></td>
                <td class="align-lg-middle">
                  <div class="d-sm-flex flex-sm-column flex-lg-row justify-content-center">
                    <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-warning me-2">Editovať</a>
                    <form action="{{ route('admin.menus.destroy', $menu->id) }}"
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
      @foreach($menus as $menu)
      <div class="card m-auto" style="width: 18rem;">
        <img src="{{ Storage::url($menu->image) }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><strong>{{ $menu->name }}</strong></h5>
          <h6 class="card-subtitle mb-2">Kategória: 
            @foreach($menu->categories as $cat)
              <strong>{{ $cat->name }}</strong>
            @endforeach
          </h6>
          <h6 class="card-subtitle mb-2 text-muted">{{ $menu->price }} €</h6>
          <p class="card-text">{{ $menu->description }}</p>
          <div class="d-flex justify-content-center">
            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-warning me-2">Editovať</a>
            <form action="{{ route('admin.menus.destroy', $menu->id) }}"
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
