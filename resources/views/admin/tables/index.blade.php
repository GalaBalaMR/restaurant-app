<x-admin-layout>
  
  <div class="d-flex justify-content-between m-auto col-9">
    <h1>Stoly</h1>
    @hasanyrole('Manager|Admin')
    <div>          
      <a class="btn btn-success" href="{{ route('admin.tables.create') }}">Vytvoriť stôl</a>
    </div>
    @endhasanyrole
  </div>

  
  
  <div class="row col-9 m-auto">
    <table class="table table-striped table-hover text-center d-none d-md-table">
      <thead>
        <tr>
          <th scope="col" class="col-2">Name</th>
          <th scope="col" class="col-2">Guest Number</th>
          <th scope="col" class="col-2">Location</th>
          <th scope="col" class="col-2">status</th>
          <th scope="col" class="col-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($tables as $table)
        <tr>
          <td>{{ $table->name }}</td>
          <td>{{ $table->guest_number }}</td>
          <td>{{ $table->location }}</td>
          <td>{{ $table->status }}</td>
          <td class="align-middle">
            <div class="d-flex justify-content-center">
              <a href="{{ route('admin.tables.edit', $table->id) }}" class="btn btn-warning me-2">Editovať</a>
              @hasanyrole('Manager|Admin')
              <form action="{{ route('admin.tables.destroy', $table->id) }}"
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
    @foreach($tables as $table)
    <div class="card m-auto mt-2 text-center" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title"><strong>{{ $table->name }}</strong></h5>
        <h6 class="card-subtitle mb-2 text-muted">Miest na sedenie: {{ $table->guest_number }}</h6>
        <p class="card-text">Umiestnenie: {{ $table->location }}</p>
        <p class="card-text">Status: {{ $table->status }}</p>
        <div class="d-flex justify-content-center">
          <a href="{{ route('admin.tables.edit', $table->id) }}" class="btn btn-warning me-2">Editovať</a>
          @hasanyrole('Manager|Admin')
          <form action="{{ route('admin.tables.destroy', $table->id) }}"
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
