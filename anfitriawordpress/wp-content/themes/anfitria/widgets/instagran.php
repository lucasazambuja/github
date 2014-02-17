<?php
/*
 * Plugin Name: WP Plugin Instagran
 * Description:
 * Version: 0.1
 * License:
 * License URI:
 * Tags: .
 */

/*
 * 	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'anfitria_widget_instagran');

/*
 * 	Widget registering
 */

function anfitria_widget_instagran() {
    register_widget('instagran');
//    register_activation_hook(__FILE__, array('plugin_midias_sociais', 'activate'));
//    register_deactivation_hook(__FILE__, array('plugin_midias_sociais', 'deactivate'));
}

/*
 * 	Widget class
 */

class instagran extends WP_Widget {

    public function init() {}

    //contrutor do widget
    public function instagran() {
        parent::WP_Widget('instagran', $name = 'Instagran', array('description' => __('Use este widget para exibir os instagrans.', 'text_domain')));
    }

    //exibicao visitante pagina
    public function widget($args, $inst) {

$instagran = '<div id="instagran" align="center" style="float:left;">
    <img src="'.get_bloginfo('stylesheet_directory').'/img/Instagram.png" alt="" width="35" height="35">
                <span class="maisculas">INSTAGRAM @ANFITRIA</span>
                <br \>
                <iframe src="http://www.instagme.com/in/?u=YW5maXRyaWF8aW58MTg2fDF8NHx8bm98NXx1bmRlZmluZWQ=" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:191px; height: 764px; margin-left: 16px;" ></iframe>
</li>';
                
$instagran .= '</div>';
  echo $instagran;
   }

    //atualiza opcoes
    public function update($new, $old) {
    }

    //exibicao admin pagina
    public function form() {
        echo 'exibe o instagran';
    }

}
?>