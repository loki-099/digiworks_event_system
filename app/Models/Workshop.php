<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workshop extends Model
{
    //
    protected $table = 'workshop';

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'speaker',
        'capacity',
        'venue',
        'start_date',
        'end_date'
    ];
}
