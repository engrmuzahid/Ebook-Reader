<?php

if (! function_exists('setting')) {
    
    function setting($name = null, $default = null,$withClean=1)
    {
        if (is_null($name)) {
            return app('setting');
        }

        if (is_array($name)) {
            return app('setting')->set($name);
        }

        try {
            if(!$withClean){
                return (app('setting')->get($name, $default));
            }
            return app('setting')->get($name, $default);
            //return clean(app('setting')->get($name, $default));
        } catch (PDOException $e) {
            return $default;
        }
    }
}

if (! function_exists('get_allowed_file_types')) {
    
    function get_allowed_file_types($for='upload')
    {
        //mpga
        /*$allowed=setting('allowed_file_types',['pdf','epub']);
        if(in_array('mp3',$allowed)){
            $allowed[]='mpga';
        }*/
        $allowed=['pdf','epub','docx','doc','txt','pptx','ppt','xls','xlsx'];
        if($for=='audio'){
            $allowed=['mp3','wav','mpga'];
        }
        return $allowed;
        
    }
}
