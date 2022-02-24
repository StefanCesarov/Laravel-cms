<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    public function edit ()
    {
        return view('users.edit');
    }

    public function update (Request $request)
    {
        $this->validate($request, [
            'img' => 'mimes:jpeg,bmp,png,jpg',
        ]);

        $user = auth()->user();
        $img = $request->img->store('users');
        
        $user->update(
            [
                'name' => $request->name,
                'about' => $request->about,
                'img' => $img    
            ]
        );

        session()->flash('success', 'Profil changed');
        return redirect(route('home'));

    }

    public function makeAdministrator (User $user)
    {
        
        $user->update(
            ['role' => 'admin']
        );

        session()->flash('success', 'User role is set to admin');
        return redirect(route('home'));
    }
}
