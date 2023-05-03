<?php
namespace App\Services\Stdfn;
use DB;
use App\Pays;
use App\Cagnotte;

class Stdfn
{
	
	protected $author;
	
	
	public static function DateDiffInterval($sDate1, $sDate2, $sUnit='S') {
      //subtract $sDate2-$sDate1 and return the difference in $sUnit (Days,Hours,Minutes,Seconds)
    $nInterval = strtotime($sDate2) - strtotime($sDate1);
    if ($sUnit=='D') { // days
        $nInterval = $nInterval/60/60/24;
    } else if ($sUnit=='H') { // hours
        $nInterval = $nInterval/60/60;
    } else if ($sUnit=='M') { // minutes
        $nInterval = $nInterval/60;
    } else if ($sUnit=='S') { // seconds

    }
    return $nInterval;
} //DateDiffInterval


	//
	public static function getTodayCagnotte(){

		$cagnotte = Cagnotte::where('Cagnotte_date',date('Y-m-d'))->first();


		return !empty($cagnotte)? number_format($cagnotte->cagnotte_montant,-2,'',' ') : 0;

	}
	
	
	//
	public static function getGainParQuestionChap($devise){
		switch($devise){
			default:
			case 'FCFA': return 20; break;
			case 'USD': return 20/540; break;
			case 'EUR': return 20/655.5 ; break;
		}
	}

	//
	public static function getFraisAbonnementDuel($devise){
		switch($devise){
			default:
			case 'FCFA': return 200; break;
			case 'USD': return 200/540; break;
			case 'EUR': return 200/655.5 ; break;
		}
	}
	
	
	public static function getFraisAbonnementChap($devise){
		switch($devise){
			default:
			case 'FCFA': return 100; break;
			case 'USD': return 100/540; break;
			case 'EUR': return 100/655.5 ; break;
		}
	}
	
	public static function getFraisAbonnementQuiz($devise){
		switch($devise){
			default:
			case 'FCFA': return 100; break;
			case 'USD': return 100/540; break;
			case 'EUR': return 100/655.5 ; break;
		}
	}
	
	public static function getFraisJockerQuestion($devise){
		switch($devise){
			default:
			case 'FCFA': return 100; break;
			case 'USD': return 100/540; break;
			case 'EUR': return 100/655.5 ; break;
		}
	}
	
	
	public static function isUsedInChap($chap_id,$question_id){
		
		$sql = 'select * from chap_question where chap_id =  "' . $chap_id . '" and question_id =  "' . $question_id . '" and statut="DISPONIBLE" ';
		
		$data = DB::select($sql);
		
		if(count($data) > 0){
			
			return false;
			
		}else{
			
			return true;
			
		}
		
		
	}
	
	
	public static function isUsedInDuel($duel_id,$question_id){
		
		
		$data = DB::select('select * from duel_question where duel_id =  "' . $duel_id . '" and question_id =  "' . $question_id . '"  limit 0,1 ');
		
		if(count($data) > 0){
			
			return true;
			
		}else{
			
			return false;
			
		}
		
		
	}
	
	
	//
	public static function getScoreDuel($duel_id,$user_id){
		$data = current(DB::select('select * from duel_score where duel_id=? and user_id=?',[$duel_id,$user_id]));
		
		return (!empty($data))? $data->score : '';
		
	}
	
	//
	public static function getUserDuel($duel_id,$user_id){
		$data = current(DB::select('select * from duel_score inner join users on users.id = duel_score.user_id where duel_score.duel_id=? and duel_score.user_id=?',[$duel_id,$user_id]));
		
		return (!empty($data))? $data->pseudo : '';
		
	}
	
	public static function paysNom($pays_id){
		$pays = current(DB::select('select * from pays where pays_id=?',[$pays_id]));
		
		return (!empty($pays))? $pays->pays_nom_fr : '';
		
	}
	
	//fn pour convertir les dates
	public static function dateToDB($date){
		$date = str_replace('-','/',$date);
		sscanf($date, "%2s/%2s/%4s", $jj, $mm, $aaaa);
		$dbdate= !empty($aaaa) ?$aaaa.'-'.$mm.'-'.$jj : null;
		
		return $dbdate;
	}
	
	public static function dateFromDB($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s", $aaaa, $mm, $jj);
		$outdate=!empty($aaaa) ? $jj.'/'.$mm.'/'.$aaaa : null;
		return $outdate;
	}
	
	public static function dateTimeFromDB($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $aaaa, $mm, $jj,$hh,$ii,$ss);
		$outdate=!empty($aaaa) ? $jj.'/'.$mm.'/'.$aaaa.' a '.$hh.':'.$ii : null;
		return $outdate;
	}
	
	public static function date($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $aaaa, $mm, $jj,$hh,$ii,$ss);
		$outdate=!empty($aaaa) ? $aaaa.'-'.$mm.'-'.$jj : null;
		
		
		return $outdate;
	}
	
	
}