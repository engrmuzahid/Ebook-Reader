<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Entities\Role;
use Illuminate\Support\Carbon;
use Modules\Files\Entities\Files;
use Modules\Ebook\Entities\Ebook;
use Modules\Ebook\Entities\ReportedEbook;
use Modules\Review\Entities\Review;
class AdminController extends Controller
{
    /**
     * Display the dashboard with its widgets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin::dashboard.index', [
            'totalUsers' => User::totalUsers(),
            'thisMonthUsers' => $this->getThisMonthUsers(),
            'todayUsers' => $this->getTodayUsers(),
            'activatUsers' => $this->getActivatUsers(),
            
            'totalEbook' => $this->totalEbook(),
            'thisMonthEbook' => $this->getThisMonthEbook(),
            'todayEbook' => $this->getTodayEbook(),
            'totalReportedEbooks' => $this->getTotalReportedEbooks(),
            
            'latestEbooks' => $this->getLatestEbooks(),
            'latestReviews' => $this->getLatestReviews(),
            'latestReportedEbooks' => $this->getLatestReportedEbooks(),
        ]);
    }
    
    private function getThisMonthUsers()
    {
        return Role::findOrNew(setting('user_role'))->users()->where(
            'users.created_at', '>=', Carbon::now()->startOfMonth()->toDateString()
        )->count();
    }
    private function getTodayUsers()
    {
        
        return Role::findOrNew(setting('user_role'))->users()->where(
            'users.created_at', '>=', Carbon::now()->toDateString()
        )->count();
    }
    private function getActivatUsers()
    {
        
        return  User::leftJoin('activations', 'users.id', '=', 'activations.user_id')->leftJoin('user_roles','users.id','=', 'user_roles.user_id')->where('user_roles.role_id',setting('user_role'))->where('activations.completed',1)->count();
    }
    
    
    private function totalEbook()
    {
       return Ebook::withoutGlobalScope('active')->count();
    }
    private function getThisMonthEbook()
    {
        return Ebook::withoutGlobalScope('active')->where(
            'created_at', '>=', Carbon::now()->startOfMonth()->toDateString()
        )->count();
    }
    private function getTodayEbook()
    {
        
        return Ebook::withoutGlobalScope('active')->where(
            'created_at', '>=', Carbon::now()->toDateString()
        )->count();
    }
    private function getTotalReportedEbooks()
    {
        
         return ReportedEbook::count();
    }
    
    /**
     * Get latest eBooks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getLatestEbooks()
    {
        return Ebook::forCard()
            ->withoutGlobalScope('active')
            ->limit(5)
            ->latest()->get();
    }
    
    /**
     * Get latest five reviews.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getLatestReviews()
    {
        return Review::select('id', 'ebook_id', 'reviewer_name', 'rating')
            ->has('ebook')
            ->with('ebook:id')
            ->limit(5)
            ->latest()->get();
    }

    /**
     * Get latest Reported ebooks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getLatestReportedEbooks()
    {
        return ReportedEbook::forCard()
            ->limit(5)
            ->latest()->get();
    }
    
}
