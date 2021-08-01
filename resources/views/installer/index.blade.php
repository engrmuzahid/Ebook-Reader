@extends('installer.layout')

@section('content')
<div class="tab-content">
    <div class="tab-pane active" id="details">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="info-text"> Welcome to Installation and Setup Wizard.</h2>
            </div>
            <div class="text-center">
                <a type="button" class="btn btn-next btn-fill btn-danger btn-wd" href="{{url('installer/requirements') }}"> Check Requirements & Permissions  </a>
            </div>
        </div>
    </div>
</div>

@endsection
