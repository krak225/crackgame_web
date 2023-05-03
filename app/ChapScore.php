<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ChapScore extends Model
{
    //
	protected $table = 'chap_score';
	// protected $primaryKey = array('chap_id','user_id');
	public $timestamps = false;
	public $increments = true;
	
	
	
}
