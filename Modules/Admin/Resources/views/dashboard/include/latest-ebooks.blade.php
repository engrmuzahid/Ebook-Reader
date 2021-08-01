<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title border-bottom">{{ clean(trans("admin::dashboard.latest_ebooks")) }}</h4>
    
        <div class="card">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-hover">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ clean(trans('admin::dashboard.table.latest_ebooks.cover_image')) }}</th>
                                        <th>{{ clean(trans('admin::dashboard.table.latest_ebooks.ebook')) }}</th>
                                        <th>{{ clean(trans('admin::dashboard.table.user')) }}</th>
                                        <th>{{ clean(trans('admin::dashboard.table.latest_ebooks.private')) }}</th>
                                        <th>{{ clean(trans('admin::dashboard.table.latest_ebooks.protected')) }}</th>
                                        <th>{{ clean(trans('admin::dashboard.table.latest_ebooks.date')) }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $inc=0;
                                    @endphp
                                    @foreach($latestEbooks as $ebook)
                                    @php 
                                        
                                        $inc++;
                                    @endphp
                                    
                                    <tr>
                                        <td>
                                        {{ $inc }}
                                        </td>
                                        <td>
                                            <div class="avatar-holder">
                                                @if (! $ebook->book_cover->exists)
                                                    <i class="fas fa-image"></i>
                                                @else
                                                    <img src="{{ $ebook->book_cover->path }}" width="50" height="50">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.ebooks.edit', $ebook) }}">{{ $ebook->title }}</a>
                                        </td>
                                        <td>
                                             @if($ebook->user()->exists())
                                                {{$ebook->user->full_name}}
                                            @else
                                                {{'Guest'}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($ebook->is_private==1)
                                                {{ trans('cynoebook::account.ebooks.yes') }}
                                            @else
                                                {{ trans('cynoebook::account.ebooks.no') }}
                                            @endif
                                        </td>

                                        <td>
                                            @if($ebook->password!='')
                                                {{ trans('cynoebook::account.ebooks.yes') }}
                                            @else
                                                {{ trans('cynoebook::account.ebooks.no') }}
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