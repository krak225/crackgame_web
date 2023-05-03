<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//ROUTE POUR VERSION MOBILE
Route::post('login_ws','Auth\LoginController@login_ws');
Route::get('login_ws','Auth\LoginController@login_ws');

Route::post('logout_ws','Auth\LoginController@logout_ws');
// Route::get('logout_ws','Auth\LoginController@logout_ws');

Route::post('register_ws','Auth\RegisterController@register_ws');
Route::get('register_ws','Auth\RegisterController@register_ws');

Route::get('/userinfos','MobileController@userinfos')->name('userinfos');
Route::post('/updateuserinfos','MobileController@updateuserinfos')->name('updateuserinfos');
Route::get('/updateuserinfos','MobileController@updateuserinfos')->name('updateuserinfos');

Route::get('/avatars','MobileController@avatars')->name('avatars');
Route::post('/updateavatar','MobileController@UpdateAvatar')->name('UpdateAvatar');

Route::get('/dataforofflineuse','MobileController@dataforofflineuse')->name('dataforofflineuse');

Route::get('/categories','MobileController@categories')->name('categories');

Route::get('/questions_tc','MobileController@questions_tc')->name('questions_tc');

Route::get('/duelquestions','MobileController@duelquestions')->name('duelquestions');

Route::get('/chapquestions','MobileController@chapquestions')->name('chapquestions');

Route::get('/mesquestions','MobileController@mesquestions')->name('mesquestions');

Route::post('/sendselectedquestions','MobileController@sendselectedquestions')->name('sendselectedquestions');
Route::get('/sendselectedquestions','MobileController@sendselectedquestions')->name('sendselectedquestions');

Route::get('/submitquestion','MobileController@submitquestion')->name('submitquestion');
Route::post('/submitquestion','MobileController@submitquestion')->name('submitquestion');

Route::get('/modifierquestion','MobileController@modifierquestion')->name('modifierquestion');
Route::post('/modifierquestion','MobileController@modifierquestion')->name('modifierquestion');

Route::post('/savescore','MobileController@savescore_tc')->name('savescore_tc');
Route::get('/savescore','MobileController@savescore_tc')->name('savescore_tc');
Route::post('/updatecoretc','MobileController@updatecore_tc')->name('updatecore_tc');
Route::get('/updatecoretc','MobileController@updatecore_tc')->name('updatecore_tc');
Route::post('/saveofflinetc','MobileController@saveofflinetc')->name('saveofflinetc');
Route::get('/saveofflinetc','MobileController@saveofflinetc')->name('saveofflinetc');

Route::post('/souscrireduel','MobileController@souscrireduel')->name('souscrireduel');
//Route::get('/souscrireduel','MobileController@souscrireduel')->name('souscrireduel');

Route::post('/achetersouscription','MobileController@achetersouscription')->name('achetersouscription');
//Route::get('/achetersouscription','MobileController@achetersouscription')->name('achetersouscription');

Route::post('/faireundepot','MobileController@faireundepot')->name('faireundepot');
//Route::get('/faireundepot','MobileController@faireundepot')->name('faireundepot');

Route::post('/faireunretrait','MobileController@faireunretrait')->name('faireunretrait');
Route::get('/faireunretrait','MobileController@faireunretrait')->name('faireunretrait');

Route::get('/duelistes','MobileController@duelistes')->name('duelistes');

Route::get('/classements','MobileController@classements')->name('classements');

Route::get('/transactions','MobileController@transactions')->name('transactions');

Route::get('/chapencours','MobileController@chapencours')->name('chapencours');

Route::post('/payerabonnementchap','MobileController@payerabonnementchap')->name('payerabonnementchap');
Route::get('/payerabonnementchap','MobileController@payerabonnementchap')->name('payerabonnementchap');

Route::post('/souscrirequiz','MobileController@souscrirequiz')->name('souscrirequiz');
Route::get('/souscrirequiz','MobileController@souscrirequiz')->name('souscrirequiz');
Route::get('/endquiz','MobileController@endquiz')->name('endquiz');
Route::get('/defis','MobileController@defis')->name('defis');

//added on 26012022
Route::get('/alltest','MobileController@alltest')->name('alltest');
Route::get('/allquiz','MobileController@allquiz')->name('allquiz');
Route::get('/quiz_gagnes','MobileController@quiz_gagnes')->name('quiz_gagnes');
Route::get('/quiz_perdus','MobileController@quiz_perdus')->name('quiz_perdus');
Route::get('/classements_alltest','MobileController@classements_alltest')->name('classements_alltest');


Route::get('/conversations','ChatController@conversations')->name('conversations');
Route::get('/chat_users','ChatController@chat_users')->name('chat_users');

//Route::post('login_ws','Auth\LoginController@login_ws');
//Route::get('login_ws','Auth\LoginController@login_ws');
Route::group(['middleware' => 'auth:api'], function(){
	
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


