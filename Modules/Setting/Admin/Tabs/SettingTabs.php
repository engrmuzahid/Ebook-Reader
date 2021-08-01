<?php

namespace Modules\Setting\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;
use Modules\Base\Helpers\Locale;
use Modules\Base\Helpers\TimeZone;
use Modules\User\Entities\Role;
use Modules\Files\Entities\Files;

class SettingTabs extends CiTabs
{
    /**
     * Make new ci tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('general_settings', clean(trans('setting::settings.tabs.group.general_settings')))
            ->active()
            ->add($this->general())
            ->add($this->theme())
            ->add($this->eBook())
            ->add($this->emailSetup())
            ->add($this->newsletter())
            ->add($this->customJsCSS())
            ->add($this->maintenance());
        
       
            
        $this->group('social_logins', clean(trans('setting::settings.tabs.group.social_logins')))
            ->add($this->facebook())
            ->add($this->google());
            
        /* $this->group('payment_methods', trans('setting::settings.tabs.group.payment_methods'))
            ->add($this->stripe()); */
            
    }

    private function general()
    {
        return tap(new CiTab('general', clean(trans('setting::settings.tabs.general'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);

            $tab->fields([
                'translatable.site_name',
                'site_email',
                'supported_locales.*',
                'default_locale',
                'default_timezone',
                'user_role',
            ]);

            $tab->view('setting::admin.settings.tabs.general', [
                'locales' => Locale::all(),
                'timeZones' => TimeZone::all(),
                'roles' => Role::list(),
            ]);
        });
    }
    
    private function theme()
    {
        return tap(new CiTab('theme', clean(trans('setting::settings.tabs.theme'))), function (CiTab $tab) {
            $tab->weight(5);

            $tab->fields([
            ]);
            
            $tab->view('setting::admin.settings.tabs.theme', [ ]);
        });
    }
    
    private function eBook()
    {
        return tap(new CiTab('eBook', clean(trans('setting::settings.tabs.eBook'))), function (CiTab $tab) {
            $tab->weight(5);
            $tab->fields([
                'allowed_file_types',
                
            ]);
            $tab->view('setting::admin.settings.tabs.ebook');
        });
    }
    
    private function emailSetup()
    {
        return tap(new CiTab('email', clean(trans('setting::settings.tabs.email'))), function (CiTab $tab) {
            $tab->weight(10);
            $tab->fields(['mail_from_address']);
            $tab->view('setting::admin.settings.tabs.email', [
                'encryptionProtocols' => $this->getMailEncryptionProtocols(),
            ]);
        });
    }

    private function getMailEncryptionProtocols()
    {
        return ['' => clean(trans('admin::admin.form.please_select'))] + clean(trans('setting::settings.form.email_encryption_protocols'));
    }
    
     private function newsletter()
    {
        return tap(new CiTab('newsletter', trans('setting::settings.tabs.newsletter')), function (CiTab $tab) {
            $tab->weight(15);
            $tab->fields(['newsletter_enabled', 'mailchimp_api_key', 'mailchimp_list_id']);
            $tab->view('setting::admin.settings.tabs.newsletter', [
                'newsletterBgImage' => $this->getMedia(setting('newsletter_bg_image')),
            ]);
        });
    }
    
    private function getMedia($fileId)
    {
        
        return Files::findOrNew($fileId);
        
    }
    
    private function customJsCSS()
    {
        return tap(new CiTab('custom_js_css', clean(trans('setting::settings.tabs.custom_js_css'))), function (CiTab $tab) {
            $tab->weight(15);
            $tab->view('setting::admin.settings.tabs.custom_js_css');
        });
    }
    
    private function maintenance()
    {
        return tap(new CiTab('maintenance', clean(trans('setting::settings.tabs.maintenance'))), function (CiTab $tab) {
            $tab->weight(20);
            $tab->view('setting::admin.settings.tabs.maintenance');
        });
    }
    
    private function facebook()
    {
        return tap(new CiTab('facebook', clean(trans('setting::settings.tabs.facebook'))), function (CiTab $tab) {
            $tab->weight(10);

            $tab->fields([
                'facebook_login_enabled',
                'translatable.facebook_login_label',
                'facebook_login_app_id',
                'facebook_login_app_secret',
            ]);

            $tab->view('setting::admin.settings.tabs.facebook');
        });
    }

    private function google()
    {
        return tap(new CiTab('google', clean(trans('setting::settings.tabs.google'))), function (CiTab $tab) {
            $tab->weight(20);

            $tab->fields([
                'google_login_enabled',
                'translatable.google_login_label',
                'google_login_client_id',
                'google_login_client_secret',
            ]);

            $tab->view('setting::admin.settings.tabs.google');
        });
    }
    
    private function stripe()
    {
        return tap(new CiTab('stripe', trans('setting::settings.tabs.stripe')), function (CiTab $tab) {
            $tab->weight(60);

            $tab->fields([
                'stripe_enabled',
                'stripe_publishable_key',
                'stripe_secret_key',
            ]);

            $tab->view('setting::admin.settings.tabs.stripe');
        });
    }
    
    

}
