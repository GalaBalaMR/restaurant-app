<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::where('status','avaliable')->get();
        $now = Carbon::now('Europe/Bratislava')->format('m d, H');
        $min = Carbon::today();
        $max = Carbon::now()->addWeek();

        return view('admin.reservations.create', compact('tables', 'now', 'min', 'max'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {

        $table = Table::findorFail($request->table_id);
        
        If( $request->guest_number > $table->guest_number)
        {
            return back()->with(['info' => 'Počet hostí prevyšuje kapacitu stola, prosím vyberte stôl s rovnakou, alebo väčšou kapacitou','type'  => 'danger']);
        }
        
        // check if in this date is not other reservation
        $res_datesTime = [];

        foreach( $table->reservations as $res)
        {
            // make date with hour from $request->res_date with compare with array of other reservation

            $request_date       =   Carbon::parse($request->res_date)->format('F d, Y H');
            $res_dateTimeParse  =   Carbon::parse($res->res_date)->format('F d, Y H');

            array_push($res_datesTime , $res_dateTimeParse);

            if( in_array($request_date , $res_datesTime))
            {
                return back()->with(['info' => 'V tento dátum a čas je obsadené, skús iný deň','type'  => 'danger']);
            }
        };
        Reservation::create($request->validated());
        
        return redirect('/admin/reservations/')->with(['info' => 'Rezervácia bola úspešne vytvorená','type'  => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::all();
        return view('admin.reservations.edit', compact('reservation','tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'telephone_number' => 'required',
            'table_id' => 'required',
            'res_date' => 'required',
            'guest_number' => 'required',
        ]);
        

        $reservation->update([
            
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone_number' => $request->telephone_number,
            'table_id' => $request->table_id,
            'res_date' => $request->res_date,
            'guest_number' => $request->guest_number,
        ]);
        return redirect('/admin/reservations/')->with(['info' => 'Rezervácia bola upravená','type'  => 'success']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect('/admin/reservations')->with(['info' => 'Rezervácia bola upravená','type'  => 'danger']);
    }
}
