<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiListController extends Controller
{
    public function index()
    {
        $cuti = Cuti::where('user_id', Auth::user()->id)->with(['category', 'subcategory'])->get();
        return view('admin.list-cuti', [
            'cuti' => $cuti,
        ]);
    }

    public function approve($id)
    {
        $leave = Cuti::find($id);
        $leave->status = 'approved';
        $leave->save();
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
