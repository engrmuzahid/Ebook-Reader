@extends('installer.layout')

@section('content')
<div class="tab-content">
    <div class="tab-pane active" id="details">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="info-text">Please make sure the PHP extensions listed below are installed.</h4>
            </div>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Extensions</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($requirement->phpExtensions() as $label => $pleased)
                                <tr>
                                    <td>{{ $label }}</td>

                                    <td class="text-center">
                                        <i class="fa fa-{{ $pleased ? 'check' : 'times' }}" aria-hidden="true"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-sm-12">
                 <h4 class="info-text">Please make sure you have set the correct permissions for the directories listed below.</h4>
            </div>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Directories</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($requirement->directoriesPermissions() as $label => $pleased)
                                <tr>
                                    <td>{{ $label }}</td>

                                    <td class="text-center">
                                    <i class="fa fa-{{ $pleased ? 'check' : 'times' }}" aria-hidden="true"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if($requirement->pleased())
<div class="wizard-footer">
    <div class="pull-right">
        <a href="{{ url('installer/configuration') }}" title="Environment Configuration" class="btn btn-next btn-fill btn-danger btn-wd">
            Next 
        </a>
    </div>
    <div class="clearfix"></div>
</div>
@endif
@endsection
