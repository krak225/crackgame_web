<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ParametresController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\SecurityController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/',[HomeController::class, 'index'])->name('accueil');
Route::get('/home',[HomeController::class, 'index'])->name('home');


Route::get('/profile',[UserController::class, 'profile'])->name('profile');
Route::get('/password/update',[UserController::class, 'update_password'])->name('updatePassword');
Route::post('/password/update',[UserController::class, 'UpdatePassword']);
Route::get('/profile/update_photo',[UserController::class, 'update_photo'])->name('update_photo');
Route::post('/profile/update_photo',[UserController::class, 'UpdatePhoto'])->name('UpdatePhoto');
Route::post('/profile/uploadImage',[UserController::class, 'uploadImage'])->name('uploadImage');
Route::post('/profile/upload_image',[UserController::class, 'upload_image'])->name('upload_image');


Route::get('categories',[ParametresController::class, 'categories'])->name('categories');
Route::post('categories',[ParametresController::class, 'SaveCategorie'])->name('SaveCategorie');
Route::post('supprimer_categorie',[ParametresController::class, 'SupprimerCategorie'])->name('SupprimerCategorie');


Route::get('questions',[QuestionsController::class, 'questions'])->name('questions');
Route::get('questionstest',[QuestionsController::class, 'questionstest'])->name('questionstest');
Route::get('questionsquiz',[QuestionsController::class, 'questionsquiz'])->name('questionsquiz');
Route::get('addquestionquiz',[QuestionsController::class, 'addquestionquiz'])->name('addquestionquiz');
Route::get('addquestiontest',[QuestionsController::class, 'addquestiontest'])->name('addquestiontest');
Route::post('question',[QuestionsController::class, 'SaveQuestion'])->name('SaveQuestion');
Route::get('question/{question_id}',[QuestionsController::class, 'DetailsQuestion'])->name('DetailsQuestion');
Route::get('modifier_question/{question_id}',[QuestionsController::class, 'modifier_question'])->name('modifier_question');
Route::post('modifier_question/{question_id}',[QuestionsController::class, 'SaveModificationQuestion'])->name('SaveModificationQuestion');


Route::get('defis',[ParametresController::class, 'defis'])->name('defis');
Route::post('defis',[ParametresController::class, 'SaveDefi'])->name('SaveDefi');
Route::post('supprimer_defi',[ParametresController::class, 'SupprimerDefi'])->name('SupprimerDefi');

Route::get('recompense',[ParametresController::class, 'recompenses'])->name('recompenses');
Route::post('recompense',[ParametresController::class, 'SaveRecompense'])->name('SaveRecompense');
Route::post('supprimer_recompense',[ParametresController::class, 'SupprimerRecompense'])->name('SupprimerRecompense');

Route::get('quizjoues',[ParametresController::class, 'quizjoues'])->name('quizjoues');
Route::get('testsjoues',[ParametresController::class, 'testsjoues'])->name('testsjoues');


Route::get('administrateurs',[AdmController::class, 'administrateurs'])->name('administrateurs');

Route::get('utilisateurs',[AdmController::class, 'utilisateurs'])->name('utilisateurs');
Route::get('utilisateur/{id}',[AdmController::class, 'DetailsUtilisateur'])->name('DetailsUtilisateur');
Route::get('utilisateur/{id}/modifier',[AdmController::class, 'ModifierUtilisateur'])->name('ModifierUtilisateur');


Route::get('depots',[AdmController::class, 'depots'])->name('depots');
Route::get('retraits',[AdmController::class, 'retraits'])->name('retraits');
Route::get('souscriptions',[AdmController::class, 'souscriptions'])->name('souscriptions');

//sécurité
// Route::any('{catchall}', 'SecurityController::class, 'SaveRoutes'])->where('catchall', '.*');

require __DIR__.'/auth.php';
