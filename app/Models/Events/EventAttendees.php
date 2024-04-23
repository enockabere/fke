<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendees extends Model
{
    use HasFactory;

    protected $table;
    public $incrementing = false;
    public $timestamps = false;

    public function __construct()
    {
        $this->table = config('app.fullDBName')."Event Attendees";
    }

}
