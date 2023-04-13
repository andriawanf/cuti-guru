<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\User;
use App\Notifications\notificationFormSubmitted;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\TemplateProcessor;

class CutiTahunanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('guru.cuti-tahunan');
    }

    public function cutiTahunan(Request $request)
    {
        $validate_category = Validator::make($request->all(), [
            'category' => 'required'
        ], ['category.required' => 'Category wajib diisi.']);
        if ($validate_category->fails()) {
            return redirect()->back()->withErrors($validate_category);
        }

        $rules = [
            'from' => 'required',
            'to' => 'required',
            'durasi_cuti' => 'required',
            'alasan' => 'required|min:10|max:190',
            'signature' => 'required',
        ];
        $messages = [
            'jenis.required' => 'Jenis cuti wajib dipilih.',
            'ttd.required' => 'Tanda tangan wajib diisi.',
            'durasi_cuti.required' => 'Durasi cuti wajib diisi.',
            'from.required' => 'Tanggal awal cuti wajib diisi.',
            'to.required' => 'Tanggal akhir cuti wajib diisi.',
            'alasan.required' => 'Alasan cuti wajib diisi.',
            'alasan.min' => 'Alasan minimal diisi dengan :min karakter.',
            'alasan.max' => 'Alasan maximal diisi dengan :max karakter.',
            'signature.required' => 'Tanda tangan wajib diisi.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $from_count = Cuti::where('from', $request->from)->count();
        $to_count = Cuti::where('to', $request->to)->count();
        if ($from_count > 5 || $to_count > 5) {
            return redirect()->back()->with('error', 'Batas cuti di hari tersebut sudah penuh!');
        }
        // $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to);
        // $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from);
        // $diff_in_days = $to->diffInDays($from);
        $cuti = Cuti::find($request->id);
        if ($request->durasi_cuti <= Auth::user()->saldo_cuti) {
            $cuti_count = Cuti::where([
                ['status', '=', 'pending'],
                ['user_id', '=', Auth::user()->id]
            ])->count();
            if ($cuti_count != 0) {
                return redirect()->back()->with('error', 'Masih ada cuti yang pending!');
            }
            $user = User::find(Auth::user()->id);
            // $cuti = Cuti::find($request->id);
            if ($user->status == 'pending') {
                $user->saldo_cuti = $user->saldo_cuti + $cuti->durasi_cuti;
                $user->save();
            }
            // $user->saldo_cuti = $user->saldo_cuti - $diff_in_days;
            // $user->save();    
            $folderPath = public_path('ttd/'); // create signatures folder in public directory
            $image_parts = explode(";base64,", $request->signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.' . $image_type;
            $signature_image = file_put_contents($file, $image_base64);
            $user = Cuti::create([
                'cat_id' => $request->category,
                'alasan' => $request->alasan,
                'durasi_cuti' => $request->durasi_cuti,
                'status' => 'pending',
                'from' => $request->from,
                'to' => $request->to,
                'signature' => $file,
                'user_id' => Auth::user()->id
            ]);

            User::find(Auth::user()->id)->notify(new notificationFormSubmitted($user->status, $user->category->title));
            return redirect()->back()->with('success', 'Berhasil membuat permohonan cuti');
        }
        return redirect()->back()->with('error', 'Sisa saldo cuti kamu tidak cukup');
    }

    // download pdf
    public function downloadPDFCuti($id)
    {
        $leave = Cuti::findOrfail($id);
        $document = new TemplateProcessor('template_surat/surat-cuti.docx');
        $document->setValue('nama', $leave->user->name);
        $document->setValue('nip', $leave->user->nip);
        $document->setValue('jabatan', $leave->user->jabatan);
        $document->setValue('pangkat', $leave->user->pangkat);
        $document->setValue('jenis_cuti', $leave->category->title);
        $document->setValue('alasan', $leave->alasan);
        $document->setValue('durasi_cuti', $leave->durasi_cuti);
        $document->setValue('from', $leave->from);
        $document->setValue('to', $leave->to);
        $document->setValue('tanggal', $leave->updated_at);
        $document->setImageValue('ttd', array($leave->signature, 'width' => 200, 'height' => 200, 'ratio' => false));
        // $document->setValue('ttd', $leave->user->ttd);
        $leader = User::where('jabatan', 'Kepala Sekolah')->first();
        $document->setValue('kepala_sekolah', $leader->jabatan);
        $document->setValue('nama_kepalaSekolah', $leader->name);

        $fileName = 'Surat-Cuti-' . $leave->user->name;
        $document->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
