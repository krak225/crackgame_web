<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Abonnement extends Model
{
    //
	protected $table = 'abonnement';
	protected $primaryKey = 'abonnement_id';
	public $timestamps = false;
	public $increments = true;
	
	
	public static function getDuelistesAbonnes($user_id=null){
		
		$user_id = (Auth::user())? Auth::user()->id : $user_id;
		
		$users = Abonnement::select('id','user_id','pseudo','email','nom','prenoms','photo','lang_code','devise','total_points','total_points_test','total_points_duel','score_general')
						->join('users','id','user_id')
						->whereRaw('statut_connexion="CONNECTE" AND date(abonnement_date) = "'.gmdate('Y-m-d').'" and user_id <> "'.$user_id.'" and  user_id in (select user_id from question where statut_selection="SELECTED") ')
						->groupby(['id','user_id','pseudo','email','nom','prenoms','photo','lang_code','devise','total_points','total_points_test','total_points_duel','score_general'])
						->get();
	
						//statut_connexion="CONNECTE" AND date(abonnement_date) = "'.date('Y-m-d').'" and 
		// 

		return $users;
		
	}



	
}
