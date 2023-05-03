<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Retrait extends Model
{
    //
	protected $table = 'retrait';
	protected $primaryKey = 'retrait_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
