<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Question;
use App\Models\Categorie;
use App\Models\Niveau;
use Stdfn;
use DB;


class QuestionsController extends Controller
{
  
    //
	public function __construct()
    {

        $this->middleware('auth');
		
    }
	

    public function quiz()
    {
		
    	$questions = Question::join('niveau','niveau.niveau_id','question.niveau_id')
						->LeftJoin('categorie','categorie.categorie_id','question.categorie_id')
						->whereRaw('type_jeu_id="2" AND question.categorie_id <> 11 ')
						->get();
				
        return view('question.questions',['questions'=>$questions]);
		
    }
	
	
}


