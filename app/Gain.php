<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Gain extends Model
{
    //
	protected $table = 'gain';
	protected $primaryKey = 'gain_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
