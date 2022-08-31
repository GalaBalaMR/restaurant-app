<x-admin-layout>

<div class="d-flex justify-content-between m-auto col-9">
  <h1>Rezervácie</h1>
  <div>          
    <a class="btn btn-success" href="{{ route('admin.reservations.create') }}">Vytvoriť rezerváciu</a>
  </div>
</div>

  
  
  <div class="row col-9 m-auto">
    <table class="table table-striped table-hover text-center d-none d-md-table">
      <thead>
        <tr class="align-middle">
          <th scope="col" class="col-2">Meno</th>
          <th scope="col" class="col-2">Priezvisko</th>
          <th scope="col" class="col-2">Telefónne číslo</th>
          <th scope="col" class="col-2">Email</th>
          <th scope="col" class="col-2">Počet Hostí</th>
          <th scope="col" class="col-2">Dátum a čas</th>
          <th scope="col" class="col-2">Stôl</th>
        </tr>
      </thead>
      <tbody>
        @foreach($reservations as $reservation)
        <tr>
          <td>{{ $reservation->first_name }}</td>
          <td>{{ $reservation->last_name }}</td>
          <td>{{ $reservation->telephone_number }}</td>
          <td>{{ $reservation->email }}</td>
          <td>{{ $reservation->guest_number }}</td>
          <td>{{ $reservation->res_date }}</td>
          <td>{{ $reservation->table->name }}</td>
          <td class="align-middle">
            <div class="d-flex justify-content-center">
              <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-warning me-2">Editovať</a>
              <form action="{{ route('admin.reservations.destroy', $reservation->id) }}"
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
    @foreach($reservations as $reservation)
    <div class="card m-auto mt-2 text-center" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title"><strong>{{ $reservation->first_name }} {{ $reservation->last_name }}</strong></h5>
        <h6 class="card-subtitle mb-2 text-muted">Dátum: {{ \Carbon\Carbon::parse($reservation->res_date)->translatedFormat('F d, H') }}:00</h6>
        <h6 class="card-subtitle mb-2 text-muted">Hostia: {{ $reservation->guest_number }}</h6>
        <a class="card-link text-warning" href = "tel: {{ $reservation->telephone_number }}">{{ $reservation->telephone_number }}</a>
        <a class="card-link text-warning" href = "mailto: {{ $reservation->email }}">{{ $reservation->email }}</a>
        <p class="card-text">{{ $reservation->table->name }}</p>
        <div class="d-flex justify-content-center">
          <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-warning me-2">Editovať</a>
          <form action="{{ route('admin.reservations.destroy', $reservation->id) }}"
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
