<div class="form-group">
    <label class="form-label">{{ clean(trans('setting::settings.form.logo_header')) }}</label>
    <div class="row gutters-xs theme-switch-block">
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="dark" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='dark' ? 'checked' : '' }}>
                <span class="colorinput-color dark"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="blue" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='blue' ? 'checked' : '' }}>
                <span class="colorinput-color blue"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="purple" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='purple' ? 'checked' : '' }}>
                <span class="colorinput-color purple"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="light-blue" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='light-blue' ? 'checked' : '' }}>
                <span class="colorinput-color light-blue"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="green" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='green' ? 'checked' : '' }}>
                <span class="colorinput-color green"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="orange" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='orange' ? 'checked' : '' }}>
                <span class="colorinput-color orange"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="red" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='red' ? 'checked' : '' }}>
                <span class="colorinput-color red"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="white" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='white' ? 'checked' : '' }}>
                <span class="colorinput-color dark-arrow white"></span>
            </label>
        </div>
        
    </div>
    <div class="row gutters-xs theme-switch-block">
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="dark2" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='dark2' ? 'checked' : '' }}>
                <span class="colorinput-color dark2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="blue2" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='blue2' ? 'checked' : '' }}>
                <span class="colorinput-color blue2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="purple2" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='purple2' ? 'checked' : '' }}>
                <span class="colorinput-color purple2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="light-blue2" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='light-blue2' ? 'checked' : '' }}>
                <span class="colorinput-color light-blue2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="green2" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='green2' ? 'checked' : '' }}>
                <span class="colorinput-color green2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="orange2" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='orange2' ? 'checked' : '' }}>
                <span class="colorinput-color orange2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_logo_header_color" type="radio" value="red2" class="colorinput-input changeLogoHeaderColor" {{ setting('theme_logo_header_color','blue')=='red2' ? 'checked' : '' }}>
                <span class="colorinput-color red2"></span>
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label">{{ clean(trans('setting::settings.form.navbar_header')) }}</label>
    <div class="row gutters-xs theme-switch-block">
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="dark" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='dark' ? 'checked' : '' }}>
                <span class="colorinput-color dark"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="blue" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='blue' ? 'checked' : '' }}>
                <span class="colorinput-color blue"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="purple" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='purple' ? 'checked' : '' }}>
                <span class="colorinput-color purple"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="light-blue" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='light-blue' ? 'checked' : '' }}>
                <span class="colorinput-color light-blue"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="green" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='green' ? 'checked' : '' }}>
                <span class="colorinput-color green"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="orange" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='orange' ? 'checked' : '' }}>
                <span class="colorinput-color orange"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="red" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='red' ? 'checked' : '' }}>
                <span class="colorinput-color red"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="white" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='white' ? 'checked' : '' }}>
                <span class="colorinput-color dark-arrow white"></span>
            </label>
        </div>
        
    </div>
    <div class="row gutters-xs theme-switch-block">
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="dark2" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='dark2' ? 'checked' : '' }}>
                <span class="colorinput-color dark2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="blue2" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='blue2' ? 'checked' : '' }}>
                <span class="colorinput-color blue2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="purple2" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='purple2' ? 'checked' : '' }}>
                <span class="colorinput-color purple2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="light-blue2" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='light-blue2' ? 'checked' : '' }}>
                <span class="colorinput-color light-blue2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="green2" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='green2' ? 'checked' : '' }}>
                <span class="colorinput-color green2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="orange2" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='orange2' ? 'checked' : '' }}>
                <span class="colorinput-color orange2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_navbar_header_color" type="radio" value="red2" class="colorinput-input changeTopBarColor" {{ setting('theme_navbar_header_color','blue2')=='red2' ? 'checked' : '' }}>
                <span class="colorinput-color red2"></span>
            </label>
        </div>
    </div>

</div>
<div class="form-group">
    <label class="form-label">{{ clean(trans('setting::settings.form.sidebar')) }}</label>
    <div class="row gutters-xs theme-switch-block">
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="dark" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='dark' ? 'checked' : '' }}>
                <span class="colorinput-color dark"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="blue" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='blue' ? 'checked' : '' }}>
                <span class="colorinput-color blue"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="purple" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='purple' ? 'checked' : '' }}>
                <span class="colorinput-color purple"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="light-blue" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='light-blue' ? 'checked' : '' }}>
                <span class="colorinput-color light-blue"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="green" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='green' ? 'checked' : '' }}>
                <span class="colorinput-color green"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="orange" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='orange' ? 'checked' : '' }}>
                <span class="colorinput-color orange"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="red" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='red' ? 'checked' : '' }}>
                <span class="colorinput-color red"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="white" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='white' ? 'checked' : '' }}>
                <span class="colorinput-color dark-arrow white"></span>
            </label>
        </div>
        
    </div>
    <div class="row gutters-xs theme-switch-block">
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="dark2" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='dark2' ? 'checked' : '' }}>
                <span class="colorinput-color dark2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="blue2" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='blue2' ? 'checked' : '' }}>
                <span class="colorinput-color blue2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="purple2" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='purple2' ? 'checked' : '' }}>
                <span class="colorinput-color purple2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="light-blue2" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='light-blue2' ? 'checked' : '' }}>
                <span class="colorinput-color light-blue2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="green2" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='green2' ? 'checked' : '' }}>
                <span class="colorinput-color green2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="orange2" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='orange2' ? 'checked' : '' }}>
                <span class="colorinput-color orange2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_sidebar_color" type="radio" value="red2" class="colorinput-input changeSideBarColor" {{ setting('theme_sidebar_color','white')=='red2' ? 'checked' : '' }}>
                <span class="colorinput-color red2"></span>
            </label>
        </div>
    </div>

</div>
<div class="form-group">
    <label class="form-label">{{ clean(trans('setting::settings.form.background')) }}</label>
    <div class="row gutters-xs theme-switch-block">
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_background_color" type="radio" value="bg1" class="colorinput-input changeBackgroundColor" {{ setting('theme_background_color','bg3')=='bg1' ? 'checked' : '' }}>
                <span class="colorinput-color dark-arrow bg1"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_background_color" type="radio" value="bg2" class="colorinput-input changeBackgroundColor" {{ setting('theme_background_color','bg3')=='bg2' ? 'checked' : '' }}>
                <span class="colorinput-color dark-arrow bg2"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_background_color" type="radio" value="bg3" class="colorinput-input changeBackgroundColor" {{ setting('theme_background_color','bg3')=='bg3' ? 'checked' : '' }}>
                <span class="colorinput-color dark-arrow bg3"></span>
            </label>
        </div>
        <div class="col-auto">
            <label class="colorinput">
                <input name="theme_background_color" type="radio" value="dark" class="colorinput-input changeBackgroundColor" {{ setting('theme_background_color','bg3')=='dark' ? 'checked' : '' }}>
                <span class="colorinput-color dark"></span>
            </label>
        </div>
        
    </div>
</div>