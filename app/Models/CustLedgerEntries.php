<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustLedgerEntries extends Model
{
    protected $table;
    public $incrementing = false;
    public $timestamps = false;


    protected $hidden = ["timestamp"];

	public function __construct(){
		$this->table = config('app.fullDBName')."Cust_ Ledger Entry";
	}

}

