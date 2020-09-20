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

/**
 * Return website settings
 */
if (!function_exists('settings')) {
    function settings() {
        return \App\Settings::first();
    }
}

/**
 * Return active menu items with child items.
 */
if (!function_exists('menuItems')) {
    function menuItems() {
        return \App\Page::where('deleted_at', '=', null)->where('parent_id', '=', null)->with('childrenPages')->get();
    }
}

if (!function_exists('wrapMenu')) {
    function wrapMenu($menu, $level = 0) {
        if (!empty($menu)) {
            foreach ($menu as $items) {
                if (isset($items) && !empty($items)) {

                    if (!empty($items['childrenPages'][0])) {
                        $attributes = 'role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                        echo '<li class="nav-item dropdown">';
                    } else {
                        $attributes = '';

                        if ($level === 0) {
                            echo '<li class="nav-item">';
                        } else {
                            echo '<li>';
                        }
                    }

                    if ($level === 0) {
                        $setLinkType = '<a class="nav-link" href="' . $items['alias'] . '" ' . $attributes . '>' . $items['name'] . '</a>';
                    } else {
                        $setLinkType = '<a class="dropdown-item" href="' . $items['alias'] . '" ' . $attributes . '>' . $items['name'] . '</a>';
                    }

                    echo $setLinkType;

                    if (!empty($items['childrenPages'][0])) {

                        echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';

                        wrapMenu($items['childrenPages'], $level + 1);

                        echo '</ul>';
                    }

                    echo '</li>';

                }
            }
        }
    }
}
