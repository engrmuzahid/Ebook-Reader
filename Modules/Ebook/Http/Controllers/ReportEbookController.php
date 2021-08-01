<?php

namespace Modules\Ebook\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Ebook\Entities\Ebook;
use Modules\Ebook\Http\Requests\StoreReportRequest;

class ReportEbookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param int $ebookId
     * @param \Modules\Report\Http\Requests\StoreReportRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($ebookId, StoreReportRequest $request)
    {
        if(auth()->user())
        {
            Ebook::findOrFail($ebookId)
                ->reportedEbook()
                ->create([
                    'user_id' => auth()->id(),
                    'reason' => $request->reason
                ]); 
                return back()->withSuccess($this->message());
        }
        return back()->withErrors("Something went wrong. Please try again later!");
        
        
    }

    /**
     * Returns the success message.
     *
     * @return string
     */
    private function message()
    {
        return clean(trans('ebook::messages.submitted_ebook_report'));
    }
}
