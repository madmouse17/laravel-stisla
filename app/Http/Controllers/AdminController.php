<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Admin;
use App\Models\EmailCode;
use App\Mail\SendCodeMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\DataTables\AdminsDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AdminsDataTable $dataTable)
    {
        $request->session()->forget('edit-admin');

        return $dataTable->render('pages.User.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', Rule::unique('users', 'email')],
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $admin = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole('admin');
        return redirect()
            ->back()
            ->with('message', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin, Request $request, AdminsDataTable $dataTable)
    {

        $request->session()->put('edit-admin', $admin->id);

        $edit = $admin;


        $show = User::orderby('id', 'desc')
            ->with('roles')
            ->get();

        return $dataTable->render('pages.User.index', ['edit' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        // dd($request, $admin);

        $validator = Validator::make($request->all(), [
            'email' => ['required', Rule::unique('users', 'email')->ignore($admin->id)],
            'name' => 'required',
            'password' => $request->password ? 'min:8' : '',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $update = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ];

        $admin->update($update);


        return redirect()
            ->route('admin.index')
            ->with('message', 'Data Berhasil DiUbah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {

        $d = User::query()->where('id', $admin->id)->get();
        $d->each->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function restore($id)
    {
        User::query()
            ->withTrashed()
            ->find($id)
            ->restore();

        return response()->json([
            'message' => 'Data berhasil dikembalikan!',
        ]);
    }

    function resetpassword($id)
    {
        $siswa = User::query()->find($id);
        $siswa->update(['password' => Hash::make('password123')]);

        return response()->json([
            'message' => 'Data berhasil Reset Password!',
        ]);
    }

}
