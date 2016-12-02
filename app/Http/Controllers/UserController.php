<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserPost;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Return only users manageable by the current user
        // TODO: Include pagination
        $users = User::all();

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        $input = $request->only(['name', 'email', 'role']);
        $input['password'] = bcrypt($request->input('password'));

        $user = User::create($input);

        if ($request->has('settings')) {
            $user->settings()->create($request->input('settings'));
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserPost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserPost $request, User $user)
    {
        $input = $request->only(['name', 'email', 'role']);
        if ($request->has('password')) {
            $input['password'] = bcrypt($request->input('password'));
        }

        $user->update($input);

        if ($request->has('settings')) {
            if ($user->settings) {
                $user->settings->update($request->input('settings'));
            } else {
                $user->settings()->create($request->input('settings'));
            }
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
