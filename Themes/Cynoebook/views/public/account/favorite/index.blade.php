@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_favorite')))

@section('account_breadcrumb')
    <li class="active">{{ clean(trans('cynoebook::account.links.my_favorite')) }}</li>
@endsection

@section('content_right')
    <div class="index-table">
        
        @if ($ebooks->isEmpty())
            <h3 class="text-center">{{ clean(trans('cynoebook::account.favorite.empty_favorite')) }}</h3>
        @else
            <div class=" table-favorite">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ clean(trans('cynoebook::account.favorite.book_cover')) }}</th>
                            <th>{{ clean(trans('cynoebook::account.favorite.ebook')) }}</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody> <?php //dd($ebooks); ?>
                        @foreach ($ebooks as $ebook)
                            <tr>
                                <td>
                                    @if (! $ebook->book_cover->exists)
                                        <div class="image-placeholder">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                        </div>
                                    @else
                                        <div class="image-holder">
                                            <img src="{{ $ebook->book_cover->path }}">
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <h5>
                                        <a href="{{ route('ebooks.show', ['slug' => $ebook->slug]) }}">
                                            {{ $ebook->title }}
                                        </a>
                                    </h5>
                                </td>

                                <td>
                                    <form method="POST" action="{{ route('account.favorite.destroy', $ebook) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}

                                        <button type="submit" class="cross-button remove-ebook" data-toggle="tooltip" title="{{ clean(trans('cynoebook::account.favorite.remove')) }}">
                                            <i class="fa fa-times" aria-hidden="true" data-ebook-id="{{ $ebook->id }}"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if ($ebooks->isNotEmpty())
        <div class="pull-right">
            {!! $ebooks->links() !!}
        </div>
    @endif
@endsection
