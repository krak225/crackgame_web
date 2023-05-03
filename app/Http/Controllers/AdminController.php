<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Http\Requests\UpdatePasswordFormRequest;
use App\User;
use App\Circonscription;
use App\Electeur;
use Hash;


class AdminController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
		
    }
	
	
	
	public function utilisateurs(){
		
		$users 	= User::all()->sortBy('nom');
		// dd($users);
		return view('utilisateurs',['users'=>$users]);
		
	}
	
	public function DetailsUtilisateur($id){
		
		$user 	= User::find($id);
		
		return view('details_utilisateur',['user'=>$user]);
		
	}
	
	
	public function modifier_utilisateur($id){
		
		$user 	= User::find($id);
		
		$circonscriptions 	= Circonscription::all()->sortBy('circonscriptionLibelle');
		
		return view('modifier_utilisateur',['user'=>$user,'circonscriptions'=>$circonscriptions]);
		
	}
	
	public function ModifierUtilisateur(UpdateUserFormRequest $request, $id){
		
		$user 	= User::find($id);
		$user->nom = $request->nom;
		$user->prenoms = $request->prenoms;
		$user->telephone = $request->telephone;
		$user->circonscriptionID = $request->circonscription_id;
		$user->password = Hash::make($request->password);
		// $user->profil_id = 2;
		
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
	
	
	public function statistiques(){
		
		$statistiques	 			= Electeur::getStatistiques();
		
		return view('statistiques',['statistiques'=>$statistiques]);
		
	}
	
	
	public function utilisateur(){
		
		$circonscriptions 	= Circonscription::all()->sortBy('circonscriptionLibelle');
		
		return view('utilisateur',['circonscriptions'=>$circonscriptions]);
		
	}
	
	
	public function SaveUtilisateur(UserFormRequest $request){
		
		
		$user =  new User();
		
		$user->groupesaisieID 		= 1;
		$user->circonscriptionID 	= $request->circonscription_id;
		$user->nom 					= $request->nom;
		$user->prenoms 				= $request->prenoms;
		$user->telephone 			= $request->telephone;
		$user->profil_id 			= $request->profil_id;
		$user->email 				= $request->email;
		$user->password 			= Hash::make($request->password);
	
		$user->save();
	
		return \Redirect::route('utilisateur')
			->with('message', "LE COMPTE A ÉTÉ CRÉE AVEC SUCCÈS");

					
	}
	
	
	
	
}
