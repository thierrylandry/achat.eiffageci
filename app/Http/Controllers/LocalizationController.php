<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    //
    public function getLang() {
        return App::getLocale();
    }

    public function setLang(Request $request){
        $changeLang = $request->lang;
        $userLang = session('locale');

        session(['locale' => $changeLang]);
        app()->setLocale($changeLang);

        $segments = str_replace(url('/'), '', url()->previous());
        $segments = array_filter(explode('/', $segments));
        array_shift($segments);
        array_unshift($segments, $changeLang);

        return redirect()->to(implode('/', $segments));
    }

}
