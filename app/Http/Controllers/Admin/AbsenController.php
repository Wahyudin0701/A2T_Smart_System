<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AbsenController extends Controller
{
    public function hadir(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->toDateString());
        $formattedTanggal = Carbon::parse($tanggal)->locale('id')->translatedFormat('l, j F Y');

        $members = Member::whereHas('attendances', function ($query) use ($tanggal) {
            $query->whereDate('tanggal', $tanggal)
                ->where('kehadiran', 'hadir');
        })->get();

        return view('admin.absensi.index', [
            'members' => $members,
            'tanggal' => $tanggal,
            'format_tanggal' => $formattedTanggal,
            'status' => 'hadir',
        ]);
    }


    public function belumAbsen(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->toDateString());
        $formattedTanggal = Carbon::parse($tanggal)->locale('id')->translatedFormat('l, j F Y');

        $members = Member::whereDoesntHave('attendances', function ($query) use ($tanggal) {
            $query->whereDate('tanggal', $tanggal)
                ->where('kehadiran', 'hadir');
        })->get();

        return view('admin.absensi.index', [
            'members' => $members,
            'tanggal' => $tanggal,
            'format_tanggal' => $formattedTanggal,
            'status' => 'belum_absen',
        ]);
    }


    public function semua(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->toDateString());
        $formattedTanggal = Carbon::parse($tanggal)->locale('id')->translatedFormat('l, j F Y');

        $members = Member::all();

        return view('admin.absensi.index', [
            'members' => $members,
            'tanggal' => $tanggal,
            'format_tanggal' => $formattedTanggal,
            'status' => 'semua',
        ]);
    }

    public function editAbsensi(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'kehadiran' => 'nullable|in:hadir,tidak_hadir',
            'waktu_scan' => 'nullable|date_format:H:i',
        ]);

        $memberId = $request->member_id;
        $kehadiran = $request->kehadiran;
        $waktuScan = $request->waktu_scan;
        $tanggal = $request->tanggal; 

        $attendance = Attendance::where('member_id', $memberId)
            ->whereDate('tanggal', $tanggal)
            ->first();

        if ($kehadiran === 'tidak_hadir') {
            if ($attendance) {
                $attendance->delete(); // ❌ delete
            }
        } elseif ($kehadiran === 'hadir') {
            if ($attendance) {
                // update waktu_scan jika berubah
                $attendance->waktu_scan = $waktuScan ?? $attendance->waktu_scan;
                $attendance->save();
            } else {
                // insert baru
                Attendance::create([
                    'member_id' => $memberId,
                    'tanggal' => $tanggal,
                    'kehadiran' => 'hadir',
                    'waktu_scan' => $waktuScan ?? now()->format('H:i:s'),
                ]);
            }
        }

        return back()->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
