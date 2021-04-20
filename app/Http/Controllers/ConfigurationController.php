<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    //
    public function configuration($locale){

        return view('configuration/gestion');

    }
}
