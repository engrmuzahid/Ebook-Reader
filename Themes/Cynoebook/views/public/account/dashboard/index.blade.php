@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_ebook')))

@section('content_right')
    <div class="my-dashboard">
        <div class="account-information clearfix">
            <h4>{{ clean(trans('cynoebook::account.dashboard.my_ebook')) }}</h4>

            <div class="col-md-12">
                <div class="row">
                    <div class="index-table">
                        @if ($ebooks->isEmpty())
                            <h3 class="text-center">{{ clean(trans('cynoebook::account.ebooks.no_ebooks')) }}</h3>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ clean(trans('cynoebook::account.ebooks.book_cover')) }}</th>
                                            <th width="200px">{{ clean(trans('cynoebook::account.ebooks.ebook')) }}</th>
                                            <th>{{ clean(trans('cynoebook::account.ebooks.featured')) }}</th>
                                            <th>{{ clean(trans('cynoebook::account.ebooks.private')) }}</th>
                                            <th>{{ clean(trans('cynoebook::account.ebooks.views')) }}</th>
                                            <th>{{ clean(trans('cynoebook::account.ebooks.status')) }}</th>
                                            <th>{{ clean(trans('cynoebook::account.ebooks.date')) }}</th>
                                            <th>{{ clean(trans('cynoebook::account.ebooks.action')) }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
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
                                                    @if($ebook->is_active==1)
                                                        <a href="{{ route('ebooks.show', ['slug' => $ebook->slug]) }}">{{ $ebook->title }}</a>
                                                    @else
                                                        {{$ebook->title}}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($ebook->is_featured==1)
                                                        {{ clean(trans('cynoebook::account.ebooks.yes')) }}
                                                    @else
                                                        {{ clean(trans('cynoebook::account.ebooks.no')) }}
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    @if($ebook->is_private==1)
                                                        {{ clean(trans('cynoebook::account.ebooks.yes')) }}
                                                    @else
                                                        {{ clean(trans('cynoebook::account.ebooks.no')) }}
                                                    @endif
                                                </td>

                                                <td>{{ $ebook->viewed }}</td>
                                                
                                                <td>
                                                    @if($ebook->is_active==1)
                                                        <span class="dot green"></span>
                                                    @else
                                                        <span class="dot red"></span>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $ebook->created_at->toFormattedDateString() }}</td>
                                                <td class="action">
                                                    <a class="" href="{{ route('ebooks.edit', ['slug' => $ebook->slug]) }}" data-toggle="tooltip" title="{{ clean(trans('cynoebook::account.ebooks.edit_ebook')) }}">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="" onclick="return confirm('{{ clean(trans('cynoebook::account.ebooks.delete_confirm_message')) }}')" href="{{ route('ebooks.delete', ['slug' => $ebook->slug]) }}" data-toggle="tooltip" title="{{ clean(trans('cynoebook::account.ebooks.delete_ebook')) }}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @if ($ebooks->isNotEmpty())
        <div class="pull-right">
            {!! $ebooks->links() !!}
        </div>
    @endif
@endsection
