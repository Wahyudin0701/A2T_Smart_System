<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('admin.members.index', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'gender' => 'required|in:laki-laki,perempuan',
            'phone_number' => 'string|max:20',
            'package' => 'required|in:1,2,6,12',
        ]);

        $start = now()->startOfDay(); // hari ini
        $end = (clone $start)->addMonths((int) $validated['package'])->subDay(); // akhir paket
        $status = $end->isFuture() ? 'Active' : 'Inactive';

        Member::create([
            'name' => $validated['name'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'phone_number' => $validated['phone_number'],
            'package' => $validated['package'],
            'membership_start' => $start,
            'membership_end' => $end,
            'status' => $status,
        ]);

        return redirect()->route('members.index')->with('success', 'Data member berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:laki-laki,perempuan',
            'package' => 'required|integer|min:1',
            'phone_number' => 'required|string|max:20',
            'membership_start' => 'required|date',
            'membership_end' => 'required|date|after_or_equal:membership_start',
        ]);

        $member = Member::findOrFail($id);

        // Tentukan status berdasarkan membership_end
        $today = Carbon::today();
        $endDate = Carbon::parse($request->membership_end);
        $status = $endDate->gte($today) ? 'Active' : 'Inactive';

        $member->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'package' => $request->package,
            'phone_number' => $request->phone_number,
            'membership_start' => $request->membership_start,
            'membership_end' => $request->membership_end,
            'status' => $status, // update status otomatis
        ]);

        return redirect()->back()->with('success', 'Data member berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Data member ' . $member->name . ' berhasil dihapus.');
    }

    public function generateAndDownloadQr($id)
    {
        $member = Member::findOrFail($id);

        // Cek jika belum ada QR, generate dulu
        if (!$member->qr_code || !Storage::disk('public')->exists($member->qr_code)) {
            $qrData = $member->id; // Bisa ganti jadi UUID atau URL absen
            $qrImage = QrCode::format('png')
                ->size(300)
                ->margin(2)
                ->generate($qrData);

            // Buat label nama (teks di bawah QR code)
            $labelImage = $this->createTextLabelPng($member->name);

            // Gabungkan QR + Label jadi 1 gambar
            $combinedImage = $this->combineQrAndLabel($qrImage, $labelImage);
            $filePath = "qrcodes/member-{$member->id}.png";
            Storage::disk('public')->put($filePath, $combinedImage);

            $member->qr_code = $filePath;
            $member->save();
        }


        $filename = 'qr-' . Str::slug($member->nama ?? 'member-' . $member->id) . '.png';

        return response()->download(
            storage_path('app/public/' . $member->qr_code),
            $filename
        );
    }

    private function createTextLabelPng($text)
    {
        $font = 5;
        $padding = 10;

        $textWidth = imagefontwidth($font) * strlen($text);
        $textHeight = imagefontheight($font);

        $width = $textWidth + 2 * $padding;
        $height = $textHeight + 2 * $padding;

        $image = imagecreate($width, $height);
        $white = imagecolorallocate($image, 255, 255, 255); // Background
        $black = imagecolorallocate($image, 0, 0, 0);       // Text

        imagestring($image, $font, $padding, $padding, $text, $black);

        ob_start();
        imagepng($image);
        $output = ob_get_clean();

        imagedestroy($image);
        return $output;
    }


    private function combineQrAndLabel($qrPng, $labelPng)
    {
        $qrImage = imagecreatefromstring($qrPng);
        $labelImage = imagecreatefromstring($labelPng);

        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);

        $labelWidth = imagesx($labelImage);
        $labelHeight = imagesy($labelImage);

        $combinedHeight = $qrHeight + $labelHeight + 10; // 10px padding
        $combinedImage = imagecreatetruecolor($qrWidth, $combinedHeight);

        $white = imagecolorallocate($combinedImage, 255, 255, 255);
        imagefill($combinedImage, 0, 0, $white);

        // Tempel QR
        imagecopy($combinedImage, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);

        // Tempel label di bawah QR, posisi tengah
        $labelX = ($qrWidth - $labelWidth) / 2;
        imagecopy($combinedImage, $labelImage, $labelX, $qrHeight + 5, 0, 0, $labelWidth, $labelHeight);

        ob_start();
        imagepng($combinedImage);
        $result = ob_get_clean();

        imagedestroy($qrImage);
        imagedestroy($labelImage);
        imagedestroy($combinedImage);

        return $result;
    }
}
