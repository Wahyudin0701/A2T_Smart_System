<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['id',
    'member_id',
    'tanggal',
    'kehadiran',
    'waktu_scan'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
