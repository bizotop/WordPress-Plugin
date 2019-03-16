<?php

/**
 * The admin-specific functionality of the plugin.
 */
class Bizotop_Admin
{

    /**
     * The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register our custom widgets
     */
    public function register_widgets()
    {
        register_widget('Bizotop_Widget');
    }

    /**
     * Register the settings page
     */
    public function add_admin_menu()
    {
        add_options_page(
            __('Bizotop Settings', 'bizotop'), // page_title
            __('Bizotop', 'bizotop'), // menu_title
            'manage_options',
            'bizotop-settings',
            array(
                $this,
                'create_admin_interface'
            )
        );
    }

    /**
     * Callback function for the admin settings page.
     *
     * @since    1.0.0
     */
    public function create_admin_interface()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/bizotop-admin-display.php';
    }

    /**
     * Creates our settings sections with fields etc.
     * New settings must be added to uninstall.php too
     */
    public function settings_api_init()
    {
        add_settings_section(
            'bizotop-section',
            '', // section_heading
            "__return_false",
            "bizotop-settings"
        );

        add_settings_field(
            'bizotop-api-key',
            '<label for="bizotop-api-key" >' . __('API Key', 'bizotop') . '</label>',
            array($this, 'api_key_setting_field'),
            'bizotop-settings',
            'bizotop-section'
        );

        add_settings_field(
            'bizotop-api-host',
            '<label for="bizotop-api-host" >' . __('API Host', 'bizotop') . '</label>',
            array($this, 'api_host_setting_field'),
            'bizotop-settings',
            'bizotop-section'
        );

        //register settings
        register_setting('bizotop-section', 'bizotop-api-key');
        register_setting('bizotop-section', 'bizotop-api-host');
    }

    public function api_key_setting_field()
    {
        $id = 'bizotop-api-key';
        $value = !empty(get_option($id)) ? " value='".get_option($id)."'" : "";
        echo "<input type='text' id='$id' name='$id' class='regular-text' $value />";
    }

    public function api_host_setting_field()
    {
        $id = 'bizotop-api-host';
        $value = !empty(get_option($id)) ? " value='".get_option($id)."'" : "";
        echo "<input type='text' id='$id' name='$id' class='regular-text' $value />";
    }
}
