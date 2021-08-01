@extends('public.layout')

@section('title')
        {{ clean(trans('cynoebook::ebook.upload_Ebook')) }}
@endsection

@section('breadcrumb')
    <li class="active">{{ clean(trans('cynoebook::ebook.upload_Ebook')) }}</li>
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
                    <form method="POST" action="{{ route('ebooks.create') }}" class="form-horizontal" id="ebook-create-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-inner clearfix">
                            <h3>{{ clean(trans('cynoebook::ebook.upload_Ebook')) }}</h3>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-6">
                                    {{ Form::text('title', clean(trans('ebook::attributes.title')), $errors,'', [ 'required' => true]) }}
                                    
                                    {{ Form::select('categories', clean(trans('ebook::attributes.categories')), $errors, $categories, '', ['class' => 'selectize prevent-creation', 'multiple' => true,'required' => true,]) }}
                                    
                                    {{ Form::select('authors', clean(trans('ebook::attributes.authors')), $errors, $authors, '', ['required' => true,'multiple' => true,'class'=>'select2 csselect2','data-tags'=>"true",'help'=>clean(trans('ebook::ebooks.form.author_add_help_text'))]) }}
                                    
                                    {{ Form::text('publisher', clean(trans('ebook::attributes.publisher')), $errors, '', []) }}
                                    
                                    {{ Form::text('publication_year', clean(trans('ebook::attributes.publication_year')), $errors, '', []) }}
                                    
                                    {{ Form::text('password_protected', clean(trans('ebook::attributes.password')), $errors, '', []) }}
                                    
                                    {{ Form::text('price', clean(trans('ebook::attributes.price')), $errors, '', []) }}
                                    
                                    {{ Form::text('buy_url', clean(trans('ebook::attributes.buy_url')), $errors, '', []) }}
                                    
                                    {{ Form::text('isbn', clean(trans('ebook::attributes.isbn_number')), $errors, '', []) }}
                                   
                                    
                                    {{ Form::checkbox('is_private', clean(trans('ebook::attributes.is_private')), clean(trans('ebook::ebooks.form.private_the_ebook')), $errors, '') }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::textarea('description', clean(trans('ebook::attributes.description')), $errors,'', ['required' => true,'rows' => 12]) }}

                                    {{ Form::textarea('short_description', clean(trans('ebook::attributes.short_description')), $errors, '', ['rows' => 4]) }}
                                    
                                    {{ Form::file('book_cover',clean(trans('ebook::ebooks.form.book_cover')), $errors,'' ,[ 'required' => true]) }}
                                    
                                    {{ Form::text('file_url', trans('ebook::ebooks.form.book_file'), $errors, '', ['help'=>trans('ebook::ebooks.form.enter_file_url_or_upload_new')]) }}
                                    
                                    {{ Form::file('book_file','', $errors, '',[ 'required' => true,'help'=>'Only pdf, epub, doc, docx, txt, xls, xlsx, ppt, pptx, files are allowed']) }}
                                </div>
                            </div>
                            @if(!auth()->user())
                            <div class="col-md-12 col-sm-12">
                                <br>
                                <div class="ebook-list-header clearfix">
                                    <div class="search-result-title pull-left">
                                        <h3>{{ clean(trans('cynoebook::ebook.user_detail')) }}</h3>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-6">
                                    {{ Form::text('first_name', clean(trans('user::auth.first_name')), $errors,'', [ 'required' => true]) }}
                                    
                                    {{ Form::text('username', clean(trans('user::auth.username')), $errors,'', [ 'required' => true]) }}
                                    
                                    {{ Form::password('password', clean(trans('user::auth.password')), $errors,'', [ 'required' => true]) }}
                                    
                                </div>        
                                <div class="col-md-6">
                                    {{ Form::text('last_name', clean(trans('user::auth.last_name')), $errors,'', [ 'required' => true]) }}
                                    
                                    {{ Form::email('email', clean(trans('user::auth.email')), $errors,'', [ 'required' => true]) }}
                                </div>
                            </div>
                            @endif
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
