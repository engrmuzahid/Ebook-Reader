<?php

if (! function_exists('cynoebook_layout')) {
    /**
     * Get cynoebook layout name.
     *
     * @return string
     */
    function cynoebook_layout()
    {
        return setting('cynoebook_layout', 'default');
    }
}

if (! function_exists('resolve_theme_color')) {
    /**
     * Resolve color code by the given theme name.
     *
     * @param string $name
     * @return string
     */
    function resolve_theme_color($name)
    {
        $colors = [
            'theme-blue' => '#0068e1',
            'theme-violet' => '#783392',
            'theme-red' => '#e30047',
            'theme-sky-blue' => '#2ba1c0',
            'theme-marrs-green' => '#0a6f75',
            'theme-navy-blue' => '#31629f',
            'theme-pink' => '#f15497',
            'theme-black' => '#333645',
        ];

        return $colors[$name] ?? '#31629f';
    }
}

if (! function_exists('is_filtering')) {
    /**
     * Check if current route is filter products using given value of attributes.
     *
     * @param string $value
     * @return bool
     */
    function is_filtering($value)
    {
        $value = mb_strtolower($value);
        $requestQueries = array_flatten(request('attribute', []));

        return in_array($value, $requestQueries);
    }
}

if (! function_exists('rating_star_class')) {
    /**
     * Get class for rating star.
     *
     * @param int|float $rating
     * @param int $forStar
     * @return string
     */
    function rating_star_class($rating, $forStar)
    {
        $class = $rating >= $forStar ? 'fa fa-star rated' : 'fa fa-star-o';

        if (fmod($rating, 1) == 0) {
            return $class;
        }

        if (is_float($rating) && ceil($rating) === (float) $forStar) {
            $class = 'fa fa-star-half-o rated';
        }

        return $class;
    }
}

if (! function_exists('review_form_has_error')) {
    /**
     * Determine if review form has any error.
     *
     * @param \Illuminate\Support\ViewErrorBag $errors
     * @return bool
     */
    function review_form_has_error($errors)
    {
        return $errors->has('rating') || $errors->has('reviewer_name') || $errors->has('comment') || $errors->has('captcha');
    }
}
if (! function_exists('comment_form_has_error')) {
    /**
     * Determine if comment form has any error.
     *
     * @param \Illuminate\Support\ViewErrorBag $errors
     * @return bool
     */
    function comment_form_has_error($errors)
    {
        return $errors->has('message');
    }
}

if (! function_exists('report_form_has_error')) {
    /**
     * Determine if report form has any error.
     *
     * @param \Illuminate\Support\ViewErrorBag $errors
     * @return bool
     */
    function report_form_has_error($errors)
    {
        return $errors->has('reason');
    }
}
