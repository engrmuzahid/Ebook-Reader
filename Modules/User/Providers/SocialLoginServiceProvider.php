<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class SocialLoginServiceProvider extends ServiceProvider
{
    private $providers = ['facebook', 'google'];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! config('app.installed')) {
            return;
        }

        $this->registerEnabledProviders();
        $this->setupFacebook();
        $this->setupGoogle();
    }

    private function registerEnabledProviders()
    {
        $this->app->singleton('enabled_social_login_providers', $this->getEnabledProviders());
    }

    private function getEnabledProviders()
    {
        return function () {
            return array_filter($this->providers, function ($provider) {
                return setting("{$provider}_login_enabled");
            });
        };
    }

    private function setupFacebook()
    {
        $this->app['config']->set('services.facebook', [
            'client_id' => setting('facebook_login_app_id'),
            'client_secret' => setting('facebook_login_app_secret'),
            'redirect' => url('login/facebook/callback'),
        ]);
    }

    private function setupGoogle()
    {
        $this->app['config']->set('services.google', [
            'client_id' => setting('google_login_client_id'),
            'client_secret' => setting('google_login_client_secret'),
            'redirect' => url('login/google/callback'),
        ]);
    }
}
