<div id="myac-hl" class="profile-icon dropdown pull-right" >
    <a class="btn dropdown-toggle" href="#" id="my-account-hl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        @auth
            @if(isset($currentUser->avatar->path))
                <img src="{{ $currentUser->avatar->path }}" alt="..." class="avatar-img rounded-circle">
            @else
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            @endif
        @else
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
        @endauth  
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="my-account-hl">
    @auth
        <li>
            <a href="{{ route('account.dashboard.index') }}">
            <i class="fa fa-home" aria-hidden="true"></i>
            {{ clean(trans('cynoebook::account.links.my_account')) }}</a>
        </li>
        <li>
            <a href="{{ route('user.profile.show',auth()->user()->username) }}">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            {{ clean(trans('cynoebook::account.links.my_profile')) }}</a>
        </li>
        <li>
            <a href="{{ route('account.favorite.index') }}">
                <i class="fa fa-heart" aria-hidden="true"></i>
                {{ clean(trans('cynoebook::account.links.my_favorite')) }}
            </a>
        </li>
        <li>
            <a href="{{ route('account.reviews.index') }}">
                <i class="fa fa-comment" aria-hidden="true"></i>
                {{ clean(trans('cynoebook::account.links.my_reviews')) }}
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                {{ clean(trans('cynoebook::account.links.logout')) }}
            </a>
        </li>
        
        @if(setting('enable_ebook_upload'))
        <li role="separator" class="divider"></li>
        <li>
            <a href="{{ route('ebooks.upload') }}">
            
            <i class="fa fa-upload" aria-hidden="true"></i>
            {{ clean(trans('cynoebook::account.links.upload_ebook')) }}
            </a>
        </li>
        @endif
        <li role="separator" class="divider"></li>
        @if(auth()->user()->hasRoleName('admin'))
            <li>
                <a href="{{ route('admin.dashboard.index') }}">
                
                <i class="fa fa-dashboard" aria-hidden="true"></i>
                {{ clean(trans('cynoebook::account.links.admin_dashboard')) }}
                </a>
            </li>
        @endif
    @else
        <li><a href="{{ route('login') }}">{{ clean(trans('user::auth.sign_in')) }}</a></li>
        @if(setting('enable_registrations'))
            <li><a href="{{ route('register') }}">{{ clean(trans('user::auth.sign_up')) }}</a></li>
        @endif
    @endauth
    </ul>
</div>
<div class="search-area pull-right">
    <form action="{{ route('ebooks.index') }}" method="GET" id="search-box-form">
        <div class="search-box hidden-sm hidden-xs">
            <input type="text" name="query" class="search-box-input" placeholder="{{ clean(trans('cynoebook::layout.search_for_ebooks')) }}" value="{{ request('query') }}">

            <div class="search-box-button">
                <button class="search-box-btn btn btn-primary" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>

                <select name="category" class="select search-box-select custom-select-black">
                    <option value="" selected>{{ clean(trans('cynoebook::layout.categories')) }}</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mobile-search visible-sm visible-xs">
            <div class="dropdown">
                <div class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>

                <div class="dropdown-menu">
                    <div class="search-box">
                        <input type="search" name="query" class="search-box-input" placeholder="{{ clean(trans('cynoebook::layout.search_for_ebooks')) }}">

                        <div class="search-box-button">
                            <button type="submit" class="search-box-btn btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
 
            