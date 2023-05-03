<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/','HomeController@welcome')->name('welcome');
Route::get('/home','HomeController@index')->name('home');

Route::get('/lang/{lang}','HomeController@setLanguage')->name('setlanguage');


Route::get('/refreshduelistesconnectes','HomeController@RefreshDuelistesConnectes')->name('RefreshDuelistesConnectes');


Route::get('/statistiques','AdminController@statistiques')->name('statistiques')->middleware('admin');
Route::get('/utilisateurs','AdminController@utilisateurs')->name('utilisateurs')->middleware('admin');
Route::get('/utilisateur','AdminController@utilisateur')->name('utilisateur')->middleware('admin');
Route::post('/utilisateur','AdminController@SaveUtilisateur')->name('SaveUtilisateur')->middleware('admin');

Route::get('/utilisateur/{id}','AdminController@DetailsUtilisateur')->name('DetailsUtilisateur')->middleware('admin');
Route::get('/utilisateur/{id}/modifier','AdminController@modifier_utilisateur')->name('modifier_utilisateur')->middleware('admin');
Route::post('/utilisateur/{id}/modifier','AdminController@ModifierUtilisateur')->name('ModifierUtilisateur')->middleware('admin');


Route::get('/profile','UserController@profile')->name('profile');
Route::get('/password/update','UserController@update_password')->name('updatePassword');
Route::post('/password/update','UserController@UpdatePassword');
Route::get('/profile/update_photo','UserController@update_photo')->name('update_photo');
Route::post('/profile/update_photo','UserController@UpdatePhoto')->name('UpdatePhoto');
Route::get('/profile/update_perso','UserController@update_perso')->name('update_perso');
Route::post('/profile/update_perso','UserController@UpdatePerso')->name('UpdatePerso');
Route::get('/profile/update_compte','UserController@update_compte')->name('update_compte');
Route::post('/profile/update_compte','UserController@UpdateCompte')->name('UpdateCompte');


//CRACKGAME

Route::get('/categorie_test','GameController@categorie_test')->name('categorie_test');
Route::get('/test/{categorie_id}','GameController@entrainement')->name('entrainement');
Route::post('/savetest','GameController@SaveTestConnaissance')->name('savetest');


Route::get('/duels/{option?}','GameController@duels')->name('duels');
Route::get('/duel/creer/{adversaire_id}','GameController@CreerDuel')->name('CreerDuel');
Route::get('/duel/rejoindre/{duel_id}','GameController@RejoindreDuel')->name('RejoindreDuel');
Route::get('/duel/jouer/{duel_id}/{adversaire_id?}','GameController@JouerDuel')->name('JouerDuel');
Route::get('/question/{categorie_id}','GameController@NextRandom')->name('NextRandom');
Route::post('/repondre','GameController@SendReponse')->name('SendReponse');
Route::get('/score','GameController@ShowScore')->name('ShowScore');

Route::get('/conversion_point','ConversionController@conversion_point')->name('ConversionPoint');
Route::post('/conversion_point','ConversionController@ConversionPoint')->name('ConversionPoint');
Route::get('/conversion_devise','ConversionController@conversion_devise')->name('ConversionDevise');
Route::post('/conversion_devise','ConversionController@ConversionDevise')->name('ConversionDevise');
Route::post('/auto_conversion','ConversionController@AutoConversion')->name('AutoConversion');


Route::get('/addquestion','ParametresController@addquestion')->name('addquestion');
Route::post('/savequestion','ParametresController@SaveQuestion')->name('SaveQuestion');
Route::post('/updatequestion','ParametresController@UpdateQuestion')->name('UpdateQuestion');
Route::get('/questions/{selectionner?}','ParametresController@questions')->name('questions');
Route::post('/save_selection_question','ParametresController@save_selection_question')->name('save_selection_question');
Route::post('/save_selection_question_chap','ParametresController@save_selection_question_chap')->name('save_selection_question_chap');
Route::get('/modifier_question/{id}','ParametresController@modifier_question')->name('modifier_question');
Route::get('/supprimer_question/{id}','ParametresController@supprimer_question')->name('supprimer_question');
Route::get('/valider_question/{id}','ParametresController@valider_question')->name('valider_question');


Route::get('/depots','OperationsController@depots')->name('depots');
Route::get('/depot','OperationsController@depot')->name('depot');
Route::post('/depot','OperationsController@SaveDepot')->name('SaveDepot');
Route::get('/retraits','OperationsController@retraits')->name('retraits');
Route::get('/retrait','OperationsController@retrait')->name('retrait');
Route::post('/retrait','OperationsController@SaveRetrait')->name('SaveRetrait');
Route::get('/souscriptions','OperationsController@souscriptions')->name('souscriptions');
Route::get('/souscription','OperationsController@souscription')->name('souscription');
Route::post('/souscription','OperationsController@SaveSouscription')->name('SaveSouscription');
Route::get('/montant_souscription/{quantite}','OperationsController@montant_souscription');
Route::get('/montant_jocker/{quantite}','OperationsController@montant_jocker');

Route::get('/jockers','OperationsController@jockers')->name('jockers');
Route::get('/jocker_question','OperationsController@jocker_question')->name('jocker_question');
Route::post('/jocker_question','OperationsController@SaveJockerQuestion')->name('SaveJockerQuestion');
Route::get('/gagnants','HomeController@gagnants')->name('gagnants');
Route::get('/records','GameController@records')->name('records');
Route::get('/aide','GameController@aide')->name('aide');
Route::get('/comment_jouer','GameController@comment_jouer')->name('comment_jouer');
Route::get('/invites','UserController@invites')->name('invites');
Route::get('/bonus','UserController@bonus')->name('bonus');


Route::get('/duelistes','UserController@duelistes')->name('duelistes');
Route::get('/sabonner','UserController@sabonner')->name('sabonner');
Route::get('/sedesabonner','UserController@sedesabonner')->name('sedesabonner');

Route::get('/sabonner_chap','UserController@sabonner_chap')->name('sabonner_chap');

Route::get('/classements','GameController@classements')->name('classements');

Route::get('/transactions','MobileController@transactions')->name('transactions');

Route::get('/chaps','GameController@chaps')->name('chaps');
Route::get('/chap/{chap_id}','GameController@chap')->name('Jouerchap');
Route::get('/chapencours','GameController@chapencours')->name('chapencours');
Route::get('/resultatschap/{chap_id}','GameController@resultatschap')->name('ResultatsChap');


Route::get('/quizs','GameController@quizs')->name('quizs');
Route::get('/souscrirequiz','GameController@souscrirequiz')->name('souscrirequiz');
Route::post('/souscrirequiz','GameController@SaveSouscriptionQuiz')->name('SaveSouscriptionQuiz');
Route::get('/quiz/{categorie_id}/{objectif_financier}','GameController@quiz')->name('quiz');

Route::get('/defis','GameController@defis')->name('defis');

Route::get('/chat_users','ChatController@chat_users')->name('chat_users');





/**/
//ROUTE POUR VERSION MOBILE
Route::post('login_ws','Auth\LoginController@login_ws');
Route::get('login_ws','Auth\LoginController@login_ws');

Route::post('logout_ws','Auth\LoginController@logout_ws');
// Route::get('logout_ws','Auth\LoginController@logout_ws');

//Route::post('register_ws','Auth\RegisterController@register_ws');
Route::get('register_ws','Auth\RegisterController@register_ws');




