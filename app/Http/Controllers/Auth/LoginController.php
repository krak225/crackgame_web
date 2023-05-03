<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Hash;
use Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
        $this->middleware('guest')->except('logout');
		
		// $this->testLogin();
		
    }
	
	
	public function register(){
		
	}


	public function testLogin()
	{
		 $user = new User;
		 $user->nom = 'Admin';
		 $user->prenoms = 'Web';
		 $user->email = 'admin@revision.ci';
		 $user->password = Hash::make('12345678');

		 // if ( ! ($user->save()))
		 // {
			 // dd('user is not being saved to database properly - this is the problem');          
		 // }

		 if ( ! (Hash::check('12345678', Hash::make('12345678'))))
		 {
			 dd('hashing of password is not working correctly - this is the problem');          
		 }

		 if ( ! (Auth::attempt(array('email' => 'admin@revision.ci', 'password' => '12345678'))))
		 {
			 dd('storage of user password is not working correctly - this is the problem');          
		 }

		 else
		 {
			 dd('everything is working when the correct data is supplied - so the problem is related to your forms and the data being passed to the function');
		 }
	}



    public function login_ws(Request $request)
    {

        $this->validateLogin($request);

		$listeUtilisateurs = array();

        if ($this->attemptLogin($request)) 
        {

            $user  = $this->guard()->user();
			$user->statut_connexion = "CONNECTE";	
			$user->exists = true;
            $user->save();

            $token = $user->generateToken();

			$listeUtilisateurs[] = 
            	array(
            		'utilisateurId' =>$user->id,
					'utilisateurToken' =>$user->api_token,
					'utilisateurLogin' =>$user->email,
					'utilisateurNom' =>$user->nom,
					'utilisateurPrenoms' =>$user->prenoms,
					'utilisateurPhoto' =>$user->photo,
					'utilisateurLangueCode' =>$user->lang_code,
					'utilisateurDevise' =>$user->devise,
					'utilisateurTotalPoint' =>$user->total_points,
					'utilisateurTotalPointTest' =>$user->total_points_test,
					'utilisateurTotalPointDuel' =>$user->total_points_duel,
					'utilisateurScoreGeneral' =>$user->score_general,
					'utilisateurJockerDuel' =>$user->jocker_duel,
					'utilisateurSouscription' =>$user->souscription,
					'utilisateurMoney' =>$user->money,
					'utilisateurStatutAbonnementDuel' =>$user->statut_abonnement,
					'utilisateurStatutAbonnementChap' =>$user->statut_abonnement_chap,

				);

			return json_encode(array('listeUtilisateurs'=>$listeUtilisateurs, '_token'=> $token, 'message' => 'Utilisateur authentifié !'));
        
        }

		$listeUtilisateurs[] = 
            	array(
            		'utilisateurId' =>"",
					'utilisateurLogin' =>"",
					'utilisateurNom' =>"",
					'utilisateurPrenoms' =>"",
					'utilisateurStatut' =>"",
				);

		
		return json_encode(array('listeUtilisateurs'=>$listeUtilisateurs,'message' => 'Login ou mot de passe erroné !'));
        
    }




    public function logout_ws(Request $request)
    {
        // $user = Auth::guard('api')->user();
        $user = User::find($request->session_id);
		
        if ($user) 
        {
			
            $user->api_token = null;
			$user->statut_connexion = "DECONNECTE";
            $user->save();

        }

        return json_encode(['data' => 'User logged out.'], 200);
		
    }


	
	
}
