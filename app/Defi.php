<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Defi extends Model
{
    //
	protected $table = 'defi';
	protected $primaryKey = 'defi_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
