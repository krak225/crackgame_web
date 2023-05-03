<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Souscription extends Model
{
    //
	protected $table = 'souscription';
	protected $primaryKey = 'souscription_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
