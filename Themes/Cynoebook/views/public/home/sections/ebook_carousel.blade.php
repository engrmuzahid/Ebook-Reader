@if ($ebooks->isNotEmpty())
    <section class="ebook-slider-wrapper clearfix">
        <div class="section-header">
            <h3>{{ $title }}</h3>
        </div>

        <div class="row">
            <div class="ebook-slider slick-arrow separator clearfix">
                @foreach ($ebooks as $ebook)
                    <div class="col-md-3">
                        @include('public.ebooks.partials.ebook_card')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
