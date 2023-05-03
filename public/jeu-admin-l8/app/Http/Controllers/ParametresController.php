<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Categorie;
use App\Models\Defi;
use App\Models\Recompense;
use App\Models\TypeClassement;
use Stdfn;
use DB;


class ParametresController extends Controller
{
  
    //
	public function __construct()
    {

        $this->middleware('auth');
		
    }
	
    public function categories()
    {
		
    	$categories = Categorie::get();

    	$categories = Categorie::get();
			

    	//dd($categories);								
        return view('question.categories',['categories'=>$categories]);
		
    }
	
	
    public function SaveCategorie(Request $request)
    {
		
		$courrier = new Categorie();
		$courrier->categorie_libelle   			= $request->libelle;
		$courrier->categorie_date_creation  	= gmdate('Y-m-d H:i:s');
		
		$courrier->save();
		
		return back()->with('message','OPÉRATION EFFECTUÉE AVEC SUCCÈS !');
		
	}
	

	
    public function SupprimerCategorie(Request $request)
    {
		
		$categorie_id = $request->categorie_id;

		$categorie = Categorie::find($categorie_id);

		if(!empty($categorie)){

			$categorie->categorie_date_suppression 	= gmdate('Y-m-d H:i:s');
			$categorie->categorie_statut 			= "SUPPRIME";
			$categorie->exists 						= true;
			$categorie->save();
			
			echo 1;
			
		}else{
			echo 0;
		}
	}
	


    public function defis()
    {
		
    	$defis = Defi::get();
							
        return view('parametres.defis',['defis'=>$defis]);
		
    }
	
	
    public function SaveDefi(Request $request)
    {
		
		$courrier = new Defi();
		$courrier->defi_montant   		= trim($request->montant);
		$courrier->defi_date  			= gmdate('Y-m-d');
		$courrier->defi_date_creation	= gmdate('Y-m-d H:i:s');
		
		$courrier->save();
		
		return back()->with('message','OPÉRATION EFFECTUÉE AVEC SUCCÈS !');
		
	}
	

	
    public function SupprimerDefi(Request $request)
    {
		
		$defi_id = $request->defi_id;

		$defi = Defi::find($defi_id);

		if(!empty($defi)){

			$defi->defi_date_suppression 	= gmdate('Y-m-d H:i:s');
			$defi->defi_statut 			= "SUPPRIME";
			$defi->exists 						= true;
			$defi->save();
			
			echo 1;
			
		}else{
			echo 0;
		}
	}
	
	


    public function recompenses()
    {
		
    	$types_classements = TypeClassement::get();
    	$recompenses = Recompense::join('type_classement','type_classement.type_classement_id','recompense.type_classement_id')->get();
							
        return view('parametres.recompenses',['recompenses'=>$recompenses, 'types_classements'=>$types_classements]);
		
    }
	
	
    public function SaveRecompense(Request $request)
    {
		
		$courrier = new Recompense();
		$courrier->type_classement_id   		= trim($request->type_classement_id);
		$courrier->recompense_rang   			= trim($request->rang);
		$courrier->recompense_montant   		= trim($request->montant);
		$courrier->recompense_date  			= trim($request->recompense_date);
		$courrier->recompense_date_creation		= gmdate('Y-m-d H:i:s');
		
		$courrier->save();
		
		return back()->with('message','OPÉRATION EFFECTUÉE AVEC SUCCÈS !');
		
	}
	

	
    public function SupprimerRecompense(Request $request)
    {
		
		$recompense_id = $request->recompense_id;

		$recompense = Recompense::find($recompense_id);

		if(!empty($recompense)){

			$recompense->recompense_date_suppression 	= gmdate('Y-m-d H:i:s');
			$recompense->recompense_statut 			= "SUPPRIME";
			$recompense->exists 						= true;
			$recompense->save();
			
			echo 1;
			
		}else{
			echo 0;
		}
	}
	
	

    public function quizjoues()
    {
		
		$sql='select * from entrainement inner join categorie using(categorie_id) inner join users on users.id = entrainement.user_id where 1 and type_jeu="quiz" ';
		
    	$quizjoues = (object) DB::select($sql);
							
        return view('parametres.quizjoues',['quizjoues'=>$quizjoues]);
		
    }
	
    public function testsjoues()
    {
		
		$sql='select * from entrainement inner join categorie using(categorie_id) inner join users on users.id = entrainement.user_id where 1 and type_jeu="test"';
		
    	$testsjoues = (object) DB::select($sql);
							
        return view('parametres.testsjoues',['testsjoues'=>$testsjoues]);
		
    }

}


