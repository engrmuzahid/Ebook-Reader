@extends('public.account.layout')

@section('title')
        {{ clean(trans('cynoebook::ebook.edit_Ebook')) }}
@endsection

@section('breadcrumb')
    <li><a href="{{ route('account.dashboard.index') }}">{{ clean(trans('cynoebook::account.links.my_ebook')) }}</a></li>
    <li class="active">{{ clean(trans('cynoebook::ebook.edit_Ebook')) }} - {{ $ebook->title }}</li>
@endsection

@section('content_right')
    
    <section class="ebook-list">
        <div class="account-details">
            <div class="account clearfix">
                <h4>{{ clean(trans('cynoebook::ebook.edit_Ebook'))}}</h4>
                <form method="POST" action="{{ route('ebooks.update', $ebook) }}" class="form-horizontal" id="ebook-create-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="form-inner clearfix"> 
                        
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-6 col-sm-12">
                                {{ Form::text('title', clean(trans('ebook::attributes.title')), $errors,$ebook, [ 'required' => true,'labelCol'=>12]) }}
                                
                                {{ Form::select('categories', clean(trans('ebook::attributes.categories')), $errors, $categories, $ebook, ['class' => 'selectize prevent-creation', 'multiple' => true,'required' => true,'labelCol'=>12]) }}
                                
                                {{ Form::select('authors', clean(trans('ebook::attributes.authors')), $errors, $authors, $ebook, ['required' => true,'multiple' => true,'class'=>'select2 csselect2','data-tags'=>"true",'help'=>clean(trans('ebook::ebooks.form.author_add_help_text')),'labelCol'=>12]) }}
                                
                                {{ Form::text('publisher', clean(trans('ebook::attributes.publisher')), $errors, $ebook, ['labelCol'=>12]) }}
                                
                                {{ Form::text('publication_year', clean(trans('ebook::attributes.publication_year')), $errors, $ebook, ['labelCol'=>12]) }}
                                
                                {{ Form::text('password_protected', clean(trans('ebook::attributes.password')), $errors,$ebook , ['labelCol'=>12]) }}
                                
                                {{ Form::text('price', clean(trans('ebook::attributes.price')), $errors, $ebook, ['labelCol'=>12]) }}
                                
                                {{ Form::text('buy_url', clean(trans('ebook::attributes.buy_url')), $errors, $ebook, ['labelCol'=>12]) }}
                                
                                {{ Form::text('isbn', clean(trans('ebook::attributes.isbn_number')), $errors, $ebook, ['labelCol'=>12]) }}
                                
                                {{ Form::checkbox('is_private', clean(trans('ebook::attributes.is_private')), clean(trans('ebook::ebooks.form.private_the_ebook')), $errors, $ebook,['class' =>  $ebook->is_private ? 'checked' : '','labelCol'=>12]) }}
                                
                                
                            </div>
                            <div class="col-md-6 col-sm-12">
                                {{ Form::textarea('description', clean(trans('ebook::attributes.description')), $errors,$ebook, ['required' => true,'rows' => 12,'labelCol'=>12]) }}

                                {{ Form::textarea('short_description', clean(trans('ebook::attributes.short_description')), $errors, $ebook, ['rows' => 4,'labelCol'=>12]) }}
                                
                                {{ Form::file('book_cover',clean(trans('ebook::ebooks.form.book_cover')), $errors,'', ['labelCol'=>12]) }}
                                
                                {{ Form::select('file_type', clean(trans('ebook::attributes.file_type')), $errors, clean(trans('ebook::ebooks.form.file_type')), $ebook, ['required' => true,'labelCol'=>12]) }}
                                    
                                    
                                <div class="link-field external_link-field {{ old('file_type',$ebook->file_type) !== 'external_link' ? 'hide' :'' }}">
                                    {{ Form::text('file_url', trans('ebook::ebooks.form.book_file'), $errors,  $ebook, ['required' => true,'help'=>trans('ebook::ebooks.form.enter_file_url_or_upload_new'),'labelCol'=>12]) }}
                                </div>

                                <div class="link-field embed_code-field {{ old('file_type',$ebook->file_type) !== 'embed_code' ? 'hide' :'' }}" >
                                   {{ Form::textarea('embed_code', clean(trans('ebook::ebooks.form.embed_code')), $errors,  $ebook, ['rows' => 2,'required' => true,'labelCol'=>12,'help'=> clean(trans('ebook::ebooks.form.embed_code_help_text'))]) }}

                                </div>

                                <div class="link-field upload-field {{ old('file_type',$ebook->file_type ?? 'upload') !== 'upload' ? 'hide' :'' }}">
                                    @php
                                        $allowedFileTypes=get_allowed_file_types();
                                        $allowedFileTypes=implode (",", $allowedFileTypes);
                                        $helpText='Only '.$allowedFileTypes.' files are allowed';
                                    @endphp
                                    {{ Form::file('book_file',trans('ebook::ebooks.form.book_file'), $errors,  $ebook,[ 'help'=>$helpText,'labelCol'=>12]) }}
                                </div>
                                <div class="link-field audio-field {{ old('file_type',$ebook->file_type ) !== 'audio' ? 'hide' :'' }}">
                                        @php
                                            $allowedFileTypes=get_allowed_file_types('audio');
                                            $allowedFileTypes=implode (",", $allowedFileTypes);
                                            
                                            $helpText='Only '.$allowedFileTypes.' files are allowed';
                                        @endphp
                                        {{ Form::file('audio_book_files',trans('ebook::ebooks.form.audio_book_files'), $errors, $ebook,['help'=>$helpText,'labelCol'=>12,'multiple'=>'multiple']) }}
                                        @if($errors->has('audio_book_files.*'))
                                        <div class="has-error">    
                                        <span class="help-block">
                                            <strong>{{$errors->first('audio_book_files.*')}}</strong>
                                        </span>
                                        </div>
                                    @endif
                                    </div>
                                
                                
                                <div class="form-group row ">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        @if (! $ebook->book_cover->exists)
                                            <div class="image-placeholder">
                                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            </div>
                                        @else
                                            <div class="image-placeholder">
                                                <img src="{{ $ebook->book_cover->path }}" width="100%" style="max-width: 100px;">
                                            </div>
                                        @endif
                                        
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        @if ($ebook->book_file->exists)
                                        <div class="link-field upload-field {{ old('file_type',$ebook->file_type) !== 'upload' ? 'hide' :'' }}">    
                                            <input type="hidden" name="ftypeuou" value="1">
                                            <div class="image-placeholder">
                                                <a type="button" class="btn btn-info btn-sm" href="{{ route('ebooks.download',[$ebook->slug,id_encode($ebook->book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="fa fa-download" aria-hidden="true" ></i> {{$ebook->book_file->filename}}</a>
                                            </div>
                                            </div>
                                        @endif
                                        @if ($ebook->audio_book_files->isNotEmpty())
                                            <div class="link-field audio-field {{ old('file_type',$ebook->file_type ?? 'audio') !== 'audio' ? 'hide' :'' }}">
                                            <input type="hidden" name="ftypeuou1" value="1">
                                            @foreach($ebook->audio_book_files as $afile)
                                            <div class="image-placeholder">
                                                <a type="button" class="btn btn-info btn-sm" href="{{ route('ebooks.download',[$ebook->slug,id_encode($afile->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="fa fa-download" aria-hidden="true" ></i> {{$afile->filename}}</a>
                                            </div>
                                            @endforeach
                                            </div>
                                        @endif
                                        
                                    </div>
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

