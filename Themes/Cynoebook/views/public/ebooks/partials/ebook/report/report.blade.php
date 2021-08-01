<div class="right-actions" id="reportBook">
    <div class="title">{{ clean(trans('cynoebook::ebook.report_issue')) }}</div>
    <div class="action-content">
        <div id="action-movefile">
            <form method="POST" action="{{ route('ebooks.report.store',$ebook) }}">
                {{ csrf_field() }}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="form-group row {{ $errors->has('reason') ? 'has-error' : '' }}" >
                        <label for="reason" class="col-md-12 text-left">{{ clean(trans('cynoebook::ebook.reason')) }}</label>
                        <div class="col-md-12 p-0">
                            <textarea class="form-control" name="reason" rows="5" placeholder="{{ clean(trans('cynoebook::ebook.reason_placeholder')) }}" required></textarea>
                            @if($errors->has('reason'))
                                <span class="error-message text-left">{{ clean($errors->first('reason')) }}</span>
                            @endif
                        </div>    
                    </div>
                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary btn-lg">{{ clean(trans('cynoebook::ebook.report')) }}</button>
                    </div>
                </div> 
            </form>
        </div>
    </div>
    <div class="action-toggle">
        <i class="fa fa-times" aria-hidden="true"></i>
    </div>
</div>