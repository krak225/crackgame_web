<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Entrainement extends Model
{
    //
	protected $table = 'entrainement';
	protected $primaryKey = 'entrainement_id';
	public $timestamps = false;
	public $increments = true;
	
	
	public static function getRecords($user_id){
		
		$sql = 'select user_id,pseudo,categorie_id,categorie_libelle,max(entrainement_score) as entrainement_score
				from entrainement
				inner join categorie using(categorie_id)
				inner join users on users.id = entrainement.user_id
				where user_id = "'.$user_id.'"
				group by user_id,pseudo,categorie_id,categorie_libelle
				';
		
		// die($sql);dd();
		
		return DB::select($sql);
		
	}
	
	public static function getQuestionRandom($categorie_id){
		
		$total = count(DB::select('select * from question where categorie_id="'.$categorie_id.'"'));
		
		$i = mt_rand( 0 , $total - 1 );
		
		return DB::select('select * from question where categorie_id="'.$categorie_id.'" order by id ASC LIMIT ' . $i . ' , 1');
		
	}
	
	
	public static function getQuestion($question_id){
		
		return current(DB::select('select * from question where id =  "' . $question_id . '" limit 0,1 '));
		
	}
	
	
	public static function getMyQuestions($user_id){
		
		
	}
	
	
	public static function getScore($user_id){
		
		$data = current(DB::select('select entrainement_score from entrainement where user_id =  "' . $user_id . '" limit 0,1 '));
		
		return isset($data->entrainement_score)? $data->entrainement_score : 'entrainement_score';
		
	}
	
	
	public static function getCompteurQuestion($user_id){
		
		$data = current(DB::select('select entrainement_compteur_question from entrainement where user_id =  "' . $user_id . '" limit 0,1 '));
		$entrainement_compteur_question = $data->entrainement_compteur_question;
		
		//Incrémenter le compteur
		Entrainement::where('user_id',$user_id)->update(['entrainement_compteur_question'=>$entrainement_compteur_question + 1]);
		
		return $entrainement_compteur_question;
		
	}
	
	
	public static function getEntrainements($user_id){
		
		$data = DB::select('select * from entrainement where user_id =  "' . $user_id . '"');
		
		return $data;
		
	}

	
}
