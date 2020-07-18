<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $user= User::with('roles')->get();
        // dd($user);
        return view('user.index',compact('user'));
    }
    public function tambah(Request $request)
    {
        if($request->isMethod('get'))
        {
            $role = Role::get();

            return view('user.tambah',compact('role'));
        }else{
            $rules = [
                'nama' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role'  => 'required'
            ];
            $pesan = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'password.required' => 'Password Tidak Boleh Kosong',
                'role.required'   => 'Role Tidak Boleh Kosong'
            ];

            $v = Validator::make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $user = new User();

                $user->name = $request->get('nama');
                $user->email = $request->get('email');
                $user->password = Hash::make($request->get('password'));
                $user->assignRole($request->get('role'));
                $user->save();


            }
        }
        return redirect('pengguna/index');

    }
    public function update(Request $request,$id)
    {
        if($request->isMethod('get'))
        {
            $role = Role::get();
            $user = User::with('roles')->where('id',$id)->get();

            return view('user.edit',compact('role','user'));
        }else{
            $rules = [
                'nama' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role'  => 'required'
            ];
            $pesan = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'password.required' => 'Password Tidak Boleh Kosong',
                'role.required'   => 'Role Tidak Boleh Kosong'
            ];

            $v = Validator::make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $user =  User::find($id);
                $user->name = $request->get('nama');
                $user->email = $request->get('email');
                $user->assignRole($request->get('role'));
                $user->update();


            }
        }
        return redirect('pengguna/index');
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status' => 'Data Pengguna Telah Berhasil Di hapus']);
    }

}
