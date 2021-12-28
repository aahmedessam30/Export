<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect(route('home'))->with(['error' => __('messages.You are not allowed to visit this page')]);
        }
        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        if ($request->password) {
            $validated['password'] = Hash::make($validated['password']);
        }
        User::create($validated)->assignRole('admin');
        return redirect(route('home'))->with(['success' => __('messages.User added successfully')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect(route('home'))->with(['error' => __('messages.You are not allowed to visit this page')]);
        }
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        if ($request->password && Hash::needsRehash($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return redirect(route('home', ['user' => $user]))->with(['success' => __('messages.User updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect(route('home'))->with(['error' => __('messages.You are not allowed to visit this page')]);
        }
        $user->forceDelete();
        return redirect(route('home'))->with(['success' => __('messages.User deleted successfully')]);
    }
}
