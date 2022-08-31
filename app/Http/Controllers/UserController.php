<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //return users
    //if user has role Admin
    public function index()
    {
        $id=Auth::user()->id;
        $user = User::find($id);

        if(!$user->hasRole('Admin'))
        {
            abort(403);
        };
        $users = User::all();

        return view('admin.users.index', compact('users'));


    }
    
    public function show()
    {
        $email = Auth::user()->email;
        $reservations = Reservation::where('email', $email)->get();
        $now = Carbon::now('Europe/Bratislava')->format('m d, H');
        
        return view('user.show', compact('reservations', 'now'));

    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $password = bcrypt($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        $user->assignRole($request->role);

        return redirect('/admin/users/')->with(['info' => 'Nový používateľ je vytvorený', 'type' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $password = bcrypt($request->password);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        if($user->hasAnyRole(Role::all()))
        {
            $user->roles()->detach();
        }

        $user->assignRole($request->role);

        return redirect('/admin/users/')->with(['info' => 'Používateľ bol upravený', 'type' => 'success']);

    }

    /**
     * Remove the specified user from storage with his role.
     */
    public function destroy(User $user)
    {
        if($user->hasAnyRole(Role::all()))
        {
            $user->roles()->detach();
        }
        $user->delete();

        return redirect('/admin/users/')->with(['info' => 'Používateľ bol vymazaný', 'type' => 'warning']);
    }
}
