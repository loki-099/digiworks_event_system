<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pitching extends Model
{
    //
    protected $table = 'pitching';

    protected $fillable = [
        'registration_id',
        'group_name',
        'organization',
        'team_members'
    ];

    public function registration() {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}
