<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiLainnyaController extends Controller
{
    public function index(){
        $cuti = Cuti::where('user_id', Auth::user()->id)->with(['category', 'subcategory'])->get();
        return view('guru.history', [
            'cuti' => $cuti,
        ]);
    }
}
