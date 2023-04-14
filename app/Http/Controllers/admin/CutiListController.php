<?php

namespace App\Http\Controllers\admin;

use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\notificationForKepsek;
use App\Notifications\notificationAdminConfirm;
use App\Notifications\notificationKepsekApproved;

class CutiListController extends Controller
{
    public function index()
    {
        $cuti = Cuti::where('status', 'approved')->orWhere('status', 'disapproved')->with(['category', 'subcategory'])->get();
        // menampilkan data cuti yang berstatus pending dan confirmed
        $cutiGuru = Cuti::where('status', 'pending')->orWhere('status', 'admin confirmed')->with(['category', 'subcategory'])->get();
        return view('admin.list-cuti', [
            'cuti' => $cuti,
            'cutiGuru' => $cutiGuru,
        ]);
    }

    public function approve($id)
    {
        if (Auth::user()->level === 'admin') {
            $leave = Cuti::find($id);
            $leave->status = 'admin confirmed';
            $leave->save();

            $user = $leave->user->jabatan === 'guru' ? User::find($leave->user_id) : User::find($leave->user_id);
            $user->notify(new notificationAdminConfirm($leave->status));

            // notif to kepsek
            $kepsek = User::where('level', 'kepala sekolah')->first();
            $kepsek->notify(new notificationForKepsek($user->name));
            return redirect()->back()->with('success', 'Leave request approved.');
        } elseif (Auth::user()->level === 'kepala sekolah') {
            $leave = Cuti::find($id);
            $leave->status = 'approved';
            $leave->save();

            $user = $leave->user->jabatan === 'guru' ? User::find($leave->user_id) : User::find($leave->user_id);
            $user->notify(new notificationKepsekApproved($leave->status));
            
            if ($leave->status === 'approved' && $leave->sub_id != '3') {
                $user = User::find($leave->user_id);
                $user->saldo_cuti = $user->saldo_cuti - $leave->durasi_cuti;
                $user->save();
                return redirect()->back()->with('success', 'Leave request approved.');
            }else {
                $user = User::find($leave->user_id);
                $user->saldo_cuti;
                $user->save();
                return redirect()->back()->with('success', 'Leave request approved.');
            }
        }

    }

    public function disapprove($id)
    {
        $leave = Cuti::find($id);
        $leave->status = 'disapproved';
        $leave->save();
        return redirect()->back()->with('success', 'Leave request disapproved.');
    }
}
