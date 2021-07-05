<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class HomeController extends Controller
{
    /**
    * change locale
    *
    * @access public
    * @var  @locale
    */
    public function change_locale($locale)
    {
        $language=Language::where('iso',$locale)->first();

        session()->put('locale',$locale);
        session()->put('rtl',$language['rtl']);
        session()->forget('trans');

        return redirect()->back();
    }
}
