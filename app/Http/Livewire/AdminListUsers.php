<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminListUsers extends Component
{
    use WithPagination;
    public $pagination = 10;
    public $search = "";

    public function render(Request $request)
    {
        if (Auth::user()->level == 'kepala sekolah'){
            $user = User::search(trim($this->search))
                ->paginate($this->pagination);
            $nomor = 1 + (($user->currentPage()-1) * $user->perPage());
            return view('livewire.admin-list-users', [
                'user' => $user,
                'nomor' => $nomor
            ]);
        } elseif (Auth::user()->level == 'admin') {

            $users = User::where('level', '=', 'Guru')
                ->search(trim($this->search))
                ->paginate($this->pagination);
            $nomor = 1 + (($users->currentPage()-1) * $users->perPage());
            return view('livewire.admin-list-users', [
                'users' => $users,
                'nomor' => $nomor
            ]);
        }
    }

    public function deleteRecord($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('success', 'Berhasil menghapus data guru');
    }
}
