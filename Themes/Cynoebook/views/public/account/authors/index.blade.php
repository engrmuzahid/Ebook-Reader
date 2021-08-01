@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_authors')))

@section('account_breadcrumb')
    <li class="active">{{ clean(trans('cynoebook::account.links.my_authors')) }}</li>
@endsection


@section('content_right')
    <div class="my-dashboard">
        <div class="account-information clearfix">
            <h4>{{ clean(trans('cynoebook::account.links.my_authors')) }}
            <div class="pull-right">
                    <a href="{{ route('account.authors.create') }}" class="label">
                    {{ clean(trans('cynoebook::account.authors.new_author')) }}
                    </a>
                </div>
                <div class="clearfix"></div>
            </h4>

            <div class="col-md-12">
                <div class="row">
                    <div class="index-table">
                        @if ($authors->isEmpty())
                            <h3 class="text-center">{{ clean(trans('cynoebook::account.ebooks.no_ebooks')) }}</h3>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ clean(trans('author::authors.table.image')) }}</th>
                                            <th>{{ clean(trans('author::authors.table.name')) }}</th>
                                            <th>{{ clean(trans('admin::admin.table.status')) }}</th>
                                            <th>{{ clean(trans('author::attributes.is_verified')) }}</th>
                                            <th>{{ clean(trans('admin::admin.table.created')) }}</th>
                                            <th>{{ clean(trans('cynoebook::account.ebooks.action')) }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($authors as $author)
                                            <tr>
                                                <td>
                                                    @if (! $author->author_image->exists)
                                                        <div class="image-placeholder">
                                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                        </div>
                                                    @else
                                                        <div class="image-holder">
                                                            <img src="{{ $author->author_image->path }}">
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($author->is_verified==1)
                                                        <a href="#">{{ $author->name }}</a>
                                                    @else
                                                        {{$author->name}}
                                                    @endif
                                                </td>
                                                

                                                <td>
                                                    @if($author->is_active==1)
                                                        <span class="dot green"></span>
                                                    @else
                                                        <span class="dot red"></span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($author->is_verified==1)
                                                        <span class="dot green"></span>
                                                    @else
                                                        <span class="dot red"></span>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $author->created_at->toFormattedDateString() }}</td>
                                                <td class="action">
                                                     <a class="" href="{{ route('account.authors.edit', ['id' => $author->id]) }}" data-toggle="tooltip" title="{{ clean(trans('cynoebook::account.authors.edit_author')) }}">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
    @if ($authors->isNotEmpty())
        <div class="pull-right">
            {!! $authors->links() !!}
        </div>
    @endif
@endsection
