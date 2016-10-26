<?php
/*
Plugin Name: D2L Country Information
Plugin URI: https://dust2life.com
Description: Get information (calling codes) from any country using the https://restcountries.eu/ API.
Version: 1.0
Author: Dust2Life (David Richied)
Author URI: https://dust2life.com
Text Domain: d2l-country-info
Domain Path: /lang/
License: GPL2
*/



// add_action('wp_enqueue_scripts', 'd2l_co_codes_styles');

// function d2l_co_codes_styles() {
// 	wp_enqueue_style( 'd2l-co-codes-css', plugins_url('d2l-co-codes/css/co-codes.css', dirname(__FILE__)) );
// 	wp_enqueue_style( 'd2l-co-codes-css-theme', plugins_url('d2l-co-codes/css/co-codes-theme.css', dirname(__FILE__)) );
// 	wp_enqueue_style( 'd2l-co-codes-css-custom', plugins_url('d2l-co-codes/css/co-codes-custom.css', dirname(__FILE__)) );
// }
//include("inc/settings.php");

require_once 'gateway.php';

add_action('wp_enqueue_scripts', array(D2LCountryInfo::manageScripts(), 'enqueueD2LJS'));

// Setup Shortcodes
add_action( 'plugins_loaded', array( D2LCountryInfo::addShortcode(), 'hook' ) );

if (is_admin()) {
	add_action( 'admin_menu', array( D2LCountryInfo::mySettingsPage(), 'add_plugin_page' ) );
	add_action( 'admin_init', array( D2LCountryInfo::mySettingsPage(), 'page_init' ) );	
}

add_action('wp_ajax_return_search_results', array(D2LCountryInfo::ajaxFunctions(), 'returnSearchResults'));
add_action('wp_ajax_nopriv_return_search_results', array(D2LCountryInfo::ajaxFunctions(), 'returnSearchResults'));
