@if ($topAuthors->isNotEmpty())
    <section class="section-wrapper clearfix">
        <div class="section-header">
            <h3>{{ setting('cynoebook_authors_section_title') }}</h3>
        </div>

        <div class="top-authos m-t-20">
            <div class="row">
                @each('public.authors.author_card', $topAuthors, 'author')
            </div>
        </div>
    </section>
@endif
