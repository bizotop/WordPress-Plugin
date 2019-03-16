<?php

/**
 * The public-facing functionality of the plugin.
 */
class Bizotop_Public
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
     * Start a process anonymously.
     */
    public function start_process()
    {
        $api_host = rtrim(get_option('bizotop-api-host'), '/');
        $api_key = get_option("bizotop-api-key");
        $pid = sanitize_text_field($_GET['pid']);
        $url = $api_host . '/api/v1/admin-api/processes/' . $pid . '/variables/';
        $headers = array('X-Api-Key' => $api_key, 'Content-Type' => 'application/json');
        $res = wp_remote_post($url, array('method' => 'POST', 'headers' => $headers, 'body' => '{}'));
        if (is_wp_error($res)) {
            die($res->get_error_message());
        }

        if ($res['response']['code']==200 && $redirect = json_decode($res['body'])->value) {
            header('Location: ' . $redirect);
        } else {
            $html_response = $_SERVER['SERVER_PROTOCOL'] . " " . $res['response']['code'] . " " . $res['response']['message'];
            header($html_response);
            if (defined('WP_DEBUG') && WP_DEBUG === true) {
                echo "<pre>";
                print_r($res['response']);
                echo "</pre>";
            }
        }
    }
}
