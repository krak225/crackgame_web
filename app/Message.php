<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Message extends Model
{
    //
	protected $table = 'message';
	protected $primaryKey = 'message_id';
	public $timestamps = false;
	public $increments = true;
	

}
