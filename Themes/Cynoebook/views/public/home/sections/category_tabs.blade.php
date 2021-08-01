<section class="category-tab clearfix">
    <div class="section-header clearfix">
        <h3 class="pull-left">{{ setting('cynoebook_category_tabs_section_title') }}</h3>

        <ul class="nav nav-tabs pull-right">
            @if ($categoryTabEbook['tab_1']->isNotEmpty())
                <li class="active">
                    <a data-toggle="tab" href="#tab-1">{{ setting('cynoebook_category_tabs_section_tab_1_title') }}</a>
                </li>
            @endif

            @if ($categoryTabEbook['tab_2']->isNotEmpty())
                <li>
                    <a data-toggle="tab" href="#tab-2">{{ setting('cynoebook_category_tabs_section_tab_2_title') }}</a>
                </li>
            @endif

            @if ($categoryTabEbook['tab_3']->isNotEmpty())
                <li>
                    <a data-toggle="tab" href="#tab-3">{{ setting('cynoebook_category_tabs_section_tab_3_title') }}</a>
                </li>
            @endif

            @if ($categoryTabEbook['tab_4']->isNotEmpty())
                <li>
                    <a data-toggle="tab" href="#tab-4">{{ setting('cynoebook_category_tabs_section_tab_4_title') }}</a>
                </li>
            @endif
            @if ($categoryTabEbook['tab_5']->isNotEmpty())
                <li>
                    <a data-toggle="tab" href="#tab-5">{{ setting('cynoebook_category_tabs_section_tab_5_title') }}</a>
                </li>
            @endif
        </ul>
    </div>

    <div class="row">
        <div class="tab-content">
            @if ($categoryTabEbook['tab_1']->isNotEmpty())
                <div id="tab-1" class="tab-pane fade in active">
                    <div class="tab-ebook-slider separator clearfix">
                        @foreach ($categoryTabEbook['tab_1'] as $ebook)
                            <div class="col-md-3">
                            @include('public.ebooks.partials.ebook_card')
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($categoryTabEbook['tab_2']->isNotEmpty())
                <div id="tab-2" class="tab-pane fade in">
                    <div class="tab-ebook-slider separator clearfix">
                        @foreach ($categoryTabEbook['tab_2'] as $ebook)
                            <div class="col-md-3">
                            @include('public.ebooks.partials.ebook_card')
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($categoryTabEbook['tab_3']->isNotEmpty())
                <div id="tab-3" class="tab-pane fade in">
                    <div class="tab-ebook-slider separator clearfix">
                        @foreach ($categoryTabEbook['tab_3'] as $ebook)
                            <div class="col-md-3">
                            @include('public.ebooks.partials.ebook_card')
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($categoryTabEbook['tab_4']->isNotEmpty())
                <div id="tab-4" class="tab-pane fade in">
                    <div class="tab-ebook-slider separator clearfix">
                        @foreach ($categoryTabEbook['tab_4'] as $ebook)
                            <div class="col-md-3">
                            @include('public.ebooks.partials.ebook_card')
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            @if ($categoryTabEbook['tab_5']->isNotEmpty())
                <div id="tab-5" class="tab-pane fade in">
                    <div class="tab-ebook-slider separator clearfix">
                        @foreach ($categoryTabEbook['tab_5'] as $ebook)
                            <div class="col-md-3">
                            @include('public.ebooks.partials.ebook_card')
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
