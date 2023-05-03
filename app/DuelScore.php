<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class DuelScore extends Model
{
    //
	protected $table = 'duel_score';
	public $timestamps = false;
	
	public static function getScore($duel_id,$user_id){
		$sql = 'select * from duel_score where duel_id="'.$duel_id.'" and user_id="'.$user_id.'"';
		$data = (object) current(DB::select($sql));
		
		return $data->score;
	}
	
}
