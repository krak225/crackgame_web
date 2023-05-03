<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Circonscription;
use App\Profession;
use App\Quartier;
use App\Conversion;
use Rap2hpoutre\FastExcel\FastExcel;
use File;
use Session;

class ConversionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		
    }

	
    public function conversion_point()
    {
		$total_points_test = Auth::user()->total_points_test;
		$params = array('total_points_test'=>$total_points_test);
		
		if(Auth::user()->statut_abonnement == "ACTIVE"){
			return view('conversion_point', $params);
		}else{
			return back()->with('warning','VEUILLEZ SOUSCRIRE AUX DUELS DE LA JOURNEE AVANT DE FAIRE UNE CONVERSION');
		}
        
		
    }
	
    public function ConversionPoint(Request $request)
    {
		$output = array();
		
		$point_a_convertir = intval($request->point_a_convertir);
		
		
		$total_points_test = Auth::user()->total_points_test;
		
		if($total_points_test >= $point_a_convertir){
			
			$points_obtenus = $point_a_convertir * 0.25;
			$output['statut'] = 1;
			$output['message'] = 'Le point à convertir ne doit pas être suppérieur au point disponible';
			$output['montant_obtenu'] = $points_obtenus;
			
			//SAUVEGARDE EN BDD
			$conversion = new Conversion();
			$conversion->user_id = Auth::user()->id;
			$conversion->conversion_point = $point_a_convertir;
			$conversion->conversion_taux = 0.25;
			$conversion->total_points_duel = $points_obtenus;
			$conversion->conversion_date = date('Y-m-d H:i:s');
			$conversion->save();
			
			//débiter
			$user = Auth::user();
			$user->total_points_test = $total_points_test - $point_a_convertir;
			$user->total_points_duel = $user->total_points_duel + $points_obtenus;
			$user->exists = true;
			$user->save();	

			
			
		}else{
			$output['statut'] = 2;
			$output['message'] = 'Le point à convertir ne doit pas être suppérieur au point disponible';
			$output['montant_obtenu'] = 0;
		}
		
		return back()->with('message','Opération effectuée avec succès');
		
    }
	
	
    public function conversion_devise()
    {
		$params = array();
		
        return view('conversion_devise', $params);
		
    }
	
	
    public function ConversionDevise(Request $request)
    {
		// dd($request);
    }
	
	
	
    public function AutoConversion(Request $request)
    {	
	
		$output = array();
		
		$point_a_convertir = intval($request->point_a_convertir);
		
		
		$total_points_test = Auth::user()->total_points_test;
		
		if($total_points_test >= $point_a_convertir){
			
			$points_obtenus = $point_a_convertir * 0.25;
			$output['statut'] = 1;
			$output['message'] = 'Le point à convertir ne doit pas être suppérieur au point disponible';
			$output['montant_obtenu'] = $points_obtenus;
			
		}else{
			$output['statut'] = 2;
			$output['message'] = 'Le point à convertir ne doit pas être suppérieur au point disponible';
			$output['montant_obtenu'] = 0;
		}
		
		return $output;
		
    }
	
	
	
	
}
