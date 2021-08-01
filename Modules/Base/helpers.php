<?php
use App\CiEBook;
use Modules\Base\Helpers\Locale;
use Modules\Base\Helpers\RTLDetector;
use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Cookie;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (! function_exists('str_between')) {
    
    function str_between($string, $start, $end)
    {
        return str_after(str_before($string, $end), $start);
    }
}

if (! function_exists('intl_number')) {
    
    function intl_number($number, $locale = null)
    {
        $locale = is_null($locale) ? locale() : $locale;

        $formatter = new NumberFormatter($locale, NumberFormatter::DECIMAL);

        return $formatter->format($number);
    }
}

if (! function_exists('locale')) {
   
    function locale()
    {
        return app()->getLocale();
    }
}

if (! function_exists('is_rtl')) {
    
    function is_rtl($locale = null)
    {
        return RTLDetector::detect($locale ?: locale());
    }
}

if (! function_exists('supported_locales')) {
   
    function supported_locales()
    {
        return LaravelLocalization::getSupportedLocales();
    }
}

if (! function_exists('supported_locale_keys')) {
    /**
     * Get all supported locale keys.
     *
     * @return array
     */
    function supported_locale_keys()
    {
        return LaravelLocalization::getSupportedLanguagesKeys();
    }
}

if (! function_exists('localized_url')) {
    /**
     * Returns an URL adapted to the given locale.
     *
     * @param string $locale
     * @param string $url
     * @return string
     */
    function localized_url($locale, $url = null)
    {
        return LaravelLocalization::getLocalizedURL($locale, $url);
    }
}

if (! function_exists('get_file_extension')) {
    function get_file_extension($url)
    {
        return $ext = pathinfo($url, PATHINFO_EXTENSION);
    }
}

if (! function_exists('non_localized_url')) {
    /**
     * It returns an URL without locale.
     *
     * @param string $url
     * @return string
     */
    function non_localized_url($url = null)
    {
        return LaravelLocalization::getNonLocalizedURL($url);
    }
}

if (! function_exists('is_multilingual')) {
    /**
     * Determine if the app has multi language.
     *
     * @return bool
     */
    function is_multilingual()
    {
        return count(supported_locales()) > 1;
    }
}

if (! function_exists('is_module_enabled')) {
    
    function is_module_enabled($module)
    {
        return array_key_exists($module, app('modules')->allEnabled());
    }
}

if (! function_exists('is_base_module')) {
    
    function is_base_module($module)
    {
        return in_array(strtolower($module), config('modules.core.config.base_modules'));
    }
}

if (! function_exists('return_if')) {
    /**
     * Return a given value if the given condition is true.
     *
     * @param bool $condition
     * @param bool $value
     * @return mixed
     */
    function return_if($condition, $value)
    {
        return $condition ? $value : null;
    }
}

if (! function_exists('return_unless')) {
    /**
     * Return a given value unless the given condition is true.
     *
     * @param bool $condition
     * @param bool $value
     * @return mixed
     */
    function return_unless($condition, $value)
    {
        return ! $condition ? $value : null;
    }
}

if (! function_exists('has_i18n_error')) {
    /**
     * Return has-error class if there are errors by given locale.
     *
     * @param \Illuminate\Support\ViewErrorBag $errors
     * @param string $locale
     * @return string|null
     */
    function has_i18n_error(ViewErrorBag $errors, $locale)
    {
        foreach ($errors->getMessages() as $field => $messages) {
            if (substr($field, 0, strpos($field, '.')) === $locale) {
                return 'has-error';
            }
        }
    }
}

if (! function_exists('id_encode')) {
    /**
     * Generate a encode "id" from a given id
     *
     * @param int $id
     */
    function id_encode($id)
    {
        return bin2hex(base64_encode($id));
    }
}

if (! function_exists('id_decode')) {
    /**
     * Generate a decode "id" from a given id
     *
     * @param int $id
     */
    function id_decode($id)
    {
        return base64_decode(hex2bin($id));
    }
}

if (! function_exists('slugify')) {
    /**
     * Generate a URL friendly "slug" from a given string
     *
     * @param string $value
     */
    function slugify($value)
    {
        $slug = preg_replace('/[\s<>[\]{}|\\^%&\$,\/:;=?@#\'\"]/', '-', mb_strtolower($value));

        // Remove duplicate separators.
        $slug = preg_replace('/-+/', '-', $slug);

        // Trim special characters from the beginning and end of the slug.
        return trim($slug, '!"#$%&\'()*+,-./:;<=>?@[]^_`{|}~');
    }
}

if (! function_exists('v')) {
    /**
     * Version a relative asset using the time its contents last changed.
     *
     * @param string $value
     * @return string
     */
    function v($path)
    {
        if (config('app.env') === 'local') {
            $version = uniqid();
        } else {
             $version = CiEBook::VERSION;
        }

        return "{$path}?v=" . $version;
    }
}

if (! function_exists('app_version')) {
    /**
     * Get the app version.
     *
     * @return string
     */
    function app_version()
    {
       return CiEBook::VERSION;
    }
}

if (! function_exists('old_json')) {
    /**
     * Retrieve and json encode an old input item.
     *
     * @param string $array
     * @param mixed $default
     * @param mixed $options
     * @return string
     */
    function old_json($key, $default = [], $options = null)
    {
        $old = array_reset_index(old($key, []));

        return json_encode($old ?: $default, $options);
    }
}

if (! function_exists('is_json')) {
    /**
     * Determine if the given string is valid json.
     *
     * @param string $string
     * @return bool
     */
    function is_json($string)
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }
}

if (! function_exists('array_reset_index')) {
    /**
     * Reset numeric index of an array recursively.
     *
     * @param array $array
     * @return array|\Illuminate\Support\Collection
     *
     */
    function array_reset_index($array)
    {
        $array = $array instanceof Collection
            ? $array->toArray()
            : $array;

        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $array[$key] = array_reset_index($val);
            }
        }

        if (isset($key) && is_numeric($key)) {
            return array_values($array);
        }

        return $array;
    }
}
