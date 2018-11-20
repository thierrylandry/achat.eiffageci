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

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/profiles',[
    'as'=>'profiles',
    'uses'=>'HomeController@profiles'

]);
Route::get('/fournisseurs',[
    'as'=>'fournisseurs',
    'uses'=>'FournisseurController@fournisseurs'

]);

Route::get('/Administration', [
    'as'=>'login',
    'uses'=>'HomeController@login'
]);
Route::get('/Administration', [
    'as'=>'login',
    'uses'=>'HomeController@login'
]);
Route::post('/Validfournisseur', [
    'as'=>'Validfournisseur',
    'uses'=>'FournisseurController@Validfournisseur'
]);

Route::get('/ajouter_fournisseur',[
    'as'=>'ajouter_fournisseur',
    'uses'=>'FournisseurController@ajouter_fournisseur'

]);
Route::get('/voir_fournisseur/{slug}',[
    'as'=>'voir_fournisseur',
    'uses'=>'FournisseurController@voir_fournisseur'

]);
Route::get('/supprimer_fournisseur/{slug}',[
    'as'=>'supprimer_fournisseur',
    'uses'=>'FournisseurController@supprimer_fournisseur'

]);
Route::post('/modifier_fournisseur}',[
    'as'=>'modifier_fournisseur',
    'uses'=>'FournisseurController@modifier_fournisseur'

]);





Route::get('/gestion_produit',[
    'as'=>'gestion_produit',
    'uses'=>'ProduitController@produits'

]);
Route::post('/Validproduits', [
    'as'=>'Validproduits',
    'uses'=>'ProduitController@Validproduits'
]);
Route::get('/voir_produit/{slug}',[
    'as'=>'voir_produit',
    'uses'=>'ProduitController@voir_produit'

]);
Route::get('/supprimer_produit/{slug}',[
    'as'=>'supprimer_produit',
    'uses'=>'ProduitController@supprimer_produit'

]);
Route::post('/modifier_produit}',[
    'as'=>'modifier_produit',
    'uses'=>'ProduitController@modifier_produit'

]);




Route::get('/gestion_utilisateur',[
    'as'=>'gestion_utilisateur',
    'uses'=>'UtilisateurController@utilisateurs'

]);
Route::post('/Validutilisateurs', [
    'as'=>'Validutilisateurs',
    'uses'=>'UtilisateurController@Validutilisateurs'
]);
Route::get('/voir_utilisateur/{slug}',[
    'as'=>'voir_utilisateur',
    'uses'=>'UtilisateurController@voir_utilisateur'

]);
Route::get('/supprimer_utilisateur/{slug}',[
    'as'=>'supprimer_utilisateur',
    'uses'=>'UtilisateurController@supprimer_utilisateur'

]);
Route::post('/modifier_utilisateur}',[
    'as'=>'modifier_utilisateur',
    'uses'=>'UtilisateurController@modifier_utilisateur'

]);




Route::get('/gestion_profil',[
    'as'=>'gestion_profil',
    'uses'=>'ProfilController@profils'

]);
Route::post('/Validprofils', [
    'as'=>'Validprofils',
    'uses'=>'ProfilController@Validprofils'
]);
Route::get('/voir_profil/{slug}',[
    'as'=>'voir_profil',
    'uses'=>'ProfilController@voir_profil'

]);
Route::get('/supprimer_profil/{slug}',[
    'as'=>'supprimer_profil',
    'uses'=>'ProfilController@supprimer_profil'

]);
Route::post('/modifier_profil}',[
    'as'=>'modifier_profil',
    'uses'=>'ProfilController@modifier_profil'

]);






Route::get('/gestion_da',[
    'as'=>'gestion_da',
    'uses'=>'DAController@das'

]);
Route::post('/Validdas', [
    'as'=>'Validdas',
    'uses'=>'DAController@Validdas'
]);
Route::get('/voir_da/{slug}',[
    'as'=>'voir_da',
    'uses'=>'DAController@voir_da'

]);
Route::get('/confirmer_da/{slug}',[
    'as'=>'confirmer_da',
    'uses'=>'DAController@confirmer_da'

]);
Route::get('/suspendre_da/{slug}',[
    'as'=>'suspendre_da',
    'uses'=>'DAController@suspendre_da'

]);
Route::get('/refuser_da/{slug}',[
    'as'=>'refuser_da',
    'uses'=>'DAController@refuser_da'

]);
Route::get('/supprimer_da/{slug}',[
    'as'=>'supprimer_da',
    'uses'=>'DAController@supprimer_da'

]);
Route::post('/modifier_da',[
    'as'=>'modifier_da',
    'uses'=>'DAController@modifier_da'

]);




Route::get('/gestion_prix',[
    'as'=>'gestion_prix',
    'uses'=>'PrixController@prixs'

]);
Route::post('/Validprixs', [
    'as'=>'Validprixs',
    'uses'=>'PrixController@Validprixs'
]);
Route::get('/voir_prix/{slug}',[
    'as'=>'voir_prix',
    'uses'=>'PrixController@voir_prix'

]);
Route::get('/supprimer_prix/{slug}',[
    'as'=>'supprimer_prix',
    'uses'=>'PrixController@supprimer_prix'

]);
Route::post('/modifier_prix',[
    'as'=>'modifier_prix',
    'uses'=>'PrixController@modifier_prix'

]);
Route::post('/lister_fournisseur',[
    'as'=>'lister_fournisseur',
    'uses'=>'PrixController@lister_fournisseur'

]);
Route::get('/supprimer_prix/{slug}',[
    'as'=>'supprimer_prix',
    'uses'=>'PrixController@supprimer_prix'

]);






Route::get('/gestion_demande_proformas',[
    'as'=>'gestion_demande_proformas',
    'uses'=>'Demande_proformaController@demande_proformas'

]);

Route::get('/les_das_funct/{domaine}',[
    'as'=>'les_das_funct',
    'uses'=>'Demande_proformaController@les_das_funct'

]);


Route::get('/les_das_fournisseurs_funct/{domaine}',[
    'as'=>'les_das_fournisseurs_funct',
    'uses'=>'Demande_proformaController@les_das_fournisseurs_funct'

]);

Route::post('/envoies', [
    'as'=>'envoies',
    'uses'=>'Demande_proformaController@envoies'
]);
Route::post('/mailling', [
    'as'=>'mailling',
    'uses'=>'Demande_proformaController@mailling'
]);
Route::post('/ajouter_reponse', [
    'as'=>'ajouter_reponse',
    'uses'=>'Demande_proformaController@ajouter_reponse'
]);
Route::post('/les_info_desde_la_da', [
    'as'=>'les_info_desde_la_da',
    'uses'=>'Demande_proformaController@les_info_desde_la_da'
]);
Route::get('/lister_les_reponse/{id_fournisseur}', [
    'as'=>'lister_les_reponse',
    'uses'=>'Demande_proformaController@lister_les_reponse'
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
