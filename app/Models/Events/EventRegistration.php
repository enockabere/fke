<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Events\EventAttendees;


class EventRegistration extends Model
{
    use HasFactory;

    protected $table;
    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = ["timestamp"];

	public function __construct(){
		$this->table = config('app.fullDBName')."Event Registration";
	}

    public function Attendees()
    {
        return $this->hasMany(EventAttendees::class, 'No', 'No');
    }
}
