<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Quiz extends Model
{
    //
	protected $table = 'quiz';
	protected $primaryKey = 'quiz_id';
	public $timestamps = false;
	public $increments = true;
	

}
