@extends('public.account.layout')

@section('title')
        {{ clean(trans('cynoebook::ebook.upload_Ebook')) }}
@endsection

@section('breadcrumb')
    <li class="active">{{ clean(trans('cynoebook::ebook.upload_Ebook')) }}</li>
@endsection

@section('content_right')
   
    <section class="ebook-list">
        <div class="account-details">
            <div class="account clearfix">
                <h4>{{ clean(trans('cynoebook::ebook.upload_Ebook'))}}</h4>
                    <form method="POST" action="{{ route('ebooks.create') }}" class="form-horizontal" id="ebook-create-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-inner clearfix">
                            
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-6 col-sm-12">
                                    {{ Form::text('title', clean(trans('ebook::attributes.title')), $errors,'', [ 'required' => true,'labelCol'=>12]) }}
                                    
                                    {{ Form::select('categories', clean(trans('ebook::attributes.categories')), $errors, $categories, '', ['class' => 'selectize prevent-creation', 'multiple' => true,'required' => true,'labelCol'=>12]) }}
                                    
                                    {{ Form::select('authors', clean(trans('ebook::attributes.authors')), $errors, $authors, '', ['required' => true,'multiple' => true,'class'=>'select2 csselect2','data-tags'=>"true",'help'=>clean(trans('ebook::ebooks.form.author_add_help_text')),'labelCol'=>12]) }}
                                    
                                    {{ Form::text('publisher', clean(trans('ebook::attributes.publisher')), $errors, '', ['labelCol'=>12]) }}
                                    
                                    {{ Form::text('publication_year', clean(trans('ebook::attributes.publication_year')), $errors, '', ['labelCol'=>12]) }}
                                    
                                    {{ Form::text('password_protected', clean(trans('ebook::attributes.password')), $errors, '', ['labelCol'=>12]) }}
                                    
                                    {{ Form::text('price', clean(trans('ebook::attributes.price')), $errors, '', ['labelCol'=>12]) }}
                                    
                                    {{ Form::text('buy_url', clean(trans('ebook::attributes.buy_url')), $errors, '', ['labelCol'=>12]) }}
                                    
                                    {{ Form::text('isbn', clean(trans('ebook::attributes.isbn_number')), $errors, '', ['labelCol'=>12]) }}
                                   
                                    
                                    {{ Form::checkbox('is_private', clean(trans('ebook::attributes.is_private')), clean(trans('ebook::ebooks.form.private_the_ebook')), $errors, '',['labelCol'=>12]) }}
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    {{ Form::textarea('description', clean(trans('ebook::attributes.description')), $errors,'', ['required' => true,'rows' => 12,'labelCol'=>12]) }}

                                    {{ Form::textarea('short_description', clean(trans('ebook::attributes.short_description')), $errors, '', ['rows' => 4,'labelCol'=>12]) }}
                                    
                                    {{ Form::file('book_cover',clean(trans('ebook::ebooks.form.book_cover')), $errors,'' ,[ 'required' => true,'labelCol'=>12]) }}
                                    
                                    {{ Form::select('file_type', clean(trans('ebook::attributes.file_type')), $errors, clean(trans('ebook::ebooks.form.file_type')), '', ['required' => true,'labelCol'=>12]) }}
                                    
                                    
                                    <div class="link-field external_link-field {{ old('file_type') !== 'external_link' ? 'hide' :'' }}">
                                        {{ Form::text('file_url', trans('ebook::ebooks.form.book_file'), $errors, '', ['required' => true,'help'=>trans('ebook::ebooks.form.enter_file_url_or_upload_new'),'labelCol'=>12]) }}
                                    </div>

                                    <div class="link-field embed_code-field {{ old('file_type') !== 'embed_code' ? 'hide' :'' }}" >
                                       {{ Form::textarea('embed_code', clean(trans('ebook::ebooks.form.embed_code')), $errors, '', ['rows' => 2,'required' => true,'labelCol'=>12,'help'=> clean(trans('ebook::ebooks.form.embed_code_help_text'))]) }}

                                    </div>

                                    <div class="link-field upload-field {{ old('file_type','upload') !== 'upload' ? 'hide' :'' }}">
                                        @php
                                            $allowedFileTypes=get_allowed_file_types();
                                            $allowedFileTypes=implode (",", $allowedFileTypes);
                                            $helpText='Only '.$allowedFileTypes.' files are allowed';
                                        @endphp
                                        {{ Form::file('book_file',trans('ebook::ebooks.form.book_file'), $errors, '',[ 'required' => true,'help'=>$helpText,'labelCol'=>12]) }}
                                    </div>
                                    <div class="link-field audio-field {{ old('file_type') !== 'audio' ? 'hide' :'' }}">
                                        @php
                                            $allowedFileTypes=get_allowed_file_types('audio');
                                            $allowedFileTypes=implode (",", $allowedFileTypes);
                                            
                                            $helpText='Only '.$allowedFileTypes.' files are allowed';
                                        @endphp
                                        {{ Form::file('audio_book_files',trans('ebook::ebooks.form.audio_book_files'), $errors, '',[ 'required' => true,'help'=>$helpText,'labelCol'=>12,'multiple'=>'multiple']) }}
                                        @if($errors->has('audio_book_files.*'))
                                        <div class="has-error">    
                                        <span class="help-block">
                                            <strong>{{$errors->first('audio_book_files.*')}}</strong>
                                        </span>
                                        </div>
                                    @endif
                                    </div>
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
    </section>
    
    
@endsection
@push('scripts')
    <style>
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
@push('scripts')
    <script>
    (function () {
        "use strict";
            $('#file_type').on('change', (e) => {
                $('.link-field').addClass('hide');
                $(`.${e.currentTarget.value}-field`).removeClass('hide');
            });
    })();
    </script>
@endpush
