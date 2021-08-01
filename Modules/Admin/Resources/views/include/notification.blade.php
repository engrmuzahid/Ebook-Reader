@if (session()->has('success'))
<div class="col-md-12">
    <div class="alert alert-success alert-dismissable clearfix">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fas fa-check" aria-hidden="true"></i> {{ clean(session('success')) }}
    </div>
</div>
@endif

@if (session()->has('error'))
<div class="col-md-12">
    <div class="alert alert-danger alert-dismissable clearfix">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fas fa-exclamation" aria-hidden="true"></i> {{ clean(session('error')) }}
    </div>
</div>
@endif
