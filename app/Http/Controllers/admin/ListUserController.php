<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ListUserController extends Controller
{
    public function listUser()
    {
        if (Auth::user()->level == 'kepala sekolah'){
            $user = User::all();
            return view('admin.list-user', [
                'user' => $user,
            ]);
        } elseif (Auth::user()->level == 'admin') {
            $user = User::where('level', '=', 'Guru')->get();
            return view('admin.list-user', [
                'user' => $user,
            ]);
        }
    }

    public function addUser()
    {
        return view('admin.add-user');
    }

    public function storeUser(Request $request){
        $rules = [
            'name' => 'required',
            'nip' => 'required',
            'pangkat' => 'required',
            'jabatan' => 'required',
            'satuan_organisasi' => 'required',
            'saldo_cuti' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'foto' => 'required|image',
        ];
        $message = [
            'name.required' => 'Nama tidak boleh kosong',
            'nip.required' => 'NIP tidak boleh kosong',
            'pangkat.required' => 'Pangkat tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'satuan_organisasi.required' => 'Satuan Organisasi tidak boleh kosong',
            'saldo_cuti.required' => 'Saldo Cuti tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'level.required' => 'Level tidak boleh kosong',
            'foto.required' => 'Foto tidak boleh kosong',
        ];
        $validator = Validator::make(request()->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(request()->all());
        }
        // insert data user
        $user = new User;
        $user->name = request('name');
        $user->nip = request('nip');
        $user->pangkat = request('pangkat');
        $user->jabatan = request('jabatan');
        $user->satuan_organisasi = request('satuan_organisasi');
        $user->saldo_cuti = request('saldo_cuti');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->level = request('level');
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move(public_path('foto_user'),$nama_file);
            $user->foto = $nama_file;
        }
        $user->save();
        
        return redirect()->route('admin.list-user')->with('success', 'Data berhasil ditambahkan');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.edit-user', [
            'user' => $user,
        ]);
    }

    public function updateUser(Request $request ,$id){
        // update data user
        $user = User::find($id);
        $user->name = request('name');
        $user->nip = request('nip');
        $user->pangkat = request('pangkat');
        $user->jabatan = request('jabatan');
        $user->satuan_organisasi = request('satuan_organisasi');
        $user->saldo_cuti = request('saldo_cuti');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->level = request('level');
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time()."_".$file->getClientOriginalName();
            $file->move(public_path('foto_user'),$nama_file);
            $user->foto = $nama_file;
        }
        
        $user->save();
        $request->session()->put('foto', $user->foto);

        return redirect()->route('admin.list-user');
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.list-user');
    }
}
