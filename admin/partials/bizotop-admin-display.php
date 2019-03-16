<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

 <div class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields('bizotop-section'); ?>
        <?php do_settings_sections('bizotop-settings'); ?>
        <?php submit_button('Save Changes'); ?>
    </form>
</div>
