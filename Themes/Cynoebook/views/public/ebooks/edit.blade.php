@extends('public.layout')

@section('title')
        {{ clean(trans('cynoebook::ebook.edit_Ebook')) }}
@endsection

@section('breadcrumb')
    <li><a href="{{ route('account.dashboard.index') }}">{{ clean(trans('cynoebook::account.links.my_ebook')) }}</a></li>
    <li class="active">{{ clean(trans('cynoebook::ebook.edit_Ebook')) }} - {{ $ebook->title }}</li>
@endsection

@section('content')
    @if (setting('cynoebook_ad1_section_enabled'))
       @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_1')])
    @endif 
    <section class="ebook-list">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form form-page no-lp-form-control form-overlay-layer">
                    <div class="top-overlay"></div>
                    <form method="POST" action="{{ route('ebooks.update', $ebook) }}" class="form-horizontal" id="ebook-create-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        
                    
                        <div class="form-inner clearfix"> 
                            <h3>{{ clean(trans('cynoebook::ebook.edit_Ebook')) }}</h3>
                            <div class="col-md-2 col-sm-2">
                                @if (! $ebook->book_cover->exists)
                                    <div class="image-placeholder">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                    </div>
                                @else
                                    <div class="image-placeholder">
                                        <img src="{{ $ebook->book_cover->path }}" width="100%">
                                    </div>
                                @endif
                                <hr>
                                @if ($ebook->book_file->exists)
                                    <div class="image-placeholder">
                                        <a type="button" class="btn btn-info btn-sm" href="{{ route('ebooks.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="fa fa-download" aria-hidden="true" ></i> {{$ebook->book_file->filename}}</a>
                                    </div>
                                    <hr>
                                @endif
                            
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div class="col-md-6">
                                    {{ Form::text('title', clean(trans('ebook::attributes.title')), $errors,$ebook, [ 'required' => true]) }}
                                    
                                    {{ Form::select('categories', clean(trans('ebook::attributes.categories')), $errors, $categories, $ebook, ['class' => 'selectize prevent-creation', 'multiple' => true,'required' => true,]) }}
                                    
                                    {{ Form::select('authors', clean(trans('ebook::attributes.authors')), $errors, $authors, $ebook, ['required' => true,'multiple' => true,'class'=>'select2 csselect2','data-tags'=>"true",'help'=>clean(trans('ebook::ebooks.form.author_add_help_text'))]) }}
                                    
                                    {{ Form::text('publisher', clean(trans('ebook::attributes.publisher')), $errors, $ebook, []) }}
                                    
                                    {{ Form::text('publication_year', clean(trans('ebook::attributes.publication_year')), $errors, $ebook, []) }}
                                    
                                    {{ Form::text('password_protected', clean(trans('ebook::attributes.password')), $errors,$ebook , []) }}
                                    
                                    {{ Form::text('price', clean(trans('ebook::attributes.price')), $errors, $ebook, []) }}
                                    
                                    {{ Form::text('buy_url', clean(trans('ebook::attributes.buy_url')), $errors, $ebook, []) }}
                                    
                                    {{ Form::text('isbn', clean(trans('ebook::attributes.isbn_number')), $errors, $ebook, []) }}
                                    
                                    {{ Form::checkbox('is_private', clean(trans('ebook::attributes.is_private')), clean(trans('ebook::ebooks.form.private_the_ebook')), $errors, $ebook,['class' =>  $ebook->is_private ? 'checked' : '']) }}
                                    
                                    
                                </div>
                                <div class="col-md-6">
                                    {{ Form::textarea('description', clean(trans('ebook::attributes.description')), $errors,$ebook, ['required' => true,'rows' => 12]) }}

                                    {{ Form::textarea('short_description', clean(trans('ebook::attributes.short_description')), $errors, $ebook, ['rows' => 4]) }}
                                    
                                    {{ Form::file('book_cover',clean(trans('ebook::ebooks.form.book_cover')), $errors,'' ) }}
                                    
                                    {{ Form::text('file_url', trans('ebook::ebooks.form.book_file'), $errors, $ebook, ['help'=>trans('ebook::ebooks.form.enter_file_url_or_upload_new')]) }}
                                    
                                    {{ Form::file('book_file','', $errors, '',['help'=>'Only pdf, epub, doc, docx, txt, xls, xlsx, ppt, pptx, files are allowed']) }}
                                    
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary" data-loading>
                                    {{ clean(trans('cynoebook::ebook.upload_Ebook')) }}
                                    </button>
                                </div>
                            </div>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @if (setting('cynoebook_ad2_section_enabled'))
       @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_2')])
    @endif 
    <Style>
        .selectize-control.form-control {
            border: 0;
            padding: 0 !important;
            height: auto;
        }
        .selectize-dropdown.form-control
        {
            height: auto;
        }
    </style>
@endsection
@push('scripts')
    <script>
        $('.csselect2').select2({
            createTag: function(newTag) {
               return {
                   id: 'new:' + newTag.term,
                   text: newTag.term + ' (new)'
               };
           }
            
        });
    </script>
@endpush
