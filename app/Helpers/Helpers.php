<?php

use App\Models\User;
use App\Models\Upload;

// service mysql stop
// sudo /opt/lampp/lampp start

const ERROR_STATUS_CODE = 500;

if (!defined('NETWORK_ERROR')) {
    define('NETWORK_ERROR', 'Sorry you can not access this page.');
}

function translate($key, $lang = null, $addslashes = false)
{
    return $key;
}

//highlights the selected navigation on admin panel
if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

//highlights the selected navigation on frontend
if (!function_exists('areActiveRoutesHome')) {
    function areActiveRoutesHome(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

//highlights the selected navigation on frontend
if (!function_exists('default_language')) {
    function default_language()
    {
        return env("DEFAULT_LANGUAGE");
    }
}

//return carrier wise shipping cost against seller
if (!function_exists('carrier_base_price')) {
    function carrier_base_price($carts, $carrier_id, $owner_id)
    {
        $shipping = 0;
        foreach ($carts as $key => $cartItem) {
            if ($cartItem->owner_id == $owner_id) {
                $shipping_cost = getShippingCost($carts, $key, $carrier_id);
                $shipping += $shipping_cost;
            }
        }
        return $shipping;
    }
}

function timezones()
{
    return array(
        '(GMT+06:00) Astana' => 'Asia/Dhaka',
        '(GMT+06:00) Dhaka' => 'Asia/Dhaka',
    );
}

if (!function_exists('app_timezone')) {
    function app_timezone()
    {
        return config('app.timezone');
    }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = Upload::where('file_name', $id)->first()) != null) {
            //return my_asset($asset->file_name);
            return optional($asset)->external_link == null ? my_asset($asset->file_name) : optional($asset)->external_link;
        }
        return static_asset('assets/img/placeholder.jpg');
    }
}

if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        return $path;
        //return '/'.$path;

        if (env('FILESYSTEM_DRIVER') != 'local') {
            return Storage::disk(env('FILESYSTEM_DRIVER'))->url($path);
        } 
        
        return app('url')->asset('public/' . $path, $secure);
    }
}

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return asset($path, $secure);
        //return app('url')->asset('public/' . $path, $secure);
    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        return asset('/');
    }
}

if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        return asset('/');

        if (env('FILESYSTEM_DRIVER') != 'local') {
            return env(Str::upper(env('FILESYSTEM_DRIVER')).'_URL') . '/';
        }

        return getBaseURL() . 'public/';
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null, $lang = false)
    {
        return null;
    }
}


//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            return $asset->external_link == null ? my_asset($asset->file_name) : $asset->external_link;
        }
        return static_asset('assets/img/placeholder.jpg');
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

// duplicates m$ excel's ceiling function
if (!function_exists('ceiling')) {
    function ceiling($number, $significance = 1)
    {
        return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
    }
}

//for api
if (!function_exists('get_images_path')) {
    function get_images_path($given_ids, $with_trashed = false)
    {
        $paths = [];
        foreach (explode(',', $given_ids) as $id) {
            $paths[] = uploaded_asset($id);
        }

        return $paths;
    }
}

// Get URL params
if (!function_exists('get_url_params')) {
    function get_url_params($url, $key)
    {
        $query_str = parse_url($url, PHP_URL_QUERY);
        parse_str($query_str, $query_params);

        return $query_params[$key] ?? '';
    }
}

// get Admin
if (!function_exists('get_admin')) {
    function get_admin()
    {
        $admin_query = User::query();
        return $admin_query->where('user_type', 'admin')->first();
    }
}

// Get Uploaded file
if (!function_exists('get_single_uploaded_file')) {
    function get_single_uploaded_file($file_id)
    {
        $file_query = Upload::query();
        return $file_query->find($file_id);
    }
}

if (!function_exists('timezones')) {
    function timezones()
    {
        return array(
            '(GMT+06:00) Astana' => 'Asia/Dhaka',
            '(GMT+06:00) Dhaka' => 'Asia/Dhaka',
        );
    }
}

if (!function_exists('getConfigSettings')) {
    function getConfigSettings() {
        return json_decode(config('website_setting.setting'), true);
    }
}