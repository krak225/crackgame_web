<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Conversion extends Model
{
    //
	protected $table = 'conversion';
	protected $primaryKey = 'conversion_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
