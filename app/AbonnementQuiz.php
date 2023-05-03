<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AbonnementQuiz extends Model
{
    //
	protected $table = 'abonnement_quiz';
	protected $primaryKey = 'abonnement_quiz_id';
	public $timestamps = false;
	public $increments = true;
	
	
	
}
