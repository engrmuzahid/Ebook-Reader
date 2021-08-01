<footer class="footer">
    <div class="container">
        <div class="footer-top p-tb-50 clearfix">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('home') }}" class="footer-logo">
                        @if (is_null($footerLogo))
                            <h2>{{ setting('site_name') }}</h2>
                        @else
                            <img src="{{ $footerLogo }}" class="img-responsive" alt="footer-logo">
                        @endif
                    </a>

                    <div class="clearfix"></div>

                    <p class="footer-brief">{{ setting('cynoebook_footer_summary') }}</p>

                </div>
                <div class="col-sm-4 col-md-3 footer-two">
                    <h4 class="title">{{ setting('cynoebook_footer_two_title') }}</h4>
                    {!! setting('cynoebook_footer_two') !!}
                    
                </div>

                @if ($footerMenu1->isNotEmpty())
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="links">
                            
                            <h4 class="title">{{ setting('cynoebook_footer_menu_title_1') }}</h4>
                            

                            <ul class="list-inline">
                                @foreach ($footerMenu1 as $menuItem)
                                    <li><a href="{{ $menuItem->url() }}">{{ $menuItem->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if ($footerMenu2->isNotEmpty())
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="links">
                            <h4 class="title">{{ setting('cynoebook_footer_menu_title_2') }}</h4>
                            

                            <ul class="list-inline">
                                @foreach ($footerMenu2 as $menuItem)
                                    <li><a href="{{ $menuItem->url() }}">{{ $menuItem->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>

    </div>

    <div class="footer-bottom p-tb-20 clearfix">
        <div class="container">
            <div class="copyright text-center">
                {{ $copyrightText }}
            </div>
        </div>
    </div>
</footer>
