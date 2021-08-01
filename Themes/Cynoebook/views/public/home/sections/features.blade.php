@if ($features->isNotEmpty())
    <section class="features-wrapper clearfix">
        @each('public.home.sections.partials.feature', $features, 'feature')
    </section>
@endif
