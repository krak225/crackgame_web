<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ChapQuestion extends Model
{
    //
	protected $table = 'chap_question';
	// protected $primaryKey = array('chap_id','user_id');
	public $timestamps = false;
	public $increments = true;
	
	
	
}
