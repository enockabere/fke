<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services\ServiceLines;


class Services extends Model
{
    use HasFactory;

    protected $table;
    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = ["timestamp"];

	public function __construct(){
		$this->table = config('app.fullDBName')."Services Requests";
	}

    public function ServiceLines()
    {
        return $this->hasMany(ServiceLines::class, 'No', 'No');
    }
}
