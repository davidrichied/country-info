<?php
class Country_Info_SettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {

    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Country Info', 
            'manage_options', 
            'country-info-settings', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'd2l_co_info_options' );
        ?>
        <div class="wrap">
            <h1>Country Code Search Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'd2l_country_info_options_group' );
                do_settings_sections( 'country-info-settings' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'd2l_country_info_options_group', // Option group
            'd2l_co_info_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'General Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'country-info-settings' // Page
        );  

        // add_settings_field(
        //     'd2l_gmtz_api_key', // ID
        //     'Google Maps API Key', // Title 
        //     array( $this, 'd2l_gmtz_api_key_callback' ), // Callback
        //     'country-info-settings', // Page
        //     'setting_section_id' // Section           
        // );      

        add_settings_field(
            'd2l_country_info_active_page', 
            'Active Page', 
            array( $this, 'd2l_country_info_active_page_callback' ), 
            'country-info-settings', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        // if( isset( $input['d2l_gmtz_api_key'] ) )
        //     $new_input['d2l_gmtz_api_key'] = $input['d2l_gmtz_api_key'];

        if( isset( $input['d2l_country_info_active_page'] ) )
            $new_input['d2l_country_info_active_page'] = sanitize_text_field( $input['d2l_country_info_active_page'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    // public function d2l_gmtz_api_key_callback()
    // {
    //     printf(
    //         '<input type="text" id="d2l_gmtz_api_key" name="d2l_co_info_options[d2l_gmtz_api_key]" value="%s" />',
    //         isset( $this->options['d2l_gmtz_api_key'] ) ? esc_attr( $this->options['d2l_gmtz_api_key']) : ''
    //     );
    // }

    /** 
     * Get the settings option array and print one of its values
     */
    public function d2l_country_info_active_page_callback()
    {
        printf(
            '<input type="text" id="d2l_country_info_active_page" name="d2l_co_info_options[d2l_country_info_active_page]" value="%s" />',
            isset( $this->options['d2l_country_info_active_page'] ) ? esc_attr( $this->options['d2l_country_info_active_page']) : ''
        );
    }
}