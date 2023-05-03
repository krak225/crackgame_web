<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\UserFormRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		// dd($data);
        return Validator::make($data, [
            //'nom' => 'required|string|max:255',
            //'prenoms' => 'required|string|max:255',
            // 'lang_code' => 'required|string|max:255',
            // 'telephone' => 'required|string|max:255|unique:users',
            //'email' => 'required|string|max:255|unique:users',
            'pseudo' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
		
		// dd($data['devise']);
		
		//
        return User::create([
            'profil_id' => 2,
            //'nom' => $data['nom'],
            //'prenoms' => $data['prenoms'],
            'telephone' => $data['telephone'],
            'email' => $data['pseudo'],
            'password' => bcrypt($data['password']),
            //'sexe' => $data['sexe'],
            //'date_naissance' => $data['date_naissance'],
            //'pays_origine_id' => $data['pays_origine_id'],
            //'pays_residence_id' => $data['pays_residence_id'],
            //'ville' => $data['ville'],
            //'adresse' => $data['adresse'],
            //'code_postal' => $data['code_postal'],
            'pseudo' => $data['pseudo'],
            'lang_code' => isset($data['lang_code']) ? $data['lang_code'] : 'fr',
            'lang_libelle' => isset($data['lang_code']) ? ($data['lang_code'] == 'en')? 'Anglais' : 'Français' : 'Français',
            'devise' => isset($data['devise']) ? $data['devise'] : 'XOF',
            //'adresse_email' => $data['email'],
            'login' => $data['pseudo'],
            //'parrain' => $data['parrain'],
        ]);
		
		
    }


    function register_ws(UserFormRequest $request){

        $pseudo = $request->pseudo;
        $password = $request->password;
        $telephone = $request->telephone;
        $parrain = $request->parrain;

        //dd($request);
        $info_parrain = User::where(['pseudo'=>$parrain])->first();
        $parrain_id = ($info_parrain)? $info_parrain->id : 0;
        
        $user = new User();
        $user->profil_id = 2;
        $user->user_id_parrain = $parrain_id;
        $user->parrain = $parrain;
        $user->pseudo = $pseudo;
        $user->telephone = $telephone;
        $user->email = $pseudo;
        $user->password = bcrypt($password);
        $user->devise = 'XOF';
        $user->lang_code = 'fr';
        $user->lang_libelle = ($user->lang_code == 'en')? 'Anglais' : 'Français';
        $user->save();

        
        $listeOperationResult[] = 
                array(
                    'operationStatut' =>1,
                    'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
                );
    
        return ['listeOperationResult'=>$listeOperationResult];
        
        //echo json_encode(array('listeOperationResult'=>$listeOperationResult));

    }


}
