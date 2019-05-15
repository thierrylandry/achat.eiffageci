<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('cool', function () {
   //décirs ton action
})->describe('Display an inspiring quote');
//cette commande permet de notifier les utilisateurs aillant la fonctionnalité de valider un bon de commande et de valider une d.A
Artisan::command('notificateur', function () {
    echo (new \App\Http\Controllers\InfoController())->notificateur();
})->describe('Notifier les utilisateurs sur les activités en attente de traitement. Ex: Demande d achat à valider, bon de commande à signer');
//cette commande permet de notifier les utilisateurs aillant la fonctionnalité de gestion des proforma
Artisan::command('notificateur2', function () {
    echo (new \App\Http\Controllers\InfoController())->notificateur2();
})->describe('Notifier les utilisateurs sur les activités en attente de traitement. Ex: Demande d achat à valider, bon de commande à signer');
