<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiListController extends Controller
{
    public function index()
    {
        $cuti = Cuti::where('status', 'approved')->with(['category', 'subcategory'])->get();
        $cutiGuru = Cuti::where('status', 'pending')->with(['category', 'subcategory'])->get();
        return view('admin.list-cuti', [
            'cuti' => $cuti,
            'cutiGuru' => $cutiGuru,
        ]);
    }

    public function approve($id)
    {
        $leave = Cuti::find($id);
        $leave->status = 'approved';
        $leave->save();
        if($leave->status === 'approved'){
            $user = User::find($leave->user_id);
            $user->saldo_cuti = $user->saldo_cuti - $leave->durasi_cuti;
            $user->save();
        }
        return redirect()->back()->with('success', 'Leave request approved.');
    }

    public function disapprove($id)
    {
        $leave = Cuti::find($id);
        $leave->status = 'disapproved';
        $leave->save();
        return redirect()->back()->with('success', 'Leave request disapproved.');
    }
}
