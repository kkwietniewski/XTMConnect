<?php

/**
 * 
 * @package XTMConnect
 */

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function admin_dashboard()
    {
        return require_once("$this->pluginPath/templates/admin.php");
    }

    public function translation()
    {
        return require_once("$this->pluginPath/templates/translation.php");
    }

    public function xtm_options_group($input)
    {
        return $input;
    }

    public function xtm_text_example()
    {
        $value = esc_attr( get_option('text_example') );
        echo '<input type="text" class="regular-text" name="text_example" value="'. $value .'" placeholder="Write something">';
    }
}