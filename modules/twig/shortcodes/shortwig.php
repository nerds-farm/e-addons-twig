<?php
namespace EAddonsTwig\Modules\Twig\Shortcodes;

use EAddonsForElementor\Base\Base_Shortcode;
use EAddonsTwig\Modules\Twig\Twig;

/**
 * Description of Twig
 *
 * @author fra
 */
class Shortwig extends Base_Shortcode {
    
    public function __construct() {
        // add token to 
        add_filter('widget_text', [$this, 'add_twig_to_widget_text']);
    }
    /*
    public function get_pid() {
        return 1466;
    }
    
    public function get_icon() {
        return 'eadd-do-shortcode';
    }
    */    
    public function get_name() {
        return 'shortwig';
    }
    
    /**
     * Execute the Shortcode
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function do_shortcode($atts) {

        if (empty($atts['value'])) {
            return '';
        }
        $override_id = '';
        if (!empty($atts['id'])) {
            $override_id = '|'.intval($atts['id']);
        }
        return Twig::do_twig('{{'.$atts['value'].$override_id.'}}');
        
    }
    
    public function add_twig_to_widget_text($text) {
        $text = Twig::do_twig($text);
        return $text;
    }   
    
}
