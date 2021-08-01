<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Ebook\Entities\Ebook;

class AccountDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebooks=Ebook::forCard()
                ->where('user_id',auth()->user()->id)
                ->withoutGlobalScope('active')->latest()
                ->paginate(10);
                
        
        return view('public.account.dashboard.index', compact('ebooks'));
    }
}
