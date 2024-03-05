<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $users = User::all();
            return view('admin.user.index', [
                'judul' => 'Daftar User',
                'users' => $users
            ]);
        } else {
            Session::flash('error', 'Anda harus melakukan proses login terlebih dahulu');
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $roles = Role::all();
            return view('admin.user.tambah', [
                'judul' => 'Tambah User',
                'roles' => $roles
            ]);
        } else {
            Session::flash('error', 'Anda harus melakukan proses login terlebih dahulu');
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi data sebelum disimpan
        $this->validate($request, [
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],
            'nama_lengkap' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'alamat' => 'required|string',
        ]);

        // proses penyimpanan data pengguna
        $user = new User();
        $user->role_id = $request->role_id;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->password = Hash::make($request->password);
        $user->save();

        // menampilkan pesan sukses jika data berhasil disimpan
        $request->session()->flash('sukses', 'Data berhasil disimpan');
        return redirect('/user/' . $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $user = User::findOrFail($id);
            $roles = Role::all();
            if ($user) {
                return view('admin.user.detail', [
                    'judul' => 'Detail User',
                    'user' => $user,
                    'roles' => $roles
                ]);
            } else {
                Session::flash('error', 'ID user tidak ditemukan');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Anda harus melakukan proses login terlebih dahulu');
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $user = User::findOrFail($id);
            if ($user) {
                $roles = Role::all();
                return view('admin.user.edit', [
                    'judul' => 'Edit User',
                    'user' => $user,
                    'roles' => $roles
                ]);
            } else {
                Session::flash('error', 'ID user tidak ditemukan');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Anda harus melakukan proses login terlebih dahulu');
            return redirect('/');
        }
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
        $user = User::find($id);
        $this->validate($request, [
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],
            'nama_lengkap' => 'required|string',
            'username' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable|min:8',
            'alamat' => 'required|string',
        ]);

        $user->role_id = $request->role_id;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->password = Hash::make($request->password);
        $user->update();

        $request->session()->flash('sukses', 'Data berhasil diubah');
        return redirect('/user/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();

        $request->session()->flash('sukses', 'Data berhasil dihapus');
        return redirect('/user');
    }
}
