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

])->middleware('auth');
Route::get('/fournisseurs',[
    'as'=>'fournisseurs',
    'uses'=>'FournisseurController@fournisseurs',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');

Route::get('/Administration', [
    'as'=>'login',
    'uses'=>'HomeController@login',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');
Route::get('/Administration', [
    'as'=>'login',
    'uses'=>'HomeController@login',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');

Route::post('/Validfournisseur', [
    'as'=>'Validfournisseur',
    'uses'=>'FournisseurController@Validfournisseur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');

Route::get('/ajouter_fournisseur',[
    'as'=>'ajouter_fournisseur',
    'uses'=>'FournisseurController@ajouter_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');


Route::get('/lister_fournisseurs',[
    'as'=>'lister_fournisseurs',
    'uses'=>'FournisseurController@fournisseurs',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');


Route::get('/modifier_fournisseur/{slug}',[
    'as'=>'modifier_fournisseur',
    'uses'=>'FournisseurController@modifier_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::post('/update_fournisseur',[
    'as'=>'update_fournisseur',
    'uses'=>'FournisseurController@update_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');

Route::get('/supprimer_fournisseur/{slug}',[
    'as'=>'supprimer_fournisseur',
    'uses'=>'FournisseurController@supprimer_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');





Route::get('/gestion_produit',[
    'as'=>'gestion_produit',
    'uses'=>'ProduitController@produits',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::post('/Validproduits', [
    'as'=>'Validproduits',
    'uses'=>'ProduitController@Validproduits',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');
Route::get('/voir_produit/{slug}',[
    'as'=>'voir_produit',
    'uses'=>'ProduitController@voir_produit',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::get('/supprimer_produit/{slug}',[
    'as'=>'supprimer_produit',
    'uses'=>'ProduitController@supprimer_produit',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::post('/modifier_produit}',[
    'as'=>'modifier_produit',
    'uses'=>'ProduitController@modifier_produit',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');




Route::get('/gestion_utilisateur',[
    'as'=>'gestion_utilisateur',
    'uses'=>'UtilisateurController@utilisateurs',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::post('/Validutilisateurs', [
    'as'=>'Validutilisateurs',
    'uses'=>'UtilisateurController@Validutilisateurs',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');
Route::get('/voir_utilisateur/{slug}',[
    'as'=>'voir_utilisateur',
    'uses'=>'UtilisateurController@voir_utilisateur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::get('/supprimer_utilisateur/{slug}',[
    'as'=>'supprimer_utilisateur',
    'uses'=>'UtilisateurController@supprimer_utilisateur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::post('/modifier_utilisateur}',[
    'as'=>'modifier_utilisateur',
    'uses'=>'UtilisateurController@modifier_utilisateur'

])->middleware('auth');




Route::get('/gestion_profil',[
    'as'=>'gestion_profil',
    'uses'=>'ProfilController@profils',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::post('/Validprofils', [
    'as'=>'Validprofils',
    'uses'=>'ProfilController@Validprofils',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');
Route::get('/voir_profil/{slug}',[
    'as'=>'voir_profil',
    'uses'=>'ProfilController@voir_profil',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::get('/supprimer_profil/{slug}',[
    'as'=>'supprimer_profil',
    'uses'=>'ProfilController@supprimer_profil',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::post('/modifier_profil}',[
    'as'=>'modifier_profil',
    'uses'=>'ProfilController@modifier_profil',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');






Route::get('/gestion_da',[
    'as'=>'gestion_da',
    'uses'=>'DAController@das',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');
Route::get('/creer_da',[
    'as'=>'creer_da',
    'uses'=>'DAController@creer_da',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');

Route::get('/lister_da',[
    'as'=>'lister_da',
    'uses'=>'DAController@das',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');

Route::post('/Validdas', [
    'as'=>'Validdas',
    'uses'=>'DAController@Validdas',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']
])->middleware('auth');
Route::get('/voir_da/{slug}',[
    'as'=>'voir_da',
    'uses'=>'DAController@voir_da',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');
Route::get('afficher_image/{id}',[
    'as'=>'afficher_image',
    'uses'=>'DAController@afficher_image',


])->middleware('auth');


Route::get('/confirmer_da/{slug}',[
    'as'=>'confirmer_da',
    'uses'=>'DAController@confirmer_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');
Route::get('/suspendre_da/{slug}',[
    'as'=>'suspendre_da',
    'uses'=>'DAController@suspendre_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');
Route::post('/refuser_da',[
    'as'=>'refuser_da',
    'uses'=>'DAController@refuser_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');
Route::get('/supprimer_da/{slug}',[
    'as'=>'supprimer_da',
    'uses'=>'DAController@supprimer_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA','Gestionnaire_DA']

])->middleware('auth');
Route::post('/modifier_da',[
    'as'=>'modifier_da',
    'uses'=>'DAController@modifier_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA','Gestionnaire_DA']

])->middleware('auth');




Route::get('/gestion_prix',[
    'as'=>'gestion_prix',
    'uses'=>'PrixController@prixs'

])->middleware('auth');
Route::post('/Validprixs', [
    'as'=>'Validprixs',
    'uses'=>'PrixController@Validprixs'
])->middleware('auth');
Route::get('/voir_prix/{slug}',[
    'as'=>'voir_prix',
    'uses'=>'PrixController@voir_prix'

])->middleware('auth');
Route::get('/supprimer_prix/{slug}',[
    'as'=>'supprimer_prix',
    'uses'=>'PrixController@supprimer_prix'

])->middleware('auth');
Route::post('/modifier_prix',[
    'as'=>'modifier_prix',
    'uses'=>'PrixController@modifier_prix'

])->middleware('auth');
Route::post('/lister_fournisseur',[
    'as'=>'lister_fournisseur',
    'uses'=>'PrixController@lister_fournisseur'

])->middleware('auth');
Route::get('/supprimer_prix/{slug}',[
    'as'=>'supprimer_prix',
    'uses'=>'PrixController@supprimer_prix'

])->middleware('auth');






Route::get('/gestion_demande_proformas',[
    'as'=>'gestion_demande_proformas',
    'uses'=>'Demande_proformaController@demande_proformas',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');

Route::get('/les_das_funct/{domaine}',[
    'as'=>'les_das_funct',
    'uses'=>'Demande_proformaController@les_das_funct'

])->middleware('auth');


Route::get('/les_das_fournisseurs_funct/{domaine}',[
    'as'=>'les_das_fournisseurs_funct',
    'uses'=>'Demande_proformaController@les_das_fournisseurs_funct'

])->middleware('auth');

Route::post('/envoies', [
    'as'=>'envoies',
    'uses'=>'Demande_proformaController@envoies',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');
Route::post('/mailling', [
    'as'=>'mailling',
    'uses'=>'Demande_proformaController@mailling'
])->middleware('auth');




Route::post('/ajouter_reponse', [
    'as'=>'ajouter_reponse',
    'uses'=>'Demande_proformaController@ajouter_reponse',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');
Route::post('/les_info_desde_la_da', [
    'as'=>'les_info_desde_la_da',
    'uses'=>'Demande_proformaController@les_info_desde_la_da',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');
Route::get('/lister_les_reponse/{id_fournisseur}', [
    'as'=>'lister_les_reponse',
    'uses'=>'Demande_proformaController@lister_les_reponse',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');
Route::get('/modifier_reponse_fournisseur/{slug}', [
    'as'=>'modifier_reponse_fournisseur',
    'uses'=>'Demande_proformaController@modifier_reponse_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');

Route::get('/enregistrer_devis/{res}/{tab}/{lesIdmat}', [
    'as'=>'enregistrer_devis',
    'uses'=>'Demande_proformaController@enregistrer_devis',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');

Route::get('/modifier_devis/{res}/{tab}', [
    'as'=>'modifier_devis',
    'uses'=>'Demande_proformaController@modifier_devis',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');

Route::get('/gestion_reponse_fournisseur',[
    'as'=>'gestion_reponse_fournisseur',
    'uses'=>'Demande_proformaController@gestion_reponse_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');
Route::get('/les_das_fournisseurs_funct_da/{id_da}',[
    'as'=>'les_das_fournisseurs_funct_da',
    'uses'=>'Demande_proformaController@les_das_fournisseurs_funct_da',

])->middleware('auth');
Route::get('/supprimer_reponse_fournisseur/{id_reponse}',[
    'as'=>'supprimer_reponse_fournisseur',
    'uses'=>'Demande_proformaController@supprimer_reponse_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');

Route::post('/selection_de_la_reponse',[
    'as'=>'selection_de_la_reponse',
    'uses'=>'Demande_proformaController@selection_de_la_reponse'

])->middleware('auth');





Route::get('/gestion_bc',[
    'as'=>'gestion_bc',
    'uses'=>'BCController@gestion_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::post('/save_bc',[
    'as'=>'save_bc',
    'uses'=>'BCController@save_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::get('/gestion_bc_ajouter',[
    'as'=>'gestion_bc_ajouter',
    'uses'=>'BCController@gestion_bc_ajouter',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/supprimer_bc/{slug}',[
    'as'=>'supprimer_bc',
    'uses'=>'BCController@supprimer_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/traite_finalise/{slug}',[
    'as'=>'traite_finalise',
    'uses'=>'BCController@traite_finalise',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/traite_retourne/{slug}',[
    'as'=>'traite_retourne',
    'uses'=>'BCController@traite_retourne',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::post('/ajouter_ligne_bc',[
    'as'=>'ajouter_ligne_bc',
    'uses'=>'BCController@ajouter_ligne_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::post('/save_ligne_bc',[
    'as'=>'save_ligne_bc',
    'uses'=>'BCController@save_ligne_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/detail_rep_fournisseur/{slug}',[
    'as'=>'detail_rep_fournisseur',
    'uses'=>'BCController@detail_rep_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/lister_commande/{slug}',[
    'as'=>'lister_commande',
    'uses'=>'BCController@lister_commande',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/modifier_ligne_bc/{slug}',[
    'as'=>'modifier_ligne_bc',
    'uses'=>'BCController@modifier_ligne_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::post('/update_ligne_bc',[
    'as'=>'update_ligne_bc',
    'uses'=>'BCController@update_ligne_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/supprimer_ligne_bc/{slug}',[
    'as'=>'supprimer_ligne_bc',
    'uses'=>'BCController@supprimer_ligne_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/valider_commande/{slug}',[
    'as'=>'valider_commande',
    'uses'=>'BCController@valider_commande',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/annuler_commande/{slug}',[
    'as'=>'annuler_commande',
    'uses'=>'BCController@annuler_commande',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::get('/refuser_commande/{slug}',[
    'as'=>'refuser_commande',
    'uses'=>'BCController@refuser_commande',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::get('/bon_commande_file/{slug}',[
    'as'=>'bon_commande_file',
    'uses'=>'BCController@bon_commande_file'

])->middleware('auth');
Route::get('/bon_commande_file1/{slug}',[
    'as'=>'bon_commande_file1',
    'uses'=>'BCController@bon_commande_file1'

])->middleware('auth');
Route::get('/send_it/{slug}',[
    'as'=>'send_it',
    'uses'=>'BCController@send_it'

])->middleware('auth');

Route::get('/mettre_ajour',[
    'as'=>'mettre_ajour',
    'uses'=>'NotificationController@mettre_ajour'

])->middleware('auth');











Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
