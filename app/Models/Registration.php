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
        'workshop_status',
        'registered_date',
        'is_pitching',
        'exhibit_product',
        'phone_number',
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

    public function attendances() {
        return $this->hasMany(Attendance::class, 'registration_id');
    }

    // Get pitching
    public function pitching() {
        return $this->hasOne(Pitching::class, 'registration_id');
    }
}
