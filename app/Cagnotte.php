<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cagnotte extends Model
{
    //
	protected $table = 'cagnotte';
	protected $primaryKey = 'cagnotte_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
