<div class="row">
<div class="col-sm-12">
    <h4 class="page-title border-bottom"><i class="fas fa-flag" aria-hidden="true"></i> {{ clean(trans('admin::dashboard.latest_reportedebooks')) }}</h4>
    <div class="card">
            
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive table-hover ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ clean(trans('admin::dashboard.table.latest_reportedebooks.ebook')) }}</th>
                                    <th>{{ clean(trans('admin::dashboard.table.latest_reportedebooks.reported_user')) }}</th>
                                    <th>{{ clean(trans('admin::dashboard.table.latest_reportedebooks.date')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $inc=0; @endphp
                                @foreach($latestReportedEbooks as $ebook)
                                @php $inc++; @endphp
                                    <tr>
                                        <td>
                                        {{ $inc }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.ebooks.edit', $ebook) }}">{{ $ebook->ebook->title }}</a>
                                            
                                        </td>
                                        
                                        <td>
                                            @if($ebook->user()->exists())
                                                {{$ebook->user->full_name}}
                                            @else
                                                {{'Guest'}}
                                            @endif
                                        </td>
                                        
                                        
                                        <td>{{ $ebook->created_at->toFormattedDateString() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
