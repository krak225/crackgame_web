<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class JockerQuestion extends Model
{
    //
	protected $table = 'jockerquestion';
	protected $primaryKey = 'jockerquestion_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
