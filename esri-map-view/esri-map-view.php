<?php
/**
 * Plugin Name:       esri-map-view
 * Plugin URI:        https://github.com/jf990/esri-map-view-plugin/
 * Description:       Render an ArcGIS map on a WordPress page. Use any Esri basemap, public layers, public web map or web scene.
 * Version:           1.2.2
 * Stable tag:        1.2.2
 * Requires at least: 5.2
 * Tested up to:      6.6
 * Requires PHP:      7.0
 * Author:            John Foster
 * Author URI:        https://github.com/jf990/
 * License:           MIT
 * License URI:       https://github.com/jf990/esri-map-view-plugin/blob/master/LICENSE
 * Text Domain:       esri-map-view
 * Tags:              maps, arcgis, esri, location, globe
 * GitHub Plugin URI: https://github.com/jf990/esri-map-view-plugin
 * GitHub Branch:     main
 */

// Exit if accessed without WordPress initialized.
if ( ! defined('WPINC') || ! defined( 'ABSPATH' )) {
    exit;
}

define( 'ESRI_MAP_VIEW_VERSION', '1.2.2' );

function esrimapview_shortcode($attributes = [], $content = null, $tag = '')
{
    $attributes = array_change_key_case($attributes, CASE_LOWER);
    $height = isset($attributes['height']) ? $attributes['height'] : '480px';
    $html = '<figure class="wp-block-image size-large" style="height:' . $height . ';"><esri-map-view style="height:' . $height . ';"';
 
    // Add attributes
    foreach ($attributes as $attribute => $value) {
        $html .= ' ' . strtolower($attribute) . '="' . esc_attr($value) . '"';
    }
    $html .= '>' . esc_html($content) . '</esri-map-view></figure>';
    return $html;
}

function esrisceneview_shortcode($attributes = [], $content = null, $tag = '')
{
    $attributes = array_change_key_case($attributes, CASE_LOWER);
    $height = isset($attributes['height']) ? $attributes['height'] : '480px';
    $html = '<figure class="wp-block-image size-large" style="height:' . $height . ';"><esri-scene-view style="height:' . $height . ';"';
 
    // Add attributes
    foreach ($attributes as $attribute => $value) {
        $html .= ' ' . strtolower($attribute) . '="' . esc_attr($value) . '"';
    }
    $html .= '>' . esc_html($content) . '</esri-scene-view></figure>';
    return $html;
}
 
function esrimapview_shortcodes_init()
{
    add_shortcode('esri-map-view', 'esrimapview_shortcode');
    add_shortcode('esri-scene-view', 'esrisceneview_shortcode');
    wp_enqueue_script_module('esri-map-view', 'https://unpkg.com/esri-map-view@0.9.1/dist/esri-map-view/esri-map-view.esm.js', [], '0.9.1', false);
}
 
add_action('init', 'esrimapview_shortcodes_init');
