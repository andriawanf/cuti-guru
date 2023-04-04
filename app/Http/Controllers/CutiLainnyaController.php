<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cuti;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CutiLainnyaController extends Controller
{
    public function index()
    {
        $cuti = Cuti::where('user_id', Auth::user()->id)->with('user')->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('guru.cuti-lainnya', [
            'cuti' => $cuti,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function cutiLainnya(Request $request)
    {
        $validate_category = Validator::make($request->all(), [
            'category' => 'required'
        ], ['category.required' => 'Category wajib diisi.']);
        if($validate_category->fails()){
            return redirect()->back()->withErrors($validate_category);
        }
        $rules = [
            'file' => 'required',
            'from' => 'required',
            'subcategory' => 'required',
            'to' => 'required',
            'durasi_cuti' => 'required',
            'alasan' => 'required|min:10|max:190',
        ];
        $messages = [
            'subcategory.required' => 'Jenis cuti wajib dipilih.',
            'ttd.required' => 'Tanda tangan wajib diisi.',
            'file.required' => 'File wajib diisi.',
            'from.required' => 'Tanggal awal cuti wajib diisi.',
            'to.required' => 'Tanggal akhir cuti wajib diisi.',
            'durasi_cuti.required' => 'Durasi cuti wajib diisi.',
            'alasan.required' => 'Alasan cuti wajib diisi.',
            'alasan.min' => 'Alasan minimal diisi dengan :min karakter.',
            'alasan.max' => 'Alasan maximal diisi dengan :max karakter.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        } 
        $from_count = Cuti::where('from', $request->from)->count();
        $to_count = Cuti::where('to', $request->to)->count();
        // $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to);
        // $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from);
        // $diff_in_days = $to->diffInDays($from);
        if($from_count > 5 || $to_count > 5){
            return redirect()->back()->with('error', 'Batas cuti di hari tersebut sudah penuh!');
        }

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('public/storage/files');

        // $path = Storage::putFile(
        //     'public/files',
        //     $request->file('file')
        // );
        $user = User::find(Auth::user()->id);
        $cuti = Cuti::find($request->id);
        if($user->status == 'pending'){
            $user->saldo_cuti = $user->saldo_cuti + $cuti->durasi_cuti;
            $user->save();
        }
        // $user->save();
        // $user->saldo_cuti = $user->saldo_cuti - $diff_in_days;
        $cuti = Cuti::create([
            'cat_id' => $request->category,
            'sub_id' => $request->subcategory,
            'alasan' => $request->alasan,
            'file' => $path,
            'from' => $request->from,
            'status' => 'pending',
            'to' => $request->to,
            'durasi_cuti' => $request->durasi_cuti,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->back()->with('success', 'Berhasil membuat permohonan cuti');
    }

    public function category(Request $request)
    {
        $subcategory = Subcategory::all();
        return view('isi', [
            'id' => $request->cat_id,
            'subcategory' => $subcategory,
        ]);
    }
}