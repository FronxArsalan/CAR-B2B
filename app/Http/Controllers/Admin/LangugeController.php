<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LangugeController extends Controller
{
    public function change(Request $request)
    {
        $lang = $request->lang;
        Cookie::queue(Cookie::make('locale', $lang, 525600)); // 525600 minutes = 1 year

        return redirect()->back();
    }
}
