<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    // Force singular table name to match your migration
    protected $table = 'registration';

    // Map custom timestamp names
    public const CREATED_AT = 'registered_date';
    public const UPDATED_AT = 'updated_at';

    // Allow mass assignment for these columns
    protected $fillable = [
        'attendee_id',
        'event_id',
        'workshop_id',
        'qr_code_value',
        'status',
        'registered_date',
        'updated_at',
    ];

    /**
     * Relationship to the User (Attendee)
     */
    public function attendee() 
    {
        return $this->belongsTo(User::class, 'attendee_id');
    }

    /**
     * Relationship to the Workshop
     */
    public function workshop() 
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }
}