<div class="top-nav">
    <div class="container">
        <div class="top-nav-wrapper clearfix">
            <div class="top-nav-left pull-left">
                @if (count(supported_locales()) > 1)
                <div class="dropdown supported_locales">
                    @php
                        $options='';
                        
                        $languageName='';
                        foreach (supported_locales() as $locale => $language) {
                            $class='';
                            if(locale() === $locale){
                                $class='active';  
                                $languageName=$language["name"];
                            }
                            $options.='<li class="'.$class.'"><a href="'.localized_url($locale).'" >'.$language["name"].'</a></li>';
                        }
                    @endphp
                    
                    <a class="btn dropdown-toggle" href="#" id="supported_locales" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-language" aria-hidden="true"></i>
                        {{ $languageName }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="supported_locales">
                    {!! $options !!}
                    </ul>
                </div>
                @endif
            </div>

            <div class="top-nav-right pull-right">
                
                <ul class="social-links list-inline">
                    @if ($socialLinks->isNotEmpty())
                        @foreach ($socialLinks as $icon => $link)
                            @if (! is_null($link))
                                <li><a href="{{ $link }}"><i class="fa fa-{{ $icon }}" aria-hidden="true"></i></a></li>
                            @endif
                        @endforeach
                    @endif
                    
                    
                    @auth
                        <li><a href="{{ route('user.profile.show',auth()->user()->username) }}">{{ clean(trans('cynoebook::layout.hello')) }}, {{ auth()->user()->first_name }}!</a></li>
                    @else
                        <li><a href="{{ route('login') }}">{{ clean(trans('user::auth.sign_in')) }}</a></li>
                        @if(setting('enable_registrations'))
                            <li><a href="{{ route('register') }}">{{ clean(trans('user::auth.sign_up')) }}</a></li>
                        @endif
                    @endauth
                </ul>
                
                
            </div>
        </div>
    </div>
</div>
