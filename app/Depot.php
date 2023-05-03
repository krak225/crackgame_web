<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Depot extends Model
{
    //
	protected $table = 'depot';
	protected $primaryKey = 'depot_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
