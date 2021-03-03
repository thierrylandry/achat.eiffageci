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
Route::redirect('/','/login');
// Route qui permet de modifier la langue
Route::get('change/{lang}', [
    'as'=>'change',
    'uses'=>'LocalizationController@setLang'

]);
Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale'], function() {



Route::get('/', function () {
    return redirect(app()->getLocale());
});
Route::get('erreur', [
    'as'=>'erreur',
    'uses'=>'ErreurController@erreur'

]);

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
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');
Route::post('/Validproduits', [
    'as'=>'Validproduits',
    'uses'=>'ProduitController@Validproduits',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']
])->middleware('auth');
Route::get('/voir_produit/{slug}',[
    'as'=>'voir_produit',
    'uses'=>'ProduitController@voir_produit',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');
Route::get('/supprimer_produit/{slug}',[
    'as'=>'supprimer_produit',
    'uses'=>'ProduitController@supprimer_produit',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');
Route::post('/modifier_produit}',[
    'as'=>'modifier_produit',
    'uses'=>'ProduitController@modifier_produit',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');




Route::get('/monprofile/{id}',[
    'as'=>'monprofile',
    'uses'=>'UtilisateurController@monprofile',

])->middleware('auth');
Route::get('/gestion_utilisateur',[
    'as'=>'gestion_utilisateur',
    'uses'=>'UtilisateurController@utilisateurs',
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





Route::get('/gestion_da',[
    'as'=>'gestion_da',
    'uses'=>'DAController@das',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');
Route::get('/demande_achat',[
    'as'=>'demande_achat',
    'uses'=>'DAController@demande_achat',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');
Route::get('/creer_da',[
    'as'=>'creer_da',
    'uses'=>'DAController@creer_da',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');
Route::get('/da_multiple',[
    'as'=>'da_multiple',
    'uses'=>'DAController@da_multiple',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']

])->middleware('auth');

Route::get('/lister_da',[
    'as'=>'lister_da',
    'uses'=>'DAController@das',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA','Gestionnaire_Pro_Forma']

])->middleware('auth');

Route::get('/lister_da_recherche',[
    'as'=>'lister_da_recherche',
    'uses'=>'DAController@lister_da_recherche',
    'middleware' => 'roles',

])->middleware('auth');
Route::get('/encours_validation',[
    'as'=>'encours_validation',
    'uses'=>'DAController@encours_validation',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA','Gestionnaire_Pro_Forma']

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
Route::get('code_gestion_produit/{id}',[
    'as'=>'code_gestion_produit',
    'uses'=>'DAController@code_gestion_produit',


])->middleware('auth');

Route::get('/confirmer_da/{slug}',[
    'as'=>'confirmer_da',
    'uses'=>'DAController@confirmer_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');
Route::get('/donne_moi_le_nom_des_designations/{id}',[
    'as'=>'donne_moi_le_nom_des_designations',
    'uses'=>'DAController@donne_moi_le_nom_des_designations',

])->middleware('auth');
Route::get('/menu_produit',[
    'as'=>'menu_produit',
    'uses'=>'ProduitController@menu_produit',

])->middleware('auth');
Route::get('/domaines',[
    'as'=>'domaines',
    'uses'=>'ProduitController@domaines',

])->middleware('auth');

Route::get('/modifier_domaine/{id}',[
    'as'=>'modifier_domaine',
    'uses'=>'ProduitController@modifier_domaine',

])->middleware('auth');
Route::get('/supprimer_domaine/{id}',[
    'as'=>'supprimer_domaine',
    'uses'=>'ProduitController@supprimer_domaine',

])->middleware('auth');
Route::get('familles',[
    'as'=>'familles',
    'uses'=>'ProduitController@familles',

])->middleware('auth');

Route::get('/modifier_famille/{id}',[
    'as'=>'modifier_famille',
    'uses'=>'ProduitController@modifier_famille',

])->middleware('auth');
Route::get('/supprimer_famille/{id}',[
    'as'=>'supprimer_famille',
    'uses'=>'ProduitController@supprimer_famille',

])->middleware('auth');
Route::get('/designations',[
    'as'=>'designations',
    'uses'=>'ProduitController@designations',

])->middleware('auth');
Route::get('/generer_numero_bc',[
    'as'=>'generer_numero_bc',
    'uses'=>'BCController@generer_numero_bc',

])->middleware('auth');
Route::get('/detail_regularisation/{id_fournisseur}',[
    'as'=>'detail_regularisation',
    'uses'=>'BCController@detail_regularisation',

])->middleware('auth');


Route::get('/modifier_designation/{id}',[
    'as'=>'modifier_designation',
    'uses'=>'ProduitController@modifier_designation',

])->middleware('auth');
Route::get('/supprimer_designation/{id}',[
    'as'=>'supprimer_designation',
    'uses'=>'ProduitController@supprimer_designation',

])->middleware('auth');
Route::get('/performance_fournisseur',[
    'as'=>'performance_fournisseur',
    'uses'=>'RapportController@performance_fournisseur',

])->middleware('auth');
Route::get('/rapport_demande_achat',[
    'as'=>'rapport_demande_achat',
    'uses'=>'RapportController@rapport_demande_achat',

])->middleware('auth');
Route::get('/rapport_stock',[
    'as'=>'rapport_stock',
    'uses'=>'RapportController@rapport_stock',

])->middleware('auth');
Route::get('rapport/{id}',[
    'as'=>'rapport',
    'uses'=>'RapportController@rapport',

])->middleware('auth');
Route::get('/fifo/{id_materiel}',[
    'as'=>'fifo',
    'uses'=>'RapportController@fifo',

])->middleware('auth');
Route::get('/stock_min',[
    'as'=>'stock_min',
    'uses'=>'GestionStockController@stock_min',

])->middleware('auth');
Route::get('/donne_moi_les_famille/{domaine}',[
    'as'=>'donne_moi_les_famille',
    'uses'=>'ReceptionController@donne_moi_les_famille',

])->middleware('auth');
Route::get('/donne_moi_les_famille_disponible/{domaine}',[
    'as'=>'donne_moi_les_famille_disponible',
    'uses'=>'GestionStockController@donne_moi_les_famille_disponible',

])->middleware('auth');
Route::get('/donne_moi_les_designation_disponible/{famille}',[
    'as'=>'donne_moi_les_designation_disponible',
    'uses'=>'GestionStockController@donne_moi_les_designation_disponible',

])->middleware('auth');
Route::get('/donne_moi_toute_la_refference/{refference}',[
    'as'=>'donne_moi_toute_la_refference',
    'uses'=>'ReceptionController@donne_moi_toute_la_refference',

])->middleware('auth');
Route::get('/donne_moi_les_designation/{domaine}',[
    'as'=>'donne_moi_les_designation',
    'uses'=>'ReceptionController@donne_moi_les_designation',

])->middleware('auth');
Route::get('/mon_panier',[
    'as'=>'mon_panier',
    'uses'=>'DAController@mon_panier',

])->middleware('auth');
Route::get('/historique_achat',[
    'as'=>'historique_achat',
    'uses'=>'DAController@historique_achat',

])->middleware('auth');
Route::get('/creation_ajout_de_panier/{id}',[
    'as'=>'creation_ajout_de_panier',
    'uses'=>'DAController@creation_ajout_de_panier',

])->middleware('auth');
Route::get('/retirer_du_panier/{id}',[
    'as'=>'retirer_du_panier',
    'uses'=>'DAController@retirer_du_panier',

])->middleware('auth');


Route::get('/validation_da_collective/{id}',[
    'as'=>'validation_da_collective',
    'uses'=>'DAController@validation_da_collective',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');
Route::get('/refus_da_collective/{id}',[
    'as'=>'refus_da_collective',
    'uses'=>'DAController@refus_da_collective',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');
Route::get('/confirmer_da_depuis_creermodifier_da/{slug}',[
    'as'=>'confirmer_da_depuis_creermodifier_da',
    'uses'=>'DAController@confirmer_da_depuis_creermodifier_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');
Route::get('/suspendre_da/{slug}',[
    'as'=>'suspendre_da',
    'uses'=>'DAController@suspendre_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');

Route::get('/supprimer_da/{slug}',[
    'as'=>'supprimer_da',
    'uses'=>'DAController@supprimer_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA','Gestionnaire_DA']

])->middleware('auth');
Route::get('/adapter',[
    'as'=>'adapter',
    'uses'=>'DAController@adapter',

])->middleware('auth');





Route::get('/gestion_prix',[
    'as'=>'gestion_prix',
    'uses'=>'PrixController@prixs'

])->middleware('auth');

Route::get('/voir_prix/{slug}',[
    'as'=>'voir_prix',
    'uses'=>'PrixController@voir_prix'

])->middleware('auth');
Route::get('/supprimer_prix/{slug}',[
    'as'=>'supprimer_prix',
    'uses'=>'PrixController@supprimer_prix'

])->middleware('auth');

Route::get('/supprimer_prix/{slug}',[
    'as'=>'supprimer_prix',
    'uses'=>'PrixController@supprimer_prix'

])->middleware('auth');

Route::get('/contact_fonction_du_fournisseur/{slug}',[
    'as'=>'contact_fonction_du_fournisseur',
    'uses'=>'Demande_proformaController@contact_fonction_du_fournisseur'

])->middleware('auth');

Route::get('/list_contact/{slug}',[
    'as'=>'list_contact',
    'uses'=>'BCController@list_contact'

])->middleware('auth');




Route::get('/gestion_demande_proformas',[
    'as'=>'gestion_demande_proformas',
    'uses'=>'Demande_proformaController@demande_proformas',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');

Route::get('/demande_ou_rappel/{tab_fourn}/{list_da}',[
    'as'=>'demande_ou_rappel',
    'uses'=>'Demande_proformaController@demande_ou_rappel',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');

Route::get('/nouveau_rappel/{id_tace_mail}',[
    'as'=>'nouveau_rappel',
    'uses'=>'Demande_proformaController@nouveau_rappel',
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
Route::get('/gestion_stock', [
    'as'=>'gestion_stock',
    'uses'=>'GestionStockController@gestion_stock',
])->middleware('auth');
Route::get('/reste_en_stock/{valeur}', [
    'as'=>'reste_en_stock',
    'uses'=>'GestionStockController@reste_en_stock',
])->middleware('auth');


Route::get('/delete_mouvement/{id}', [
    'as'=>'delete_mouvement',
    'uses'=>'GestionStockController@delete_mouvement',
])->middleware('auth');
Route::get('/stock', [
    'as'=>'stock',
    'uses'=>'GestionStockController@stock',
])->middleware('auth');
Route::get('/edit_mouvement/{id}', [
    'as'=>'edit_mouvement',
    'uses'=>'GestionStockController@edit_mouvement',
])->middleware('auth');
Route::get('/sortie_stock', [
    'as'=>'sortie_stock',
    'uses'=>'GestionStockController@sortie_stock',
])->middleware('auth');
///enregistrer_devis/{res}/{tab}/{lesIdmat}


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
Route::get('/recup_infos_pour_envois_mail_perso/{listeDA}',[
    'as'=>'recup_infos_pour_envois_mail_perso',
    'uses'=>'Demande_proformaController@recup_infos_pour_envois_mail_perso',

])->middleware('auth');
Route::get('/supprimer_reponse_fournisseur/{id_reponse}',[
    'as'=>'supprimer_reponse_fournisseur',
    'uses'=>'Demande_proformaController@supprimer_reponse_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');



//gestion de bon de commande

Route::get('/gestion_bc',[
    'as'=>'gestion_bc',
    'uses'=>'BCController@gestion_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC','Valideur_BC']

])->middleware('auth');

Route::get('/regularisation',[
    'as'=>'regularisation',
    'uses'=>'BCController@regularisation',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC','Valideur_BC']

])->middleware('auth');

Route::get('/gestion_bc',[
    'as'=>'gestion_bc',
    'uses'=>'BCController@gestion_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC','Valideur_BC']

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
    'roles' => ['Gestionnaire_BC','Valideur_BC']

])->middleware('auth');
Route::get('/add_new_da_to_bc/{id}/{id_bc}',[
    'as'=>'add_new_da_to_bc',
    'uses'=>'BCController@add_new_da_to_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC','Valideur_BC']

])->middleware('auth');
Route::get('/detail_list_devis/{id_bc}',[
    'as'=>'detail_list_devis',
    'uses'=>'BCController@detail_list_devis',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC','Valideur_BC']

])->middleware('auth');
Route::get('/retirer_da_to_bc/{id}/{id_bc}',[
    'as'=>'retirer_da_to_bc',
    'uses'=>'BCController@retirer_da_to_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC','Valideur_BC']

])->middleware('auth');
Route::get('/supprimer_def_da_to_bc/{id}/{id_bc}',[
    'as'=>'supprimer_def_da_to_bc',
    'uses'=>'BCController@supprimer_def_da_to_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC','Valideur_BC']

])->middleware('auth');
Route::get('/supprimer_def_devis/{id}',[
    'as'=>'supprimer_def_devis',
    'uses'=>'Demande_proformaController@supprimer_def_devis',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');

Route::get('/supprimer_def_devis2/{id}',[
    'as'=>'supprimer_def_devis2',
    'uses'=>'Demande_proformaController@supprimer_def_devis2',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');



Route::get('/modifier_ligne_bc/{slug}',[
    'as'=>'modifier_ligne_bc',
    'uses'=>'BCController@modifier_ligne_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::get('/supprimer_ligne_bc/{slug}',[
    'as'=>'supprimer_ligne_bc',
    'uses'=>'BCController@supprimer_ligne_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::get('/bc_express',[
    'as'=>'bc_express',
    'uses'=>'BCController@bc_express',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::get('/reception_commande',[
    'as'=>'reception_commande',
    'uses'=>'ReceptionController@reception_commande',

])->middleware('auth');
Route::get('reception_commande_sans_bc',[
    'as'=>'reception_commande_sans_bc',
    'uses'=>'ReceptionController@reception_commande_sans_bc',

])->middleware('auth');
Route::get('/historique_bl',[
    'as'=>'historique_bl',
    'uses'=>'ReceptionController@historique_bl',

])->middleware('auth');
Route::get('/reception_commande_sans_bc_edit/{id}',[
    'as'=>'reception_commande_sans_bc_edit',
    'uses'=>'ReceptionController@reception_commande_sans_bc_edit',

])->middleware('auth');



Route::match(['get', 'post'],'/reception_commande_numero',[
    'as'=>'reception_commande_numero',
    'uses'=>'ReceptionController@reception_commande_numero',

])->middleware('auth');

Route::get('/supprimer_livraison/{id}',[
    'as'=>'supprimer_livraison',
    'uses'=>'ReceptionController@supprimer_livraison',

])->middleware('auth');
Route::get('/supprimer_livraison_sans_bc/{id}',[
    'as'=>'supprimer_livraison_sans_bc',
    'uses'=>'ReceptionController@supprimer_livraison_sans_bc',

])->middleware('auth');
Route::get('/bc_express/{nb}',[
    'as'=>'bc_express',
    'uses'=>'BCController@bc_express',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::get('/chercher_codeRubrique/{id}',[
    'as'=>'chercher_codeRubrique',
    'uses'=>'BCController@chercher_codeRubrique',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');

Route::get('/valider_commande/{slug}',[
    'as'=>'valider_commande',
    'uses'=>'BCController@valider_commande',
    'middleware' => 'roles',
    'roles' => ['Valideur_BC']

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
    'roles' => ['Valideur_BC']

])->middleware('auth');
Route::get('/bon_commande_file/{slug}',[
    'as'=>'bon_commande_file',
    'uses'=>'BCController@bon_commande_file'

])->middleware('auth');
Route::get('/bon_commande_file1/{slug}',[
    'as'=>'bon_commande_file1',
    'uses'=>'BCController@bon_commande_file1'

])->middleware('auth');

Route::get('/afficher_le_mail/{slug}',[
    'as'=>'afficher_le_mail',
    'uses'=>'BCController@afficher_le_mail'

])->middleware('auth');




Route::get('/list_materiel_produit',[
    'as'=>'list_materiel_produit',
    'uses'=>'BCController@list_materiel_produit',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');


//fin
// validation de bon de commande
Route::get('/validation_bc',[
    'as'=>'validation_bc',
    'uses'=>'BCController@validation_bc',
    'middleware' => 'roles',
    'roles' => ['Valideur_BC']

])->middleware('auth');

Route::get('/validation_bc_collective/{id}',[
    'as'=>'validation_bc_collective',
    'uses'=>'BCController@validation_bc_collective',
    'middleware' => 'roles',
    'roles' => ['Valideur_BC']

])->middleware('auth');



Route::get('/Gestion_Facture',[
    'as'=>'Gestion_Facture',
    'uses'=>'FactureController@Gestion_Facture',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Facture']

])->middleware('auth');

Route::get('/listfacture/{id}/',[
    'as'=>'listfacture',
    'uses'=>'FactureController@listfacture',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Facture']

])->middleware('auth');
Route::get('/afficherfacture/{id}/',[
    'as'=>'afficherfacture',
    'uses'=>'FactureController@afficherfacture',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Facture']

])->middleware('auth');
Route::get('/supprimerfacture/{id}/',[
    'as'=>'supprimerfacture',
    'uses'=>'FactureController@supprimerfacture',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Facture']

])->middleware('auth');

Route::get('/mettre_ajour',[
    'as'=>'mettre_ajour',
    'uses'=>'NotificationController@mettre_ajour'

])->middleware('auth');


Route::get('/notificateur',[
    'as'=>'notificateur',
    'uses'=>'InfoController@notificateur'

]);



    Route::get('afficher_contenue_panier',[
        'as'=>'afficher_contenue_panier',
        'uses'=>'DAController@afficher_contenue_panier',

    ])->middleware('auth');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
});


//en dehors du group

Route::post('/enregistrer_mouvement', [
    'as'=>'enregistrer_mouvement',
    'uses'=>'GestionStockController@enregistrer_mouvement',
])->middleware('auth');

Route::post('/enregistrer_devis', [
    'as'=>'enregistrer_devis',
    'uses'=>'Demande_proformaController@enregistrer_devis',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');

Route::post('/modifier_devis', [
    'as'=>'modifier_devis',
    'uses'=>'Demande_proformaController@modifier_devis',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']
])->middleware('auth');
Route::post('/send_it_personnalisé_ddd',[
    'as'=>'send_it_personnalisé_ddd',
    'uses'=>'Demande_proformaController@send_it_personnalisé_ddd',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');
Route::post('/supprimer_def_devis_collectif',[
    'as'=>'supprimer_def_devis_collectif',
    'uses'=>'Demande_proformaController@supprimer_def_devis_collectif',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');
Route::post('/selection_de_la_reponse',[
    'as'=>'selection_de_la_reponse',
    'uses'=>'Demande_proformaController@selection_de_la_reponse'

])->middleware('auth');
Route::post('/save_bc',[
    'as'=>'save_bc',
    'uses'=>'BCController@save_bc',
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
Route::post('/supprimer_def_devis2_collectif',[
    'as'=>'supprimer_def_devis2_collectif',
    'uses'=>'Demande_proformaController@supprimer_def_devis2_collectif',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Pro_Forma']

])->middleware('auth');

Route::post('/update_ligne_bc',[
    'as'=>'update_ligne_bc',
    'uses'=>'BCController@update_ligne_bc',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::post('/receptionner_commande',[
    'as'=>'receptionner_commande',
    'uses'=>'ReceptionController@receptionner_commande',

])->middleware('auth');
Route::post('/receptionner_commande_sans_bc_update',[
    'as'=>'receptionner_commande_sans_bc_update',
    'uses'=>'ReceptionController@receptionner_commande_sans_bc_update',

])->middleware('auth');
Route::post('/receptionner_commande_sans_bc',[
    'as'=>'receptionner_commande_sans_bc',
    'uses'=>'ReceptionController@receptionner_commande_sans_bc',

])->middleware('auth');
Route::post('/send_it_personnalisé',[
    'as'=>'send_it_personnalisé',
    'uses'=>'BCController@send_it_personnalisé',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::post('/send_it',[
    'as'=>'send_it',
    'uses'=>'BCController@send_it',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::post('/preciser_les_date_de_livraison',[
    'as'=>'preciser_les_date_de_livraison',
    'uses'=>'BCController@preciser_les_date_de_livraison',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::post('/ajouterFacture',[
    'as'=>'ajouterFacture',
    'uses'=>'FActureController@ajouterFacture',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_Facture']

])->middleware('auth');
Route::post('/add_date_livraison',[
    'as'=>'add_date_livraison',
    'uses'=>'BCController@add_date_livraison',
    'roles' => ['Gestionnaire_BC']

])->middleware('auth');
Route::post('/Validfournisseur', [
    'as'=>'Validfournisseur',
    'uses'=>'FournisseurController@Validfournisseur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');
Route::post('/modifier_mouvement', [
    'as'=>'modifier_mouvement',
    'uses'=>'GestionStockController@modifier_mouvement',
])->middleware('auth');
Route::post('/update_designation',[
    'as'=>'update_designation',
    'uses'=>'ProduitController@update_designation',

])->middleware('auth');
Route::post('/enregistrer_designation',[
    'as'=>'enregistrer_designation',
    'uses'=>'ProduitController@enregistrer_designation',
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
Route::post('/modifier_prix',[
    'as'=>'modifier_prix',
    'uses'=>'PrixController@modifier_prix'

])->middleware('auth');
Route::post('/lister_fournisseur',[
    'as'=>'lister_fournisseur',
    'uses'=>'PrixController@lister_fournisseur'

])->middleware('auth');
Route::post('/modifier_profil}',[
    'as'=>'modifier_profil',
    'uses'=>'ProfilController@modifier_profil',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');

Route::post('/enregistrer_da_multiple',[
    'as'=>'enregistrer_da_multiple',
    'uses'=>'DAController@enregistrer_da_multiple',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA','Gestionnaire_DA']

])->middleware('auth');
Route::post('/recherche_da',[
    'as'=>'recherche_da',
    'uses'=>'DAController@recherche_da',
    'middleware' => 'roles',

])->middleware('auth');

Route::post('/Validdas', [
    'as'=>'Validdas',
    'uses'=>'DAController@Validdas',
    'middleware' => 'roles',
    'roles' => ['Gestionnaire_DA']
])->middleware('auth');

Route::post('/changer_code_gestion',[
    'as'=>'changer_code_gestion',
    'uses'=>'DAController@changer_code_gestion',
    'middleware' => 'roles',

])->middleware('auth');
Route::post('/update_domaine',[
    'as'=>'update_domaine',
    'uses'=>'ProduitController@update_domaine',

])->middleware('auth');
Route::post('/enregistrer_domaine',[
    'as'=>'enregistrer_domaine',
    'uses'=>'ProduitController@enregistrer_domaine',

])->middleware('auth');
Route::post('/update_famille',[
    'as'=>'update_famille',
    'uses'=>'ProduitController@update_famille',

])->middleware('auth');
Route::post('/enregistrer_famille',[
    'as'=>'enregistrer_famille',
    'uses'=>'ProduitController@enregistrer_famille',

])->middleware('auth');
Route::post('/mise_ajour_info_da',[
    'as'=>'mise_ajour_info_da',
    'uses'=>'DAController@mise_ajour_info_da',

])->middleware('auth');
Route::post('/modifier_da',[
    'as'=>'modifier_da',
    'uses'=>'DAController@modifier_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA','Gestionnaire_DA']

])->middleware('auth');
Route::post('/refuser_da',[
    'as'=>'refuser_da',
    'uses'=>'DAController@refuser_da',
    'middleware' => 'roles',
    'roles' => ['Valideur_DA']

])->middleware('auth');
Route::post('/modifier_panier',[
    'as'=>'modifier_panier',
    'uses'=>'DAController@modifier_panier',
    'middleware' => 'roles',


])->middleware('auth');
Route::post('/Validutilisateurs', [
    'as'=>'Validutilisateurs',
    'uses'=>'UtilisateurController@Validutilisateurs',
    'middleware' => 'roles',
    'roles' => ['Parametrage']
])->middleware('auth');
Route::post('/modifier_utilisateur}',[
    'as'=>'modifier_utilisateur',
    'uses'=>'UtilisateurController@modifier_utilisateur'

])->middleware('auth');
Route::post('/modifier_profile}',[
    'as'=>'modifier_profile',
    'uses'=>'UtilisateurController@modifier_profile'

])->middleware('auth');
Route::post('/Validprixs', [
    'as'=>'Validprixs',
    'uses'=>'PrixController@Validprixs'
])->middleware('auth');
Route::post('/update_fournisseur',[
    'as'=>'update_fournisseur',
    'uses'=>'FournisseurController@update_fournisseur',
    'middleware' => 'roles',
    'roles' => ['Parametrage']

])->middleware('auth');
