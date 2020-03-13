<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 5;
        $data['users'] = User::paginate($paginate);
        return view('home', $data)->with('i', ($request->input('page', 1) - 1) * $paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
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
            'name'      => 'required',
            'email'     => 'required',
            'address'   => 'required',
            'nilai'     => 'required|numeric'
        ]);

        $user                       = new User;
        $user->name                 = $request->name;
        $user->email                = $request->email;
        $user->address              = $request->address;
        $user->nilai                = $request->nilai;
        $user->password             = Hash::make("admin123");
        $user->email_verified_at    = Carbon::now();
        $user->save();

        return redirect()->route('user.index')->with('success', 'Create User Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::find($id);
        return view('edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        return view('edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'address'   => 'required',
            'nilai'     => 'required|numeric'
        ]);

        $user                       = User::find($id);
        $user->name                 = $request->name;
        $user->email                = $request->email;
        $user->address              = $request->address;
        $user->nilai                = $request->nilai;
        $user->password             = Hash::make("admin123");
        $user->email_verified_at    = Carbon::now();
        $user->save();

        return redirect()->route('user.index')->with('info', 'Updated User Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('warning', 'Deleted User Successfully');
    }
}
