<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Avatar extends Model
{
    //
	protected $table = 'avatar';
	protected $primaryKey = 'avatar_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
