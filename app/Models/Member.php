<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    protected $fillable = [
        'id',
        'name',
        'age',
        'gender',
        'package',
        'phone_number',
        'membership_start',
        'membership_end',
        'status',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
