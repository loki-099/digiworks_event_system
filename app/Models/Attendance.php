<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $table = 'attendance';

    protected $fillable = [
        'registration_id',
        'for',
    ];

    public function registration() {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}
