<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="our-author">
        <div class="picture">
            @if ( ! $user->avatar->exists)
                {{ Theme::image('public/images/default-user-image.png') }}    
           
            @else
                <img class="img-fluid" src="{{ $user->avatar->path }}">
            @endif
        </div>
        <div class="author-content">
            <h4 class="name"><a href="{{ route('user.profile.show', $user->username)}}" class="" aria-hidden="true">{{ $user->full_name }}</a></h4>
            <h5 class="total">
            ({{ clean(trans('user::users.joined')) }}  {{ is_null($user->created_at) ? '&mdash;' : $user->created_at->diffForHumans() }} )
            </h5>
            <h5 class="total">
            {{ intl_number($user->ebooks_count) }} {{ trans_choice('author::authors.books_found', $user->ebooks_count) }}
            
            </h5>
        </div>
        <ul class="social">
           
            @if ($user->facebook!='')
                <li><a href="{{ $user->facebook }}"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
            @endif
            @if ($user->twitter!='')
                <li><a href="{{ $user->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            @endif
            @if ($user->google!='')
                <li><a href="{{ $user->google }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            @endif
            @if ($user->instagram!='')
                <li><a href="{{ $user->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            @endif
            @if ($user->linkedin!='')
                <li><a href="{{ $user->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            @endif
            @if ($user->youtube!='')
                <li><a href="{{ $user->youtube }}"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
            @endif
             <li><a href="{{ route('user.profile.show', $user->username)}}" class="" aria-hidden="true">{{ clean(trans('author::authors.view_details')) }}</a></li>
        </ul>
    </div>
</div>
                        