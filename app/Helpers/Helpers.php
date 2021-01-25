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
 * Return website catalog
 */
if (!function_exists('saleType')) {
    function saleType() {
        return \App\SaleType::all();
    }
}

/**
 * Return active menu items with child items.
 */
if (!function_exists('menuItems')) {
    function menuItems() {
        return \App\Page::where('deleted_at', '=', null)->where('parent_id', '=', null)->where('visible_for_menu', '=', 1)->with('childrenPages')->get();
    }
}

/**
 * Wrap menu recursively with child's.
 */
if (!function_exists('wrapMenu')) {
    function wrapMenu($menu, $level = 0) {
        if (!empty($menu)) {
            $i = 0;

            foreach ($menu as $key => $items) {
                $i++;

                if (isset($items) && !empty($items)) {

                    if (!empty($items['childrenPages'][0])) {
                        $attributes = 'role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';

                        if ($level != 0) {
                            echo '<li class="dropdown-submenu">';
                        } else {
                            echo '<li class="nav-item dropdown">';
                        }

                    } else {
                        $attributes = '';

                        if ($level === 0) {
                            echo '<li class="nav-item">';
                        } else {
                           if($key == 0 && $level == 2){
                               echo '<ul class="p-0 list-unstyled">';
                           }elseif(($key) % 5 == 0 && $level == 2 ){
                               echo '</ul>';
                               if($key != (count($menu) - 1))
                               echo '<ul class="p-0 list-unstyled">';
                           }

                            echo '<li>';
                        }
                    }

                    if ($items['route_number'] == \App\Page::ServiceRoute) {
                        $route = '/services/'.$items['alias'];
                    }elseif($items['route_number'] == \App\Page::IndustryRoute) {
                        $route = '/industry/'.$items['alias'];
                    }elseif ($items['route_number'] == \App\Page::DefaultRoute) {
                        $route = '/'.$items['alias'];
                    }

                    if ($level === 0) {
                        $setLinkType = '<a class="nav-link" href="' . $route . '" ' . $attributes . '>' . $items['name'] . '</a>';
                    } else if ($level != 0 && !empty($items['childrenPages'][0])) {
                        $setLinkType = '<a class="dropdown-item dropdown-toggle" href="' . $route . '">' . $items['name'] . '</a>';
                    } else {
                        $setLinkType = '<a class="dropdown-item" href="' . $route . '" ' . $attributes . '>' . $items['name'] . '</a>';
                    }

                    echo $setLinkType;

                    if (!empty($items['childrenPages'][0])) {

                        echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';

                        if (!empty($items['childrenPages'][0]) && $level != 0) {
                            echo '<div class="d-flex">';
                        }

                        wrapMenu($items['childrenPages'], $level + 1);

                        if (!empty($items['childrenPages'][0]) && $level != 0) {
                            echo '</div>';
                        }

                        echo '</ul>';
                    }

                    echo '</li>';

                }
            }
        }
    }
}

if (!function_exists('getRealIP')) {
    function getRealIP(){
        foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                    return $ip;
                }
            }
        }
    }
}

if (!function_exists('fileBaseNameOrExtension')) {
    function fileBaseNameOrExtension($file, $getBaseName = false) {

        $fileInfo = [];

        if (!empty($file) && $getBaseName === false) {
            return pathinfo($file, PATHINFO_EXTENSION);
        }
        if (!empty($file) && $getBaseName === true) {
            $fileInfo[] = [
                pathinfo($file, PATHINFO_BASENAME),
                pathinfo($file, PATHINFO_EXTENSION),
            ];

            return $fileInfo;
        }

        return false;
    }
}

if (!function_exists('checkFileMimeType')) {
    function checkFileMimeType($file) {
        $allowedMimeTypes = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg+xml'];
        $contentType = pathinfo($file, PATHINFO_EXTENSION);

        if(!in_array($contentType, $allowedMimeTypes) ){
            return false;
        } else {
            return true;
        }

    }
}
