<?php

namespace Themes\Cynoebook\Http\Controllers;

use Illuminate\Routing\Controller;

class CookieBarController extends Controller
{
    public function destroy()
    {
        $cookie = cookie()->forever('show_cookie_bar', false);

        return response('')->withCookie($cookie);
    }
}
