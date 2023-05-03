<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Profession extends Model
{
    //
	protected $table = 'profession';
	protected $primaryKey = 'PROFESSION_ID';
	public $timestamps = false;
	
	
	public static function getProfessionIDByLibelle($profession_libelle){
		
		// $profession_libelle = stripslashes($profession_libelle);
		$profession_libelle = str_replace("n'",'',$profession_libelle);
		$profession_libelle = str_replace("N'",'',$profession_libelle);
		$profession_libelle = str_replace("m'",'',$profession_libelle);
		$profession_libelle = str_replace("M'",'',$profession_libelle);
		$profession_libelle = str_replace("'",'',$profession_libelle);
		
		$id =  0;
		
		if(!empty($profession_libelle)){
			
			$sql = "select PROFESSION_ID from profession 
						WHERE PROFESSION_LIBELLE LIKE '%".$profession_libelle."%'";
					
			$data = current(DB::select($sql));
			
			
			if(!empty($data)){
				$id = isset($data->PROFESSION_ID)? $data->PROFESSION_ID : 0;;
			}
			
		}
		
		return $id;
	}
	
	
}
