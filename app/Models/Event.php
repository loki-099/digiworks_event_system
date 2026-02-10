<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = 'event';

    protected $fillable = [
        'name',
        'description',
        'venue',
        'start_date',
        'end_date',
    ];

    public function workshops(): HasMany
    {
        return $this->hasMany(Workshop::class);
    }

    /**
     * Get registrations for this event.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
