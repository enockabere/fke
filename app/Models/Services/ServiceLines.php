<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLines extends Model
{
    use HasFactory;

    protected $table;
    public $incrementing = false;
    public $timestamps = false;

    public function __construct()
    {
        $this->table = config('app.fullDBName')."Services Responses";
    }

}
