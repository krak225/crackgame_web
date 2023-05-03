<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Circonscription extends Model
{
    //
	protected $table = 'circonscription';
	protected $primaryKey = 'circonscriptionID';
	public $timestamps = false;
	
	
	public static function getCirconscriptionIDByLibelle($circonscriptionLibelle){
		
		$circonscriptionLibelle = str_replace("n'",'',$circonscriptionLibelle);
		$circonscriptionLibelle = str_replace("N'",'',$circonscriptionLibelle);
		$circonscriptionLibelle = str_replace("m'",'',$circonscriptionLibelle);
		$circonscriptionLibelle = str_replace("M'",'',$circonscriptionLibelle);
		$circonscriptionLibelle = str_replace("'",'',$circonscriptionLibelle);
		
		$id =  0;
		
		if(!empty($circonscriptionLibelle)){
			
			$sql = "select circonscriptionID from circonscription 
						WHERE circonscriptionLibelle LIKE '%".$circonscriptionLibelle."%'";
					
			$data = current(DB::select($sql));
			
			
			if(!empty($data)){
				$id = isset($data->circonscriptionID)? $data->circonscriptionID : 0;;
			}
			
		}
		
		
		return $id;
		
		
	}
	
}
