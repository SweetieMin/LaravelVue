<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'title',
        'sub_title',
        'start_date_event',
        'expired_date_event',
        'start_date_application',
        'end_date_application',
        'first_contact',
        'first_phone',
    ];

    protected $casts = [
        'start_date_event' => 'date',
        'expired_date_event' => 'date',
        'start_date_application' => 'date',
        'end_date_application' => 'date',
    ];

    public function awards()
    {
        return $this->hasMany(Award::class);
    }
}
