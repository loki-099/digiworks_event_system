<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    protected $table = 'registration';

    protected $fillable = [
        'attendee_id',
        'event_id',
        'workshop_id',
        'qr_code_value',
        'is_going',
        'status',
        'registered_date',
    ];

    public const CREATED_AT = 'registered_date';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get the attendee user.
     */
    public function attendee()
    {
        return $this->belongsTo(User::class, 'attendee_id');
    }

    /**
     * Get the event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the workshop.
     */
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
