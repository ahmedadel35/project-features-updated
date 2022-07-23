<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        SEOTools::setTitle(__('nav.home'));

        return view('home');
    }
}
