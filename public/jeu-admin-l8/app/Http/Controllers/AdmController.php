<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Http\Requests\UpdatePasswordFormRequest;
use App\Models\User;
use App\Models\Joueur;
use App\Models\Profil;
use App\Models\Souscription;
use App\Models\Depot;
use App\Models\Retrait;
use DB;
use Hash;


class AdmController extends Controller
{
  
    //
	public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	public function utilisateurs(){
		
		$users 	= Joueur::where(['statut'=>'VALIDE'])
					->get()
					->sortBy('nom');
		
		return view('utilisateurs',['users'=>$users]);
		
	}
	
	
	public function DetailsUtilisateur($id){
		
		$user 	= Joueur::find($id);
		
		return view('details_utilisateur',['user'=>$user]);
		
	}
	
	
	
	public function administrateur(){
		
		return view('administrateur',['profils'=>$profils]);
		
	}
	
	
	public function administrateurs(){
		
		$users 	= User::where(['statut'=>'VALIDE'])
					->get()
					->sortBy('nom');
		
		return view('administrateurs',['users'=>$users]);
		
	}
	
	public function SaveAdministrateur(UserFormRequest $request){
		
		
		$user =  new Joueur();
		
		$user->nom 					= $request->nom;
		$user->prenoms 				= $request->prenoms;
		$user->telephone 			= $request->telephone;
		$user->profil_id 			= 1;
		$user->email 				= $request->email;
		// $user->password 			= Hash::make($request->password);
		$user->password 			= $request->password;
	
		
		$user->save();
	
		return back()
			->with('message', "LE COMPTE A ÉTÉ CRÉE AVEC SUCCÈS");

					
	}
	
	
	public function modifier_administrateur($id){
		
		$user 	= User::find($id);
		
		$bureaux 	= Bureau::all()->sortBy('bureauLibelle');
		$equipes 	= Equipe::all()->sortBy('equipe_nom');
		$coordonnateurs 	= User::where('profil_id',3)->get()->sortBy('nom');
		$ddcs 				= User::where('profil_id',2)->get()->sortBy('nom');
		$profils 			= Profil::where('profilStatut','VALIDE')->get()->sortBy('profilLibelle');
		
		return view('modifier_utilisateur',['equipes'=>$equipes, 'user'=>$user, 'profils'=>$profils, 'bureaux'=>$bureaux,'coordonnateurs'=>$coordonnateurs, 'ddcs'=>$ddcs]);
		
	}
	
	
	public function ModifierAdministrateur(Request $request, $id){
		
		$user 	= User::find($id);
		// $user->nom = $request->nom;
		// $user->prenoms = $request->prenoms;
		$user->telephone = $request->telephone;
		// $user->password = Hash::make($request->password);
		
		$option_modifier_motdepasse = $request->option_modifier_motdepasse;
		
		if($option_modifier_motdepasse == 1 && !empty($request->password)){
		
			if($request->password == $request->password_confirmation){
				
				$user->password = Hash::make($request->password);
				
			}else{
				
				return back()
					->with('warning', "LES DEUX MOTS DE PASSE NE SONT PAS IDENTIQUES");

			}
		}
		
		$user->exists = true;
		$user->save();
		
		// dd($user);
		return back()
			->with('message', "LE COMPTE A ÉTÉ MODIFIÉ AVEC SUCCÈS");

			
	}
	
	
	
	public function souscriptions(){
		
		$souscriptions 	= Souscription::join('users as souscripteur','souscripteur.id','souscription.user_id')->join('users as beneficiaire','beneficiaire.id','souscription.beneficiaire_user_id')
					->get()
					->sortBy('nom');
		
		return view('operations.souscriptions',['souscriptions'=>$souscriptions]);
		
	}
	
	public function depots(){
		
		$depots 	= Depot::join('users','users.id','depot.user_id')
					->get()
					->sortBy('nom');
		
		return view('operations.depots',['depots'=>$depots]);
		
	}
	
	public function retraits(){
		
		$retraits 	= Retrait::join('users','users.id','retrait.user_id')
					->get()
					->sortBy('nom');
		
		return view('operations.retraits',['retraits'=>$retraits]);
		
	}
	
	
}


