<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    //
    protected $table = 'event';

    public function workshops(): HasMany
    {
        return $this->hasMany(Workshop::class);
    }

    protected $fillable = [
        'name',
        'description',
        'venue',
        'start_date',
        'end_date'
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }
}
