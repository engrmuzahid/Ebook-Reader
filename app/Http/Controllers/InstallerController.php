<?php

namespace App\Http\Controllers;

use Exception;
use App\Installer\ServerRequirement;
use App\Installer\SetupDatabase;
use App\Installer\AdminUser;
use App\Installer\Application;
use App\Installer\Site;
use Illuminate\Routing\Controller;
use App\Http\Requests\InstallerRequest;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use App\Http\Middleware\RedirectIfInstalled;

class InstallerController extends Controller
{
    public function __construct()
    {
        $this->middleware(RedirectIfInstalled::class);
    }

    public function index()
    {
        return view('installer.index');
    }
    
    public function serverRequirements(ServerRequirement $requirement)
    {
        return view('installer.server-requirements', compact('requirement'));
    }

    public function environmentConfiguration(ServerRequirement $requirement)
    {
        if (! $requirement->pleased()) {
            return redirect('installer/requirements');
        }

        return view('installer.configuration', compact('requirement'));
    }
 
    public function postConfiguration(
        InstallerRequest $request,
        SetupDatabase $database,
        AdminUser $admin,
        Site $site,
        Application $app
    ) {
        set_time_limit(0);
        $request->merge(clean($request->all()));
        try {
            $database->setup($request->db);
            $admin->setup($request->admin);
            $site->setup($request->site);
            $app->setup();
        } catch (Exception $e) {
            return back()->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect('installer/complete');
    }

    public function complete()
    {
        
        if (config('app.installed')) {
            return redirect()->route('home');
        }

        DotenvEditor::setKey('APP_INSTALLED', 'true')->save();

        return view('installer.complete');
    }
}
