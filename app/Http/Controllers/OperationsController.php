<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Circonscription;
use App\Profession;
use App\Quartier;
use App\Conversion;
use App\Depot;
use App\Retrait;
use App\Souscription;
use App\JockerQuestion;
use Rap2hpoutre\FastExcel\FastExcel;
use File;
use Session;
use Stdfn;

class OperationsController extends Controller
{

	public $frais_souscription_duel;
	public $frais_souscription_chap;
	public $frais_jocker_question;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		
    }

	
    public function depot()
    {
		
		$params = array();
		
        return view('depot', $params);
		
    }
	
    public function SaveDepot(Request $request)
    {
		$montant = intval($request->montant);
		// dd($montant);
		if(!empty($montant)){
			
			//SAUVEGARDE EN BDD
			$depot = new Depot();
			$depot->user_id = Auth::user()->id;
			$depot->depot_montant = $montant;
			$depot->depot_date = date('Y-m-d H:i:s');
			$depot->save();
			
			
			//MISE A JOUR DU SOLDE DE L'UTILISATEUR
			$user = Auth::user();
			$user->money = $user->money + $montant;
			$user->exists = true;
			$user->save();
			
			return back()->with('message','Opération effectuée avec succès');
		
		
		}else{
			
			return back()->with('warning','Veuillez saisir le montant du dépot');
		
		}
		
    }
	
	
    public function depots()
    {
		
		$depots = Depot::join('users','id','user_id')
			->where('user_id',Auth::user()->id)->get();
			
		$params = array();
		$params['depots'] = $depots;
		
        return view('depots', $params);
		
    }
	
    public function retraits()
    {
		
		$retraits = Retrait::join('users','id','user_id')
			->where('user_id',Auth::user()->id)->get();
			
		$params = array();
		$params['retraits'] = $retraits;
		
        return view('retraits', $params);
		
    }
	
    public function retrait()
    {
		
		$params = array();
		
        return view('retrait', $params);
		
    }
	
    public function SaveRetrait(Request $request)
    {
		
		$retrait 					= new Retrait();
		
		$retrait->user_id 			= Auth::user()->id;
		
		if(Auth::user()->money > $request->montant){
			
			$retrait->retrait_montant 		= $request->montant;
			$retrait->retrait_date_demande 	= date('Y-m-d H:i:s');
			
			$retrait->save();
			
			
			return back()->with('message','Votre demande de retrait a été réçu avec succès');
			
		}else{
			
			return back()->with('warning','Votre solde est insuffisant');
			
		}
    }
	
	
	
    public function souscriptions()
    {
		
		$souscriptions = Souscription::join('users','id','beneficiaire_user_id')
							->where('user_id',Auth::user()->id)->get();
		
		$params = array();
		$params['souscriptions'] = $souscriptions;
		
		// dd($souscriptions);
        return view('souscriptions', $params);
		
    }
	
	
    public function montant_souscription($quantite)
    {
		
		$params = array();
		
        $frais =  Stdfn::getFraisAbonnementDuel(Auth::user()->devise);
        
        return $quantite * number_format($frais,2,'.','');
		
    }
	
    public function souscription()
    {
		
		$params = array();
		
        $params['frais_souscription_duel'] = Stdfn::getFraisAbonnementDuel(Auth::user()->devise);
        $params['devise'] = Auth::user()->devise;

        return view('souscription', $params);
		
    }
	
	 public function SaveSouscription(Request $request)
    {
		// dd($request->quantite);
		
        $this->frais_souscription_duel = Stdfn::getFraisAbonnementDuel(Auth::user()->devise);
        $this->frais_souscription_chap = Stdfn::getFraisAbonnementChap(Auth::user()->devise);

        $frais_total = $this->frais_souscription_duel * $request->quantite;

        if(Auth::user()->money >= $frais_total ){

			$pour_qui = $request->pour_qui;
			$pseudo_ami = $request->pseudo_ami;
			
			$souscription = new Souscription();
			$souscription->user_id = Auth::user()->id;
				
			if($pour_qui == 'moi'){
				
				
				$souscription->beneficiaire_user_id = Auth::user()->id;
				
				$user = User::find(Auth::user()->id);
				$user->souscription = $user->souscription + $request->quantite;
				$user->money = $user->money - $this->frais_souscription_duel * $request->quantite;
				$user->exists = true;
				$user->save();
				
			}else {
				
				$beneficiaire_user = current(User::where('pseudo',$pseudo_ami)->get());
				
				if(!empty($beneficiaire_user)){
					$beneficiaire_user = $beneficiaire_user[0];
					$beneficiaire_user_id = $beneficiaire_user->id;
				
					$souscription->beneficiaire_user_id = $beneficiaire_user_id;
					
					$user = User::find($beneficiaire_user_id);
					$user->souscription = $user->souscription + $request->quantite;
					$user->exists = true;
					$user->save();
					
					
					$user = User::find(Auth::user()->id);
					$user->money = $user->money - $this->frais_souscription_duel * $request->quantite;
					$user->exists = true;
					$user->save();
					
					
				}else{
					return back()->with('warning','Veuillez entrer un pseudo valide');
				}
			}
			
			$souscription->souscription_quantite = $request->quantite;
			$souscription->souscription_montant = $request->montant;
			$souscription->souscription_date = date('Y-m-d H:i:s');
			$souscription->save();
			

			//Ajout des bonnus en fonction des souscriptions
			$quantite = $request->quantite;

			$jockerquestion = new JockerQuestion();
			$jockerquestion->user_id = Auth::user()->id;
			$jockerquestion->beneficiaire_user_id = Auth::user()->id;

			$bonus = 0;

			if($quantite > 1 && $quantite < 5) {
				$bonus = 5;
			}elseif($quantite > 5 && $quantite < 10){
				$bonus = 10;
			}elseif($quantite > 10 && $quantite < 20){
				$bonus = 20;
			}elseif($quantite > 20 && $quantite < 30){
				$bonus = 30;
			}elseif($quantite > 30 && $quantite < 40){
				$bonus = 40;
			}elseif($quantite > 40 && $quantite < 50){
				$bonus = 50;
			}elseif($quantite > 50 && $quantite < 60){
				$bonus = 60;
			}

			if($bonus > 0){

				$jockerquestion->jockerquestion_quantite = $bonus;
				$jockerquestion->save();
				//dd($jockerquestion);


				$user->jocker_question = $user->jocker_question + $bonus;
				$user->save();

			}


			return back()->with('message','Opération effectuée avec succès');
			
		}else{

			return back()->with('warning',"FONDS INSUFFISANT, VEUILLEZ FAIRE UN DEPOT AVANT D'ACHETER DES SOUSCRIPTONS");
			
		}

    }

	
	
    public function SaveSouscription_OLD(Request $request)
    {
		$quantite = intval($request->quantite);
		// $proprietaire_id = intval($request->proprietaire_id);
		
		if(!empty($quantite)){
			
			//SAUVEGARDE EN BDD
			$souscription = new Souscription();
			$souscription->user_id = Auth::user()->id;
			$souscription->souscription_quantite = $quantite;
			$souscription->souscription_montant = $quantite * $this->frais_souscription_duel;
			$souscription->save();
			
			
			//MISE A JOUR DU SOLDE DE L'UTILISATEUR
			$user = Auth::user();
			$user->souscription = $user->souscription + $quantite;
			$user->exists = true;
			$user->save();
			
			return back()->with('message','Opération effectuée avec succès');
		
		
		}else{
			
			return back()->with('warning','Veuillez choisir la quantite');
		
		}
		
    }
	
	
    public function montant_jocker($quantite)
    {
		
		$params = array();
		
        $frais =  Stdfn::getFraisJockerQuestion(Auth::user()->devise);
        
        return $quantite * number_format($frais,2,'.','');
		
    }
	
    public function jockers()
    {
		$jockers = JockerQuestion::join('users','id','beneficiaire_user_id')
							->where('user_id',Auth::user()->id)->get();
		// dd($jockers);
		$params = array();
		$params['jockers'] = $jockers;
		
        return view('jockers', $params);
		
    }
	
	
    public function jocker_question()
    {
		
		$params = array();
		
        $params['frais_jocker_question'] = Stdfn::getFraisJockerQuestion(Auth::user()->devise);
        $params['devise'] = Auth::user()->devise;

        return view('jocker_question', $params);
		
    }
	
	
	
    public function SaveJockerQuestion(Request $request)
    {
		// dd($request->quantite);
		
        $this->frais_jocker_question = Stdfn::getFraisJockerQuestion(Auth::user()->devise);
		

		$frais_total = $this->frais_souscription_duel * $request->quantite;

        if(Auth::user()->money >= $frais_total ){

			$pour_qui = $request->pour_qui;
			$pseudo_ami = $request->pseudo_ami;
			
			$jockerquestion = new JockerQuestion();
			
			$jockerquestion->user_id = Auth::user()->id;
			
			if($pour_qui == 'moi'){
				
				
				$jockerquestion->beneficiaire_user_id = Auth::user()->id;
				
				$user = User::find(Auth::user()->id);
				$user->jocker_question = $user->jocker_question + $request->quantite;
				$user->money = $user->money - $this->frais_jocker_question * $request->quantite;
				$user->exists = true;
				$user->save();
				
			}else {
				
				$beneficiaire_user = current(User::where('pseudo',$pseudo_ami)->get());
				
				if(!empty($beneficiaire_user)){
					$beneficiaire_user = $beneficiaire_user[0];
					$beneficiaire_user_id = $beneficiaire_user->id;
				
					$jockerquestion->beneficiaire_user_id = Auth::user()->id;
					
					$user = User::find($beneficiaire_user_id);
					$user->jocker_question = $user->jocker_question + $request->quantite;
					$user->exists = true;
					$user->save();
					
					$user = User::find(Auth::user()->id);
					$user->money = $user->money - $this->frais_jocker_question * $request->quantite;
					$user->exists = true;
					$user->save();
					
				}else{
					return back()->with('warning','Veuillez entrer un pseudo valide');
				}
			}
			
			$jockerquestion->jockerquestion_quantite = $request->quantite;
			$jockerquestion->jockerquestion_montant = $this->frais_jocker_question * $request->quantite;
			$jockerquestion->jockerquestion_date = date('Y-m-d H:i:s');
			$jockerquestion->save();
			
			return back()->with('message','Opération effectuée avec succès');

		}else{

			return back()->with('warning',"FONDS INSUFFISANT, VEUILLEZ FAIRE UN DEPOT AVANT D'ACHETER DES JOCKERS");
			
		}
		
    }
	
	
	
	
}
