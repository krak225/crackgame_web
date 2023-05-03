<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Message;
use File;
use Session;
use Stdfn;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
		
    }

    public function chat_users(Request $request){
		
		$session_id = $request->session_id;
		
		$users = User::whereRaw('id <> "'.$session_id.'"')->orderBy('email')->get();
		
		$listeUtilisateurs = array();

		foreach($users as $user){
			
			$listeUtilisateurs[] = 
            	array(
            		'utilisateurId' =>$user->id,
					'utilisateurToken' =>$user->api_token,
					'utilisateurLogin' =>ucfirst($user->email),
					'utilisateurNom' =>$user->nom,
					'utilisateurPrenoms' =>$user->prenoms,
					'utilisateurPhoto' =>"http://cracgame.com/public/images/avatars/".$user->photo,
					'utilisateurLangueCode' =>$user->lang_code,
					'utilisateurDevise' =>$user->devise,
					'utilisateurTotalPoint' =>$user->total_points,
					'utilisateurTotalPointTest' =>$user->total_points_test,
					'utilisateurTotalPointDuel' =>'Total points aux duels: '.$user->total_points_duel,
					'utilisateurScoreGeneral' =>$user->score_general,
					'utilisateurJockerDuel' =>$user->jocker_duel,
					'utilisateurSouscription' =>$user->souscription,
					'utilisateurMoney' =>$user->money,
					'utilisateurStatutAbonnement' =>$user->statut_abonnement,

				);

		}
		
		
		echo json_encode(array('listeUtilisateurs'=>$listeUtilisateurs));

	}


	
    public function conversations(Request $request)
    {
		
		$session_id = $request->session_id;
		$mon_interlocuteur_id = $request->mon_interlocuteur_id;

		$messages	=	Message::whereRaw('( from_user_id="'.$session_id.'" &&  to_user_id="'.$mon_interlocuteur_id.'" ) || ( from_user_id="'.$mon_interlocuteur_id.'" &&  to_user_id="'.$session_id.'" ) ')->get();
		
		$listeTextos = array();
		$tabdate=array();
		foreach($messages as $message){
			
			if(!in_array(Stdfn::dateFromDB($message->message_date),$tabdate)){
				
				$tabdate[] = Stdfn::dateFromDB($message->message_date);
				$listeTextos[] = 
					array(
						'from' =>0,
						'to' =>0,
						'message' =>(Stdfn::dateFromDB($message->message_date)==date('d/m/Y'))? "Aujourd'hui" : Stdfn::dateFromDB($message->message_date)
					);
					
			}	 	 
			
			$listeTextos[] = 
					array(
						'from' =>$message->from_user_id,
						'to' =>$message->to_user_id,
						'message' =>stripslashes($message->message_message),
						'type' =>$message->type,
						'date' =>" ".substr($message->message_date,11,5)." ",
					);

		}
		
		$listeOperationResult[] = 
				array(
					'operationStatut' =>1,
					'operationMessage' =>"MESSAGES AFFICHES AVEC SUCCES",
				);

		
		echo json_encode(array('listeOperationResult'=>$listeOperationResult,'listeTextos'=>$listeTextos));
		
    }
	
	 
	
}
