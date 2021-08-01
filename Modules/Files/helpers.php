<?php

if (! function_exists('display_filesize')) {
    
    function display_filesize($size)
    {
        $size = max(0, (int)$size);
        $units = array( 'b', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb', 'Eb', 'Zb', 'Yb');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') .' '.$units[$power];
    }
}
