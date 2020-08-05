<?php
defined('ABSPATH') or die('No script kiddies please!');
/*
Plugin Name:       IFRS Portal SiteSort
Plugin URI:        https://github.com/IFRS/portal-plugin-sitesort
Description:       Plugin que classifica os Sites em ordem alfabética na listagem do admin.
Version:           1.0.0
Requires at least: 5.2.5
Requires PHP:      7.1.0
Author:            Ricardo Moro
Author URI:        https://github.com/ricardomoro
License:           GPLv3
License URI:       https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:       ifrs-portal-plugin-sitesort
*/

add_filter('get_blogs_of_user', function($blogs) {
    uasort($blogs, function($a, $b) {
        return strcasecmp($a->blogname, $b->blogname);
    });

    $mainblog = array_filter($blogs, function($blog) {
        if ($blog->userblog_id == get_main_site_id()) {
            return true;
        }
    });

    if ($mainblog) {
        $mainblog = $mainblog[1];
        unset($blogs[array_search($mainblog, $blogs)]);
        array_unshift($blogs, $mainblog);
    }

    return $blogs;
});
