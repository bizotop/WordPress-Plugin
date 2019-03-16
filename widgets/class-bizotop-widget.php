<?php
/**
 * Widget API: Bizotop_Widget class
 */

class Bizotop_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('Bizotop_Widget', __('Bizotop Widget', 'bizotop'));
    }
 
    public function widget($args, $instance)
    {
        // outputs the content of the widget
        extract($args);
        $html = "<a href='" . admin_url('admin-post.php') . "?action=start_process&pid=" . $instance['pid'] . "' >" . $instance['link_text'] . "</a>";

        echo $before_widget;
        echo $html;
        echo $after_widget;
    }
 
    public function form($instance)
    {
        // outputs the options form in the admin
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'link_text' => '',
                'pid' => '',
            )
        );
        extract($instance);
        $link_text_field_name = $this->get_field_name('link_text');
        $pid_field_name = $this->get_field_name('pid'); ?>
            <p>
                <label for="<?php echo $link_text_field_name ?>" ><?php _e('Link Text', 'bizotop') ?></label>
                <input id="<?php echo $link_text_field_name ?>" name="<?php echo $link_text_field_name ?>" value="<?php echo esc_attr($link_text) ?>" class="widefat" />
            </p>
            <p>
                <label for="<?php echo $pid_field_name ?>" ><?php _e('PID', 'bizotop') ?></label>
                <input id="<?php echo $pid_field_name ?>" name="<?php echo $pid_field_name ?>" value="<?php echo esc_attr($pid) ?>" class="widefat" />
            </p>
        <?php
    }
 
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
        $instance = array();
        $instance['pid'] = (!empty($new_instance['pid'])) ? sanitize_text_field($new_instance['pid']) : '';
        $instance['link_text'] = (!empty($new_instance['link_text'])) ? sanitize_text_field($new_instance['link_text']) : '';
        return $instance;
    }
}
