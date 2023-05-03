<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EntrainementQuestion extends Model
{
    //
	protected $table = 'entrainement_question';
	protected $primaryKey = 'entrainement_question_id';
	public $timestamps = false;
	public $increments = true;
	
	
}
