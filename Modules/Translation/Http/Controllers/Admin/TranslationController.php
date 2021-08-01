<?php

namespace Modules\Translation\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Translation\Entities\Translation;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translations = Translation::retrieve();

        return view('translation::admin.translations.index', compact('translations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $key
     * @return \Illuminate\Http\Response
     */
    public function update($key)
    {
        $translation=Translation::firstOrCreate(['key' => $key])
            ->translations()
            ->updateOrCreate(
                ['locale' => clean(request('locale'))],
                ['value' => clean(request('value', ''))]
            );
        
        activity('translation')
            ->performedOn($translation)
            ->causedBy(auth()->user())
            ->withProperties(['subject' =>$translation,'causer'=>auth()->user()])
            ->log('updated');
        
        return clean(trans('admin::messages.update_message', ['resource' => trans('translation::translations.translation')]));
    }
}
