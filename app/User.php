<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;

class User extends Authenticatable
{
	
	//
	protected $table = 'users';
	
	
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
		'prenoms',
		'telephone',
		'lang_code',
		'lang_libelle',
		'email',
		'password',
		'sexe',
		'date_naissance',
		'pays_origine_id',
		'pays_residence_id',
		'ville',
		'adresse',
		'code_postal',
		'pseudo',
		'adresse_email',
		'devise',
		'parrain',
		'api_token',
    ];
	
	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];
	
	
    public function generateToken()

    {

        $this->api_token = str_random(60);

        $this->save();



        return $this->api_token;

    }


	public static function getPoints($user_id){
		
		$data = current(DB::select('select sum(entrainement_score) as total_points from entrainement where user_id =  "' . $user_id . '" limit 0,1 '));
		
		return $data->total_points;
		
	}
	
	
	public static function hasAbonnementActive(){
		
		$abonnement = Abonnement::whereRaw(' date(abonnement_date) = "'.date('Y-m-d').'" and user_id="'.Auth::user()->id.'"')
						->get();
			
		if(count($abonnement) > 0){
			return true;
		}else{
			return false;
		}
		
	}

	public static function SeDeconnecter(){

		DB::table('users')->where(['id'=>Auth::user()->id])->update(['statut_connexion'=>'DECONNECTE']);

	}

	
}
