<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Duel;
use App\Chap;
use App\Abonnement;
use App\AbonnementChap;
use Rap2hpoutre\FastExcel\FastExcel;
use File;
use Session;
use DB;
use Stdfn;

class HomeController extends Controller
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

	
    public function welcome()
    {
		
        return view('welcome');
		
    }
	
	
	
    public function index()
    {
		
		//Données statistiques
		$duelistes_connectes 		= Abonnement::getDuelistesAbonnes();
		
		$statistiques	 			= User::all();
		$abonnement_active			= Abonnement::whereRaw('type_jeu = "duel" and user_id = "'.Auth::user()->id.'" and DATE(abonnement_date) = "'.date('Y-m-d').'"')->get();
		$abonnement_active_chap		= Abonnement::whereRaw('type_jeu = "chap" and user_id = "'.Auth::user()->id.'" and DATE(abonnement_date) = "'.date('Y-m-d').'"')->get();
		
		$abonnement_active 			= count($abonnement_active);
		$abonnement_active_chap		= count($abonnement_active_chap);
		// dd($abonnement_active_chap);
		
		$nombre_duels = count(Duel::all());
		
		$chap_encours = Chap::where(['chap_statut'=>'EN COURS'])->first();
		$chap_encours_id = !empty($chap_encours)? $chap_encours->chap_id: null;
		//dd($chap_encours);

		$abonnement_chap_encours = AbonnementChap::whereRaw('chap_id = "'.$chap_encours_id.'" and user_id = "'.Auth::user()->id.'" and DATE(abonnement_chap_date) = "'.date('Y-m-d').'" AND abonnement_chap_statut="VALIDE" ')->first();

		$statut_abonnement_chap_encours = !empty($abonnement_chap_encours) ? 1 : 0;

        if(!empty($chap_encours)){
            $temps_restant = Stdfn::DateDiffInterval(date('Y-m-d H:i:s'), $chap_encours->chap_date_debut);

            $temps_restant = ($temps_restant < 0) ? 0 : $temps_restant;
        }else{
    	    $temps_restant = 0;
        }

        //dd($temps_restant);

		$params = ['temps_restant'=>$temps_restant,'abonnement_active'=>$abonnement_active,'abonnement_active_chap'=>$abonnement_active_chap,'duelistes_connectes'=>$duelistes_connectes,'nombre_duels'=>$nombre_duels,'chap_encours'=>$chap_encours,'statut_abonnement_chap_encours'=>$statut_abonnement_chap_encours];
		
		

        return view('home', $params);
		
		
    }
	
	
	public function RefreshDuelistesConnectes()
    {
		$duelistes_connectes 		= Abonnement::getDuelistesAbonnes();
		foreach($duelistes_connectes as $user){
			if($user->id != Auth::user()->id){
				echo '<tr> 
					<td>
						'.ucfirst($user->pseudo).'
					</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>
						<span class="btnSendInvitation btn" data-to_user_id="'.$user->id .'" > 
							<span>Inviter</span> 
						</span>
					</td>
				 </tr>';
				 
				 // onClick="SendInvitation('.$user->id .')"
				 
			}
		}
		 
	}
	
	
	
	public function setLanguage($lang)
    {
		
		session(['lang' => $lang]);
		
		$user = User::find(Auth::user()->id);
		$user->lang_code = $lang;
		$user->lang_libelle = ($lang == 'fr')? 'Français' : 'Anglais';
		$user->exists = true;
		$user->save();
		
		
        return back();
				
    }
	
	
	
	
	
    public function gagnants()
    {
		
		//sql jointure sur la table elle meme
		$sql = ' select 
		t1.duel_id as duel_id,
		t1.user_id as user1_id,
		t1.score as user1_score,
		t2.user_id as user2_id,
		t2.score as user2_score,
		case when (t1.score > t2.score) then t1.user_id
			else t2.user_id as vainqueur_id
		from duel_score t1 
		inner join duel_score t2 
		on t1.duel_id = t2.duel_id and t1.user_id <> t2.user_id 
		group by t1.duel_id,t1.user_id, t2.user_id ';
		
		// $users 	= DB::select($sql);
		
		
		$users = DB::select(' select * from duel 
		inner join users on users.id = duel.duel_vainqueur_id 
		inner join duel_score on duel_score.duel_id = duel.duel_id and duel_score.user_id = duel.duel_vainqueur_id ');
		
        return view('gagnants',['users'=>$users]);
		
    }
	
	
}
