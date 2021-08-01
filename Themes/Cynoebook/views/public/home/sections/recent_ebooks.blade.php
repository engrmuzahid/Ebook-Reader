@if ($recentEbooks->isNotEmpty())
    <section class="section-wrapper clearfix">
        <div class="section-header">
            <h3>{{ setting('cynoebook_recent_ebooks_section_title') }}</h3>
        </div>

        <div class="recent-ebooks">
            <div class="row">
                <div class="grid-ebooks separator">
                    @each('public.ebooks.partials.ebook_card', $recentEbooks, 'ebook')
                </div>
            </div>
        </div>
    </section>
@endif
