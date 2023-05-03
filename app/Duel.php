<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Duel extends Model
{
    //
	protected $table = 'duel';
	protected $primaryKey = 'duel_id';
	public $timestamps = false;
	public $increments = true;
	
	
	public static function getDuelExistantJour($user_id,$adversaire_id){
		
		$sql= 'select * 
		from duel 
		where (( user_id = "'.$user_id.'" and adversaire_id = "'.$adversaire_id.'" )
		or ( user_id = "'.$adversaire_id.'" and adversaire_id = "'.$user_id.'" ))
		and DATE(duel_date_creation) = "'. date('Y-m-d') .'"
		limit 0,1
		';
		
		return (object) current(DB::select($sql));
		
	}
	
	public static function getDuels($user_id,$statut=''){
		
		$statut = str_replace('encours','EN COURS',$statut);
		$statut = str_replace('termines','TERMINE',$statut);
		
		$tab = array('BROUILLON','VALIDE','EN COURS','TERMINE');
		$where = in_array($statut,$tab) ? ' and duel.duel_statut ="'.$statut.'"' : '';
		
		$sql= 'select * 
		from duel 
		inner join users on users.id = duel.user_id
		where ( duel.user_id = "'.$user_id.'" or duel.adversaire_id = "'.$user_id.'" )
		';
		
		$sql.= $where;
		
		$sql.=' order by duel_id desc';
		
		// echo($sql);dd();
		
		return DB::select($sql);
		
		
	}
	
	public static function getJockersDisponibles($duel_id){
		
		$sql= 'select 3 - jocker_utilise as jockers_disponibles 
		from duel_jocker 
		where duel_id = "'.$duel_id.'" and user_id="'.Auth::user()->id.'"';
		
		$data = current((object) DB::select($sql));
		
		return $data->jockers_disponibles;
		
	}
	
	public static function getClassementByPointsDuel(){
		
		
		$sql= 'select id, pseudo, photo, total_points_duel from users ORDER BY total_points_duel desc';
		
		return DB::select($sql);
		
	}
	
	public static function getClassementByDuelsJoues(){
		
		
		$sql= 'select id, pseudo, photo, count(*) as duels_joues from users inner join duel on (duel.user_id = users.id OR duel.adversaire_id = users.id ) where duel_statut="TERMINE" group by id,pseudo,photo ORDER BY duels_joues desc';
		
		return DB::select($sql);
		
	}
	
	public static function getClassementByDuelsGagnes(){
		
		
		$sql= 'select id, pseudo, photo, count(*) as duels_gagnes from users inner join duel on duel.duel_vainqueur_id = users.id where duel_statut="TERMINE" group by id,pseudo,photo ORDER BY duels_gagnes desc';
		
		return DB::select($sql);
		
		
	}
	
	public static function getGagnants(){
		
		
		$sql= ' select * from duel 
		inner join users on users.id = duel.duel_vainqueur_id 
		inner join duel_score on duel_score.duel_id = duel.duel_id and duel_score.user_id = duel.duel_vainqueur_id ';
		
		return DB::select($sql);
		
		
	}
	
}
