<?php
/**
 * Plugin Name: esri-map-view
 * Plugin URI:        https://github.com/jf990/esri-map-component/
 * Description:       Render an ArcGIS map on a WordPress page. Use any Esri basemap, public layers, public web map or web scene.
 * Version:           1.0.2
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            John Foster
 * Author URI:        https://github.com/jf990/
 * License:           MIT
 * License URI:       https://github.com/jf990/esri-map-component/blob/master/LICENSE
 * Text Domain:       esri-map-view
 * Tags:              maps, arcgis, location, scene, globe, points, layers, markers, google maps
 */

// Exit if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

function esrimapview_shortcode($attributes = [], $content = null, $tag = '')
{
    $height = isset($attributes['height']) ? $attributes['height'] : '480px';
    $html = '<figure class="wp-block-image size-large" style="height:' . $height . ';"><esri-map-view style="height:' . $height . ';"';
 
    // Add attributes
    foreach ($attributes as $attribute => $value) {
        $html .= ' ' . strtolower($attribute) . '="' . esc_html__($value, 'default') . '"';
    }
    $html .= '></esri-map-view></figure>';
    return $html;
}

function esrisceneview_shortcode($attributes = [], $content = null, $tag = '')
{
    $height = isset($attributes['height']) ? $attributes['height'] : '480px';
    $html = '<figure class="wp-block-image size-large" style="height:' . $height . ';"><esri-scene-view style="height:' . $height . ';"';
 
    // Add attributes
    foreach ($attributes as $attribute => $value) {
        $html .= ' ' . strtolower($attribute) . '="' . esc_html__($value, 'default') . '"';
    }
    $html .= '></esri-scene-view></figure>';
    return $html;
}
 
function esrimapview_shortcodes_init()
{
    add_shortcode('esri-map-view', 'esrimapview_shortcode');
    add_shortcode('esri-scene-view', 'esrisceneview_shortcode');
    wp_enqueue_script('esri-map-view', 'https://unpkg.com/esri-map-view@0.3.1/dist/esri-map-view.js', [], '0.3.1', false);
}
 
add_action('init', 'esrimapview_shortcodes_init');
