<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Attendance;
use Illuminate\Http\Request;

class ScanQRController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.scan.index');
    }

    public function validasi(Request $request)
    {
        $qrCode = $request->qr_code;
        $member = Member::where('id', $qrCode)->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member tidak ditemukan'
            ], 404);
        }

        $today = now()->toDateString();

        // Cek apakah sudah absen hari ini
        $sudahAbsen = Attendance::where('member_id', $member->id)
            ->where('tanggal', $today)
            ->exists();

        if ($sudahAbsen) {
            return response()->json([
                'success' => false,
                'message' => 'Member sudah absen hari ini'
            ], 403); // 403 artinya forbidden
        }

        // Simpan absensi
        Attendance::create([
            'member_id' => $member->id,
            'tanggal' => $today,
            'kehadiran' => 'Hadir', // default, bisa dikembangkan jika ada opsi lain
            'waktu_scan' => now()->format('H:i:s'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Selamat Datang ' . $member->name,
            'member' => $member
        ]);
    }
}
