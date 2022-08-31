<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\ReservationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ReservationStoreRequest;

class ReservationController extends Controller
{

    //return view for reservation and send it $tables and $now
    public function stepOne(Request $request){
        $tables = Table::where('status','avaliable')->get();
        $now = Carbon::now('Europe/Bratislava')->format('m d, H');
        $reservation = $request->session()->get('reservation');
        return view('reservations.step-one', compact('reservation', 'tables', 'now'));
    }


    //validation and saving $reservation in the session
    public function storeStepOne(ReservationStoreRequest $request)
    {
        
        $table = Table::findorFail($request->table_id);
        
        If( $request->guest_number > $table->guest_number)
        {
            if($request->ajax())
            {
                return response()->json(['flash'  => 'Počet hostí prevyšuje kapacitu stola, prosím vyberte stôl s        rovnakou, alebo väčšou kapacitou',
                                         'status' => '0']);
            }
            return back()->with(['info' => 'Počet hostí prevyšuje kapacitu stola, prosím vyberte stôl s rovnakou, alebo väčšou kapacitou','type'  => 'danger']);
            
        }
        
        // check if in this date is not other reservation
        $res_datesTime = [];

        foreach( $table->reservations as $res)
        {
            // make date with hour from $request->res_date and compare with array of other reservation

            $request_date       =   Carbon::parse($request->res_date)->format('F d, Y H');
            $request_date_addHour =   Carbon::parse($request->res_date)->addHour()->format('F d, Y H');
            $res_dateTimeParse  =   Carbon::parse($res->res_date)->format('F d, Y H');

            array_push($res_datesTime , $res_dateTimeParse);

            //reservation is for 2 hour
            //check if res date is in reservations
            if( in_array($request , $res_datesTime))
            {
                if($request->ajax())
                {
                    return response()->json(['flash'  => 'V tento dátum a čas je obsadené, skús iný deň',
                                             'status' => '0']);
                }
                return back()->with(['info' => 'V tento dátum a čas je obsadené, skús iný deň','type'  => 'danger']);
            }
            //check res date with add one hour
            if( in_array($request_date_addHour , $res_datesTime))
            {
                if($request->ajax())
                {
                    return response()->json(['flash'  => 'V tento dátum a čas je obsadené, skús iný deň',
                                             'status' => '0']);
                }
                return back()->with(['info' => 'V tento dátum a čas je obsadené, skús iný deň','type'  => 'danger']);
            }
        };
        // create reseration and send it to ReservationMail
        $reservation = Reservation::create($request->validated());


        Mail::to($request->email)->send(new ReservationMail($reservation));
        if($request->ajax())
        {
            return response()->json(['flash' => 'Rezervácia bola úspešne vytvorená',
                                     'status' => '1']);
        }
        return redirect('/reservation/step-two#thanks')->with(['info'  => 'Rezervácia bola úspešne vytvorená, poslali sme ti potvrdzujúci email :).',
                                                        'type'  => 'success',
                                                        'email' => $request->email
                                                    ]);
    }

    public function stepTwo(Request $request)
    {
        

        return view('reservations.step-two');
    }


    
}
