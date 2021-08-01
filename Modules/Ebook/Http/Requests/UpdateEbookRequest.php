<?php

namespace Modules\Ebook\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Ebook\Entities\Ebook;
use Modules\Base\Http\Requests\Request;

class UpdateEbookRequest extends Request
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $allowedFileTypes=get_allowed_file_types();
        $allowedAudioFileTypes=get_allowed_file_types('audio');
        $allowedFileTypes=implode (",", $allowedFileTypes);
        $allowedAudioFileTypes=implode (",", $allowedAudioFileTypes);
        
        $rules= [
            'title' => 'required',
            'description' => 'required',
            'publication_year' => 'nullable|integer|min:1900',
            'categories' => 'required',
            'authors' => 'required',
            'book_cover' => 'nullable|mimes:jpeg,png,jpg',
            'file_type' => ['required', Rule::in('audio','upload', 'embed_code', 'external_link')],
            'book_file' => 'required_if:file_type,upload|mimes:'.$allowedFileTypes,
            'audio_book_files' => 'required_if:file_type,audio',
            'audio_book_files.*' => 'mimes:'.$allowedAudioFileTypes,
            'file_url' => 'required_if:file_type,external_link|nullable|url|url_ext',
            'embed_code' => 'required_if:file_type,embed_code',
        ];
        
        if($this->has('ftypeuou')){
            $rules['book_file'] = 'nullable|mimes:'.$allowedFileTypes;
            
        }
        if($this->has('ftypeuou1')){
            $rules['audio_book_files'] = 'nullable';
            $rules['audio_book_files.*'] = 'mimes:'.$allowedAudioFileTypes;
        }
        
        return $rules;
    }

    
}
