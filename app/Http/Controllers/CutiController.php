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

class CutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::where('user_id', Auth::user()->id)->with('user')->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('cuti', [
            'cuti' => $cuti,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function addCuti(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category' => 'required',
        ], [ 'category.required' => 'Kategori cuti harus diisi']);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        switch ($request->category){
            case 1:
                $rules = [
                    'from' => 'required',
                    'to' => 'required',
                    'durasi_cuti' => 'required',
                    'alasan' => 'required|min:10',
                ];
                $messages = [
                    'jenis.required' => 'Jenis cuti harus diisi',
                    'from.required' => 'Tanggal mulai cuti harus diisi',
                    'to.required' => 'Tanggal akhir cuti harus diisi',
                    'durasi_cuti.required' => 'Durasi cuti harus diisi',
                    'alasan.required' => 'Alasan cuti harus diisi',
                    'alasan.min' => 'Alasan cuti minimal 10 karakter',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $from_count = Cuti::where('from', $request->from)->count();
                $to_count = Cuti::where('to', $request->to)->count();
                if ($from_count > 0 || $to_count > 0) {
                    return redirect()->back()->with('error', 'Tanggal cuti sudah ada');
                }
                $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to);
                $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from);
                $diff = $to->diffInDays($from);
                if ($diff <= $to->Auth::user()->saldo_cuti){
                    $cuti_count = Cuti::where([
                        ['status', '=', 'pending'],
                        ['user_id', '=', Auth::user()->id],
                    ])->count();
                    if ($cuti_count > 0){
                        return redirect()->back()->with('error', 'Anda masih memiliki cuti yang belum disetujui');
                    }
                    $user = User::find(Auth::user()->id);
                    if ($user->status == 'pending'){
                        $user->saldo_cuti = $user->saldo_cuti + $diff;
                        $user->save();
                    }

                    $user = Cuti::create([
                        'cat_id' => $request->category,
                        'from' => $request->from,
                        'to' => $request->to,
                        'durasi_cuti' => $request->durasi_cuti,
                        'alasan' => $request->alasan,
                        'user_id' => Auth::user()->id,
                        'status' => 'pending',
                    ]);
                    return redirect()->back()->with('success', 'Cuti berhasil diajukan');
                }
                return redirect()->back()->with('error', 'Saldo cuti tidak mencukupi');
                break;

            case 2:
                $rules = [
                    'file' => 'required',
                    'from' => 'required',
                    'to' => 'required',
                    'subcategory' => 'required',
                    'durasi_cuti' => 'required',
                    'alasan' => 'required|min:10',
                ];
                $messages = [
                    'file.required' => 'File harus diisi',
                    'from.required' => 'Tanggal mulai cuti harus diisi',
                    'to.required' => 'Tanggal akhir cuti harus diisi',
                    'subcategory.required' => 'Sub kategori cuti harus diisi',
                    'durasi_cuti.required' => 'Durasi cuti harus diisi',
                    'alasan.required' => 'Alasan cuti harus diisi',
                    'alasan.min' => 'Alasan cuti minimal 10 karakter',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $from_count = Cuti::where('from', $request->from)->count();
                $to_count = Cuti::where('to', $request->to)->count();
                $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to);
                $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from);
                $diff = $to->diffInDays($from);
                if ($from_count > 0 || $to_count > 0) {
                    return redirect()->back()->with('error', 'Tanggal cuti sudah ada');
                }
                $path = Storage::putFile('public/cuti', $request->file('file'));
                $user = User::find(Auth::user()->id);
                $cuti = Cuti::find($request->id);
                if ($user->status == 'pending'){
                    $user->saldo_cuti = $user->saldo_cuti + $cuti->durasi_cuti;
                    $user->save();
                }
                $cuti = Cuti::create([
                    'cat_id' => $request->category,
                    'from' => $request->from,
                    'to' => $request->to,
                    'durasi_cuti' => $request->durasi_cuti,
                    'alasan' => $request->alasan,
                    'user_id' => Auth::user()->id,
                    'status' => 'pending',
                    'file' => $path,
                    'sub_id' => $request->subcategory,
                ]);
                return redirect()->back()->with('success', 'Cuti berhasil diajukan');
                break;
            default:
                return redirect()->back()->with('error', 'Gagal mengajukan cuti');
        }
    }

    public function category(Request $request){
        $subcategory = Subcategory::all();
        return view('isi', [
            'id' => $request->cat_id,
            'subcategory' => $subcategory,
        ]);
    }

    public function history() {
        $cuti = Cuti::where('user_id', Auth::user()->id)->with(['category', 'subcategory'])->get();
        return view('cuti.history', [
            'cuti' => $cuti,
        ]);
    }
}
