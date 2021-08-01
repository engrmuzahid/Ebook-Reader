@extends('public.layout')

@section('title', clean(trans('cynoebook::contact.contact')))

@section('breadcrumb')
    <li class="active">{{ clean(trans('cynoebook::contact.contact')) }}</li>
@endsection

@section('content')
    <section class="contact-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form form-page form-overlay-layer no-lp-form-control">
                            <div class="top-overlay"></div>
                            
                                <form method="POST" action="{{ route('contact.store') }}" class="clearfix">
                                    
                                    @csrf
                                    <div class="form-inner clearfix">
                                    
                                        <h3>{{ clean(trans('cynoebook::contact.send_us_a_message')) }}</h3>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                                                <label for="first_name">{{ clean(trans('contact::attributes.first_name')) }}<span>*</span></label>
                                                <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}">

                                                @if($errors->has('first_name'))
                                                    <span class="error-message">{{ clean($errors->first('first_name')) }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                                <label for="email">{{ clean(trans('contact::attributes.email')) }}<span>*</span></label>
                                                <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}">

                                                @if($errors->has('email'))
                                                    <span class="error-message">{{ clean($errors->first('email')) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                                                <label for="last_name">{{ clean(trans('contact::attributes.last_name')) }}<span>*</span></label>
                                                <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}">

                                                @if($errors->has('last_name'))
                                                    <span class="error-message">{{ clean($errors->first('last_name')) }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('subject') ? 'has-error': '' }}">
                                                <label for="subject">{{ clean(trans('contact::attributes.subject')) }}<span>*</span></label>
                                                <input type="text" name="subject" class="form-control" id="subject" value="{{ old('subject') }}">

                                                @if($errors->has('subject'))
                                                    <span class="error-message">{{ clean($errors->first('subject')) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            
                                            <div class="form-group {{ $errors->has('message') ? 'has-error': '' }}">
                                                <label for="message">{{ clean(trans('contact::attributes.message')) }}<span>*</span></label>
                                                <textarea name="message" cols="30" rows="10" id="message">{{ old('message') }}</textarea>

                                                @if($errors->has('message'))
                                                    <span class="error-message">{{ clean($errors->first('message')) }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('captcha') ? 'has-error': '' }}">
                                                @captcha
                                                <input type="text" name="captcha" id="captcha" class="captcha-input">

                                                @if($errors->has('captcha'))
                                                    <span class="error-message">{{ clean($errors->first('captcha')) }}</span>
                                                @endif
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-submit pull-right" data-loading>
                                                {{ clean(trans('cynoebook::contact.submit')) }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-right clearfix">
                           
                            {!! setting('contact_info') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
