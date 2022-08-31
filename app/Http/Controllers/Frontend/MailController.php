<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\InfoMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\InfoMailRequest;

class MailController extends Controller
{
    //controller for sending info mail from /#contact
    public function index(InfoMailRequest $request)
    {
        $request->validated();

        $info = $request;
        
        Mail::to('matus.recka@gmail.com')->send(new InfoMail($info));

        if($request->ajax())
        {
            return response()->json(['flash' => 'Podarilo sa odoslať email.',
                                     'name'  => $request->name ,
                                     'status'=> 'ok'
                                    ]);
        }
        return redirect('/')->with(['flash' => 'Podarilo sa odoslať email.',
                                 'name'  => $request->name ,
                                 'status'=> 'ok'
                                 ]);
    }
}
