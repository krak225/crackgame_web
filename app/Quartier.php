<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quartier extends Model
{
    //
	protected $table = 'quartier';
	protected $primaryKey = 'quartierID';
	public $timestamps = false;
	
	
	
	public static function getQuartierByCirconscription($circonscriptionID){
		
		$sql ='SELECT * FROM quartier 
		WHERE quartierStatut="VALIDE"
		AND circonscriptionID = "'.$circonscriptionID.'"  
		ORDER BY quartierLibelle ASC ';
		
        return DB::select($sql);
		
	}
	
	
	public static function getQuartierIDByLibelle($quartierLibelle){
		
		// $quartierLibelle = stripslashes($quartierLibelle);
		$quartierLibelle = str_replace("n'",'',$quartierLibelle);
		$quartierLibelle = str_replace("N'",'',$quartierLibelle);
		$quartierLibelle = str_replace("m'",'',$quartierLibelle);
		$quartierLibelle = str_replace("M'",'',$quartierLibelle);
		$quartierLibelle = str_replace("'",'',$quartierLibelle);
		
		$id =  0;
		
		if(!empty($quartierLibelle)){
			
			$sql = "select quartierID from quartier 
						WHERE quartierLibelle LIKE '%".$quartierLibelle."%'";
					// die($sql);
			$data = current(DB::select($sql));
			
			
			if(!empty($data)){
				$id = $data->quartierID;
			}
		
		}
		
		
		return $id;
		
	}
	
}
