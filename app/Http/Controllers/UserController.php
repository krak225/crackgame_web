<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UpdatePasswordFormRequest;
use Stdfn;
use App\User;
use App\Pays;
use App\Chap;
use App\Abonnement;
use App\AbonnementChap;
use App\Avatar;
use Hash;


class UserController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');
		
    }
	
	public function index(){
		
		
	}
	
	public function sabonner(){
		
		if(Auth::user()->souscription > 0){
			
			//Activer une souscription
			$abonnement = new Abonnement();
			$abonnement->user_id = Auth::user()->id;
			$abonnement->type_jeu = 'DUEL';
			$abonnement->abonnement_date = date('Y-m-d H:i:s');
			$abonnement->save();
			
			
			$user = Auth::user();
			$user->statut_abonnement = 'ACTIVE';
			$user->souscription = $user->souscription - 1;
			$user->jocker_duel  = 3;
			$user->exists = true;
			$user->save();
			
			
			
			return back()
				->with('message', "SOUSCRIPTION JOURNALIÈRE ACTIVÉ AVEC SUCCÈS!");
			
		}else{
			
			return back()
				->with('warning', 'VOUS N\'AVEZ PAS DE SOUSCRIPTION. VEUILLEZ EN ACHETER AVANT DE SOUSCRIRE!');
		
		}
		
	}
	
	public function sedesabonner(){
		
	}
	
	
	public function sabonner_chap(){
		
		//vérifier si il y a un chap en cours
		$chapencours = Chap::whereRaw(' chap_statut="EN COURS" and  DATE (chap_date_debut)="'.date('Y-m-d').'"')->first();

		if(!empty($chapencours)){

			$chapencours_id = $chapencours->chap_id;

			$frais_abonnement_chap = Stdfn::getFraisAbonnementChap(Auth::user()->devise);
			//dd($frais_abonnement_chap);
			if(Auth::user()->money > $frais_abonnement_chap){
				
				
				//Activer une souscription
				$abonnement = new Abonnement();
				$abonnement->user_id = Auth::user()->id;
				$abonnement->type_jeu = 'CHAP';
				$abonnement->abonnement_date = date('Y-m-d H:i:s');
				$abonnement->save();

				//s'abonner au chap en cours
				$abonnement = new AbonnementChap();
				$abonnement->user_id = Auth::user()->id;
				$abonnement->chap_id = $chapencours_id;
				$abonnement->abonnement_chap_date = date('Y-m-d H:i:s');
				$abonnement->save();
				

				
				$user = Auth::user();
				$user->statut_abonnement = 'ACTIVE';
				$user->statut_abonnement_chap = 'ACTIVE';
				$user->money = $user->money - $frais_abonnement_chap;
				$user->exists = true;
				$user->save();
				
				
				return back()
					->with('message', "SOUSCRIPTION CHAP ACTIVÉ AVEC SUCCÈS!");
				
			}else{
				
				return back()
					->with('warning', 'VOUS SOLDE EST INSUFFISANT. VEUILLEZ FAIRE UN DÉPOT AVANT DE SOUSCRIRE!');
			
			}


		}else{
			
			return back()
				->with('warning', 'AUCUN CHAP EN COURS, VEUILLEZ PATIENTER SVP !');
		
		}
		
	}
	
	public function sedesabonner_chap(){
		
	}
	
	
	public function profile(){
		
		return view('profile',[
			'user'=>Auth::user()
		]);
		
	}
	
	//liste les duelistes connectés
	public function duelistes(){
		
		$users = Abonnement::getDuelistesAbonnes();
		
		return view('duelistes',['users'=>$users]);
		
	}
	
	
	public function invites(){
		
		$users = User::where('parrain',Auth::user()->pseudo)->get();
		
		return view('invites',['users'=>$users]);

	}
	
	public function bonus(){
		
		$bonus = array();
		
		return view('bonus',['bonus'=>$bonus]);

	}
	
	
	
	public function update_photo(){
		
		// $avatars = Avatar::all();
		$avatars = array();
		
		$avatarDir = "images/avatars";
		
		
		if (is_dir($avatarDir)) {
			
			// Si oui, on l'ouvre
			if ($dh = opendir($avatarDir)) {  
			
				// On liste les dossiers et fichiers de $avatarDir
				while (($file = readdir($dh)) !== false) {
					
					if(!is_dir($avatarDir.$file)){
						$avatars[]= $file;     
					}
				
				}
		 
				// On ferme $avatarDir
				closedir($dh);
				
			}
		 
		}
		
		// dd($avatars);
	  
		return view('update_photo',['avatars'=>$avatars]);

	}
	
	public function UpdatePhoto(Request $request){
		
		$photo = $request->photo;
		
		$user = User::find(Auth::user()->id);
		
		$user->photo = $photo;
		$user->exists = true;
		$user->save();
		
	
		return \Redirect::route('profile')
		// return back()
			->with('message', "VOTRE PHOTO A ÉTÉ MIS À JOUR");


	}
	
	public function update_perso(){
		
		$user = Auth::user();
		$pays_origine = Pays::all();
		$pays_residence = Pays::all();
		
		return view('update_perso',['user'=>$user,'pays_origine'=>$pays_origine,'pays_residence'=>$pays_residence]);

	}
	
	public function UpdatePerso(Request $request){
		
		$user = User::find(Auth::user()->id);
		
		
		$user->nom	= $request->nom;
		$user->prenoms = $request->prenoms;
		$user->date_naissance = $request->date_naissance;
		$user->sexe = $request->sexe;
		$user->pays_origine_id = $request->pays_origine_id;
		$user->pays_residence_id = $request->pays_residence_id;
		$user->ville = $request->ville;
		$user->adresse = $request->adresse;
		$user->code_postal = $request->code_postal;
		
		// $user->lang_code = $request->lang_code;
		// $user->lang_libelle = ($request->lang_code == 'en')? Anglais : Français,
		// $user->devise = $request->devise;
		// $user->adresse_email = $request->adresse_email;
		// $user->parrain = $request->parrain;
		// $user->telephone = $request->telephone;
		
		
		$user->exists = true;
		$user->save();
		
	
		return \Redirect::route('profile')
			->with('message', "VOS INFORMATIONS PERSONNELLES ONT ÉTÉ MIS À JOUR");


	}
	public function update_compte(){
		
		$user = Auth::user();
		return view('update_compte',['user'=>$user]);

	}
	
	public function UpdateCompte(Request $request){
		
		$user = User::find(Auth::user()->id);
		
		$user->lang_code = $request->lang_code;
		$user->lang_libelle = ($request->lang_code == 'en')? 'Anglais' : 'Français';
		$user->devise = $request->devise;
		$user->adresse_email = $request->adresse_email;
		$user->parrain = $request->parrain;
		$user->communaute = $request->communaute;
		// dd($request->parrain);
		
		$user->exists = true;
		$user->save();
		
	
		return \Redirect::route('profile')
			->with('message', "VOS INFORMATIONS DU COMPTE ONT ÉTÉ MIS À JOUR");


	}
	
	
	
	
	
	public function update_password(){
		
		return view('auth/passwords/update');

	}
	
	
	
	
	public function UpdatePassword(UpdatePasswordFormRequest $request){
		
		// $this->validate(request(), [
			// 'current_password' => 'required|current_password',
			// 'new_password' => 'required|string|min:6|confirmed',
		// ]);
		
        $user  = Auth::user();
		
		// die(Hash::make('1'));
		
		// die( Hash::make($request->new_password).':::::::::'. Auth::user()->password);
		
		// if(Hash::make($request->new_password) == Auth::user()->password){
		if (Hash::check($request->new_password, Auth::user()->password)){	
			$user->password = Hash::make($request->new_password);
		
			$user->save();
		
			return \Redirect::route('updatePassword')
				->with('message', "VOTRE MOT DE PASSE A ÉTÉ MIS À JOUR");

		}else{
			
			return \Redirect::route('updatePassword')
				->with('authFailed', "MOT DE PASSE ACTUEL INCORRECTE");

		}
					
	}
	
	
	
	
	
}
