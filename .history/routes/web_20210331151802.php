<?php

use Illuminate\Support\Facades\Route;

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

Route::name('client.')->group(function() {

	Route::post('/login', 'Auth\ClientController@login');

	Route::middleware('guest:client')->group(function() {
		Route::get('/connexion', 'Auth\ClientController@showLoginForm')->name('login');
		Route::get('/mot-de-passe-oublie', 'Auth\ClientController@showForgotPasswordForm')->name('forgot-password');
		Route::get('/nouveau-mot-de-passe', 'Auth\ClientController@showResetPasswordForm')->name('new-password');
	});

	Route::middleware('auth:client')->group(function() {

        Route::resource('/dashboard','Services\listeServiceController');
        Route::get('/','Services\listeServiceController@index');
		//Route::get('facture/{id}','Services\listeServiceController@facture');
        //Route::get('/facturepdf/{id}','PDF\PDFController@pdfshow')->name('facturepdf');
        //Route::get('facture/pdf/{id}','Services\listeServiceController@pdf');
        //Route::get('detail/abonnement/{id}','Services\listeServiceController@details');
        //Route::get('service/facture/{id}', 'Services\listeServiceController@facture');
        Route::resource('abonnement', 'Services\DetailAbonnementController');
		Route::resource('facture/abonnement','Services\FactureAbonnementController');

		Route::resource('/assistances','Assistances\AssistancesController');
        Route::resource('/assistance-technique','Assistances\AssistanceTechniqueController');
        Route::resource('/assistance-commercial','Assistances\AssistanceCommercial');

		Route::resource('/commandes', 'CommandeClientController');


        Route::get('/logout', 'Auth\ClientController@logout');
        Route::get('/client/id','Auth\ClientController@getId')->name('id');

        Route::resource('/info/client', 'ClientInfo\ClientInfoController');
        Route::resource('/update/password', 'ClientInfo\passwordUpdateController');
        Route::resource('/tickets', 'TicketController');
        Route::resource('/ticket-messages', 'TicketMessageController');


		Route::get('/logout', 'Auth\ClientController@logout');
	});

});

Route::prefix('admin')->name('admin.')->group(function() {

	Route::post('/login', 'Auth\AdminController@login');

	Route::middleware('guest:admin')->group(function() {
		Route::get('/connexion', 'Auth\AdminController@showLoginForm')->name('login');
		Route::get('/mot-de-passe-oublie', 'Auth\AdminController@showForgotPasswordForm')->name('forgot-password');
		Route::get('/nouveau-mot-de-passe', 'Auth\AdminController@showResetPasswordForm')->name('new-password');
	});

	Route::middleware('auth:admin')->group(function() {

		// Route::get('/', function() {
		// 	$data = ['title' => 'Tableau de bord'];
		// 	return view('admin.dashboard', $data);
		// })->name('dashboard');

		Route::get('/', 'AdminDashboardController@index')->name('dashboard');
		Route::get('/recherche', 'RechercheAbonnementController@index')->name('search');

		Route::get('/logout', 'Auth\AdminController@logout');

		Route::get('/abonnements/{id}/factures/create', 'FactureController@create');

		Route::put('/abonnements/renouveller/{id}', 'Abonnements\AbonnementController@renouveller');
		Route::put('/abonnements/resilier/{id}', 'Abonnements\AbonnementController@resilier');

		Route::resource('/abonnements/hebergements', 'Abonnements\HebergementController');
		Route::resource('/abonnements/domaines', 'Abonnements\DomaineController');
		Route::resource('/abonnements/sitewebs', 'Abonnements\SiteWebController');
		Route::resource('/abonnements/messageriepros', 'Abonnements\MessagerieProController');
		Route::resource('/abonnements/certificatssls', 'Abonnements\CertificatSslController');
		Route::resource('/abonnements/service_particuliers', 'Abonnements\ServiceParticulierController');
		Route::resource('/abonnements', 'Abonnements\AbonnementController');

		Route::resource('/administrateurs', 'AdminController');

		Route::get('/clients/{id}/abonnements/hebergements/create', 'Abonnements\HebergementController@create');
		Route::get('/clients/{id}/abonnements/domaines/create', 'Abonnements\DomaineController@create');
		Route::get('/clients/{id}/abonnements/sitewebs/create', 'Abonnements\SiteWebController@create');
		Route::get('/clients/{id}/abonnements/messageriepros/create', 'Abonnements\MessagerieProController@create');
		Route::get('/clients/{id}/abonnements/certificatssls/create', 'Abonnements\CertificatSslController@create');
		Route::get('/clients/{id}/abonnements/service_partculiers/create', 'Abonnements\ServiceParticulierController@create');
		Route::get('/clients/{id}/abonnements', 'ClientController@abonnements');

		Route::resource('/clients', 'ClientController');
		Route::resource('/commandes', 'CommandeController');

		Route::resource('/services/hebergements', 'Services\HebergementController');
		Route::resource('/services/domaines', 'Services\DomaineController');
		Route::resource('/services/sitewebs', 'Services\SitewebController');
		Route::resource('/services/messageriepros', 'Services\MessagerieProController');
		Route::resource('/services/certificatssls', 'Services\CertificatSslController');
		Route::resource('/services/service_particuliers', 'Services\ServiceParticulierController');
		Route::resource('/services', 'Services\ServiceController');

		Route::resource('/factures', 'FactureController');
		Route::resource('/assistances','Admin\AssistancesController');
		Route::resource('/tickets', 'Admin\TicketController');
		Route::resource('/ticket-messages', 'Admin\TicketMessageController');
	});

});

