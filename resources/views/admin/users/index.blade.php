<x-admin-layout>
  
  <div class="d-flex justify-content-between m-auto col-9">
    <h1>Používatelia</h1>
    @hasanyrole('Manager|Admin')
    <div>          
      <a class="btn btn-success" href="{{ route('admin.users.create') }}">Vytvoriť uživateľa</a>
    </div>
    @endhasanyrole
  </div>

  
  
  <div class="row col-9 m-auto">
    <table class="table table-striped table-hover text-center d-none d-md-table">
      <thead>
        <tr>
          <th scope="col" class="col-2">Meno</th>
          <th scope="col" class="col-2">Email</th>
          <th scope="col" class="col-2">Rola</th>
          <th scope="col" class="col-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->getRoleNames() }}
          <td class="align-middle">
            <div class="d-flex justify-content-center">
              <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning me-2">Editovať</a>
              @hasanyrole('Admin')
              <form action="{{ route('admin.users.destroy', $user->id) }}"
                    method="POST"
                    onsubmit="return confirm('Určite chceš vymazať?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Vymazať</button>
              </form>
              @endhasanyrole
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="row d-sm-none">
    @foreach($users as $user)
    <div class="card m-auto mt-2 text-center" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title"><strong>{{ $user->name }}</strong></h5>
        <h6 class="card-subtitle mb-2 text-muted">Meno: {{ $user->email }}</h6>
        <p class="card-text">Umiestnenie: {{ $user->getRoleNames() }}</p>
        <div class="d-flex justify-content-center">
          <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning me-2">Editovať</a>
          @hasanyrole('Manager|Admin')
          <form action="{{ route('admin.users.destroy', $user->id) }}"
                method="POST"
                onsubmit="return confirm('Určite chceš vymazať?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Vymazať</button>
          </form>
          @endhasanyrole
        </div>
      </div>
    </div>
    @endforeach
  </div>
</x-admin-layout>
