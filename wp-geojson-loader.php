<?php

/**
 * WP-GeoJSON-Loader Read GeoJSON into a post
 *
 * Each feature becomes a post. All properties become meta properties, as does 
 * the whole GeoJSON object (with the meta label 'geom').
 *
 * If you use a custom template for your custom post type, you could generate all the 
 * output you wanted just from the loaded GeoJSON.
 *
 * Plugin Name: WP GeoJSON Loader
 * Author: Michael Moore
 * Author URI: http://cimbura.com
 * Version: 0.0.1
 *
 * @package WP-GeoJSON-Loader
 */

require_once( __DIR__ . '/loader_class.php' );
