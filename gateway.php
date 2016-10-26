<?php
foreach (glob(dirname(__FILE__) . '/lib/classes/*.php') as $classfilename) {
    include_once $classfilename;
}

$D2LCountryInfo = new D2LCountryInfo();

class D2LCountryInfo {
    private static $cache = array();

    private static $pluginBasename;

    private static $pluginUrl;

    public function __construct()
    {
        self::$pluginBasename = dirname( plugin_basename( __FILE__ ) );
        self::$pluginUrl = plugin_dir_url(__FILE__);
    }


    public static function manageScripts()
    {
        if (!isset(self::$cache['manageScripts'])) {
            self::$cache['manageScripts'] = new Country_Info_ManageScripts(self::$pluginUrl);
        }
        return self::$cache['manageScripts'];
    }

    public static function ajaxFunctions()
    {
        if (!isset(self::$cache['ajaxFunctions'])) {
            self::$cache['ajaxFunctions'] = new Country_Info_AjaxFunctions(self::curlWrap());
        }
        return self::$cache['ajaxFunctions'];
    }


    public static function curlWrap()
    {
        if (!isset(self::$cache['curlWrap'])) {
            self::$cache['curlWrap'] = new Country_Info_CurlWrap();
        }
        return self::$cache['curlWrap'];
    }


    public static function addShortcode()
    {
        if (!isset(self::$cache['addShortcode'])) {
            self::$cache['addShortcode'] = new Country_Info_AddShortcode();
        }
        return self::$cache['addShortcode'];
    }


    public static function mySettingsPage()
    {
        if (!isset(self::$cache['mySettingsPage'])) {
            self::$cache['mySettingsPage'] = new Country_Info_SettingsPage();
        }
        return self::$cache['mySettingsPage'];
    }

}