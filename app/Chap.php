<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Chap extends Model
{
    //
	protected $table = 'chap';
	protected $primaryKey = 'Chap_id';
	public $timestamps = false;
	public $increments = true;
	
	public static function IncrementParticipant($chap_id){
		DB::table('chap')->increment('chap_participants', 1);
	}

	public static function getMyChap($chap_id){
		
		return DB::select('select * from chap_score where chap_id = "' . $chap_id . '" and user_id="'.Auth::user()->id.'"');
		
	}
	
	public static function getScoresChap($chap_id){
		
		return DB::select('select * 
		from users 
		inner join chap_score on chap_score.user_id = users.id
		where chap_id =  "' . $chap_id . '" ');
		
	}


	public static function AutorisePlayChap($chap_id){

		$chap = Self::find($chap_id);
		if(!empty($chap)){

			$chap = Self::whereRaw(' chap_statut="EN COURS" AND chap_id="'.$chap_id.'" and "'.date('Y-m-d H:i:s').'" >= chap_date_debut ')->first();

			//dd($chap);
			if(!empty($chap)){

			$etape = $chap->chap_etape;

				if($etape == 1){

					return true;

				}else{

					$sql = 'select * from chap_score where chap_id =  "' . $chap_id . '" and chap_etape="'. $etape .'" and user_id = "'. Auth::user()->id.'"';
					
					$data_score = DB::select($sql);

					if(!empty($data_score)){

						return true;

					}else{

						return false;

					}

				}
					
			}else{
				return false;
			}

		}else{
			return false;
		}


	}
	

}
