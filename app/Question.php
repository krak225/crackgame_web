<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Entrainement;

class Question extends Model
{
    //
	protected $table = 'question';
	protected $primaryKey = 'id';
	public $timestamps = false;
	
	
	public static function getQuestionRandom($categorie_id){
		
		$data = Entrainement::where(['entrainement_statut'=>"EN COURS", 'user_id'=>Auth::user()->id])->orderByDesc('entrainement_id')->first();
		
		if(!empty($data)){
			
			$entrainement_id = $data->entrainement_id;
			
			$sql = 'select * from question where categorie_id="'.$categorie_id.'" AND id NOT IN (select question_id from entrainement_question where user_id = "'.Auth::user()->id.'" AND entrainement_id="'.$entrainement_id.'") order by id ASC ';

			
			$total = count(DB::select($sql));
			
			if($total >= 1){

				$i = mt_rand( 0 , $total - 1 );
				
				$sql2 = $sql.' LIMIT ' . $i . ' , 1' ;
				
				return DB::select($sql);

			}else{

				return null;

			}
		
		
		}else{

			return null;

		}
		
		
		
	}
	
	
	public static function getQuestion($question_id){
		
		return current(DB::select('select * from question where id =  "' . $question_id . '" limit 0,1 '));
		
	}
	
	
	public static function getQuestionChap($chap_id){
		
		
		return DB::select('select * 
		from question 
		inner join chap_question on chap_question.question_id = question.id
		where chap_id =  "' . $chap_id . '" ');
		
	}
	
	
	
	public static function getQuestionsDuel($duel_id){
		
		
		return DB::select('select * 
		from question 
		where user_id =  "' . Auth::user()->id . '" and statut_selection="SELECTED" ');
		
	}
	
	
	public static function isUsedInDuel($duel_id,$question_id){
		
		
		$data = current(DB::select('select * from duel_question where duel_id =  "' . $duel_id . '" and question_id =  "' . $question_id . '"  limit 0,1 '));
		
		if(count($data) > 0){
			
			return true;
			
		}else{
			
			return false;
			
		}
		
		
	}
	
	
	
}
