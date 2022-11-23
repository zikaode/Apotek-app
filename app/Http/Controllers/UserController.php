<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('user_profile')->paginate(10);
        return view('data-user')->with(['user' => $user]);
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
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'no_telp' => 'required|regex:/^[0-9]+$/',
            'tanggal_lahir' => 'required|date',
            'level' => 'required|in:admin,apoteker',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'required|string|min:8',
            'repeat' => 'required|same:password',
            'alamat' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $userProfile = UserProfile::create([
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);
            $user = User::make([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
                'password' => Hash::make($request->password),
                'user_profile_id' => $userProfile->id
            ]);
            if ($user->save()) {
                DB::commit();
                session()->flash('success', "Data Obat Berhasil Direkam!");
                return back();
            } else {
                session()->flash('failed', "Data Obat Gagal Direkam!");
                return back()->withInput();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            session()->flash('failed', "Data Obat Gagal Direkam - (Error)!");
            return back()->withInput();
        }
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user_profile = $user->user_profile;
        $email = $user->email;
        if (Hash::check($request->password, $user->password)) {
            if ($user->delete()) {
                $user_profile->delete();
                session()->flash('success', "User '{$email}' Berhasil Dihapus!");
                return back();
            } else {
                session()->flash('failed', "Terjasi Kesalahan Saat Ingin Menghapus User");
                return back();
            }
        } else {
            session()->flash('failed', "Sandi User Salah - Delete Password Mistakes");
            return back();
        }
    }
}
