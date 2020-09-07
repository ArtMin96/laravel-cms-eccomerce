<?php

use Illuminate\Support\Facades\Request;

/**
 * Return link-here if current path begins with this path.
 *
 * @param $path
 * @return bool|string
 */
if (!function_exists('setActiveClass')) {
    function setActiveLink($path) {
        if (!is_null($path)) {
            return Request::is($path . '*') ? 'active' : '';
        }
        return false;
    }
}
