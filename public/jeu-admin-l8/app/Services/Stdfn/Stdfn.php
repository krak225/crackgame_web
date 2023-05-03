<?php

namespace App\Services\Stdfn;
// use Illuminate\Http\Request;
use App\Etablissement;
use App\Pointage;
use App\UserProfilApplication;
use DB;
use Auth;

class Stdfn
{
	
	protected $author;
	
	
		
	//Added on 01042021::cryptage de données
	
	public static function KHLOE_CRYPT($data){

		
		return $data;       

		
	}	
		

	public static function KHLOE_DECRYPT($input){

		return $input;

	}

	
	
	//Renvoi une chaine sur un nombre de caractère défini	
	public static function truncate($text, $n){
		
		$strlen = strlen($text);
		
		if ($strlen == $n) {
			
			$text = $text;
			
		}elseif($strlen > $n){
		
			$text = substr($text,0,$n);
		
		}elseif($strlen < $n){
			
			$diff = $n - $strlen;
		
			for($i = 0; $i < $diff; $i++){
				
				$text.=' ';
			
			}
			
		}
		
		return $text;
		
	}

	//pour les nombre a précéder de x zéro (0000...)
	public static function truncateN($text, $n){
		
		$strlen = strlen($text);
		
		if ($strlen == $n) {
			
			$text = $text;
			
		}elseif($strlen > $n){
		
			$text = substr($text,0,$n);
		
		}elseif($strlen < $n){
			
			$diff = $n - $strlen;
			$zero = '';
			
			for($i = 0; $i < $diff; $i++){
				
				$zero.='0';
			
			}
			
			$text = $zero.$text;
			
		}
		
		return $text;
		
	}

	
	
	
	public static function getPointage($user_id, $date){
		
		$data = Pointage::whereRaw('user_id="'.$user_id.'" and DATE(pointage_date)="'.$date.'"')->first();
		
		return (!empty($data))? $data->pointage_id : '' ;
		
	}
	
	public static function getHeureArrive($user_id, $date){
		
		$data = Pointage::whereRaw('user_id="'.$user_id.'" and DATE(pointage_date)="'.$date.'"')->first();
		
		return (!empty($data))? $data->pointage_arrivee : '' ;
		
	}
	
	
	public static function getHeureDepart($user_id, $date){
		
		$data = Pointage::whereRaw('user_id="'.$user_id.'" and DATE(pointage_date)="'.$date.'"')->first();
		
		return (!empty($data))? $data->pointage_depart : '' ;
		
	}
	
	public static function getStatutPresence($user_id, $date){
		
		$data = Pointage::whereRaw('user_id="'.$user_id.'" and DATE(pointage_date)="'.$date.'"')->first();
		
		return (!empty($data))? $data->pointage_statut_presence : '' ;
		
	}
	
	
	
	
	
	public static function getNombreEtsParEquipe($equipe_id){
		
		$nombre_ets = Etablissement::join('tb_users','tb_users.id','tb_etablissement.user_id')
						->where(['tb_users.equipe_id'=>$equipe_id,'etablissement_statut'=>'VALIDE'])
						->count();
		
		return $nombre_ets;
		
	}
	
	
	public static function debug($chaine){
		
		print '<pre>';print_r($chaine);print '</pre>';
		
	}
					
	public static function random_color_part() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}

	public static function RandomColor() {
		return '#'.Stdfn::random_color_part() . Stdfn::random_color_part() . Stdfn::random_color_part();
	}
	
			
	public static function generer_id(){
		
		srand((double)microtime()*1000000); 
		$id ="ID-".strtoupper(substr(md5(uniqid(rand())),0,7)); 

		return $id;
		
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
		$outdate=!empty($aaaa) ? $jj.'/'.$mm.'/'.$aaaa.' à '.$hh.':'.$ii : null;
		return $outdate;
	}
	
	public static function timeFromDB($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $aaaa, $mm, $jj,$hh,$ii,$ss);
		$outdate=!empty($hh) ? $hh.':'.$ii : null;
		return $outdate;
	}
	
	public static function date($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $aaaa, $mm, $jj,$hh,$ii,$ss);
		$outdate=!empty($aaaa) ? $aaaa.'-'.$mm.'-'.$jj : null;
		
		
		return $outdate;
	}
	
	
	
	public static function ApiSendSMS_SMSECO($smsID,$expediteur,$destinataires){
		
		/*
		
		$wsdl = "http://www.smseco.com/api/soap/wsdl/";
		
		$server = "http://www.smseco.com/api/soap/server/";
		
		$options = array("location" =>$server, "trace"=>true, 'style'=> SOAP_DOCUMENT, 'use'=> SOAP_LITERAL);
		
		$api = new SoapClient($wsdl, $options);
		
		$smsdatas = array("login"=>"krak225@gmail.com", "password"=>"123456", "msgid"=>$smsID, "msg"=>$message, "expediteur"=>$expediteur, "datesend"=>date('Y-m-d H:i:s'), "to"=>$destinataires);
		
		$resultat = $api->Sendsms($smsdatas);
		
		*/
		
		
		//
		
		$uri = "http://www.smseco.com/api/json/sendsms/";
		
		$data = "JSON={\"compte\":{\"login\":\"krak225@gmail.com\",\"password\":\"rtechno\"},\"message\":{\"expediteur\":\"PDCI\",\"msgid\":\"15\",\"msg\":\"Juste un est\"},\"destinataires\":[{\"numero\":\"04783689\"}, {\"numero\":\"08779408\"}]}";
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL,$uri);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER,array("Accept: application/json","Accept: application/json","Content-Type: application/json", "Content-Length: ". strlen($data)));
		
		curl_setopt($ch, CURLOPT_POST, true);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec ($ch);
		
		curl_close ($ch); // close curl handle

		
		return $output;
		
		
		
	}
	
	
	
	
	public static function ApiSendSMS($smsID,$expediteur,$destinataires,$message){
		
		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => 'https://portal.bulkgate.com/api/1.0/simple/promotional',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode([
				'application_id' => '1447',
				'application_token' => '9YeX9gTXrmpmABJW1KC8vwNzOOFL7ddRPHCwXyJtoHAlwNos16',
				'number' => implode(';', $destinataires),
				'text' => $message,
				'sender_id' => 'SMS'.$smsID,
				'sender_id_value' => $expediteur
			]),
			CURLOPT_HTTPHEADER => [
				'Content-Type: application/json'
			],
		]);

		$response = curl_exec($curl);

		if($error = curl_error($curl))
		{
			echo $error;
		}
		else
		{
			$response = json_decode($response);

			var_dump($response);
		}
		
		curl_close($curl);
		

		return $response;

		
	}
	
	
	
	
	//Added on 02032021
	public static function SiActionAutorisee($action_code){
		
		$profil_id = Auth::user()->profil_id;
		
		
		$sql = 'select action_id
		from tb_autorisation
		inner join tb_action using(action_id)
		where action_code="'.$action_code.'"
		and profil_id="'.$profil_id.'"
		and autorisation_statut="VALIDE"
		';
		
		// die($sql);
		$data = DB::select($sql);
		
		
		if(!empty($data)){
			return true;
		}else{
			return false;
		}
		
	}
	
	
										
																	
	
	
}