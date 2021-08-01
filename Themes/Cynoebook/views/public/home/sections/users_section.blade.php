@if ($topUsers->isNotEmpty())
    <section class="section-wrapper clearfix">
        <div class="section-header">
            <h3>{{ setting('cynoebook_users_section_title') }}</h3>
        </div>

        <div class="top-users m-t-20">
            <div class="row">
                @each('public.users.user_card', $topUsers, 'user')
            </div>
        </div>
    </section>
@endif
