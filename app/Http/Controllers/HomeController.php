<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pnemonia;
use App\Models\Puskesmas;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\PasswordDefaults;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        // dd($total_superadmin);
        return view('pages.home.home');
    }

    public function sessionClear(Request $request)
    {
        $request->session()->forget('edit-admin');


        $route = $request->page . '.index';
        // dd($request->page);
        return redirect()->route($route);
    }

    public function checkPassword()
    {
        return view('auth.password-defaults');
    }

    public function changePD(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'passwordbaru' => ['required', 'confirmed', 'min:8', new PasswordDefaults()],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'password' => Hash::make($request->passwordbaru),
        ]);


        return redirect()->route('dashboard.index')->with('message', 'Password berhasil diubah');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
