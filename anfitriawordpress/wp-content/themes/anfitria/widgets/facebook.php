<?php
/*
 * Plugin Name: WP Plugin Facebook
 * Description:
 * Version: 0.1
 * License:
 * License URI:
 * Tags: .
 */

/*
 * 	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'anfitria_widget_facebook');

/*
 * 	Widget registering
 */

function anfitria_widget_facebook() {
    register_widget('facebook');
//    register_activation_hook(__FILE__, array('plugin_midias_sociais', 'activate'));
//    register_deactivation_hook(__FILE__, array('plugin_midias_sociais', 'deactivate'));
}

/*
 * 	Widget class
 */

class facebook extends WP_Widget {

    public function init() {}

    //contrutor do widget
    public function facebook() {
        parent::WP_Widget('facebook', $name = 'Facebook', array('description' => __('Use este widget para exibir os facebooks.', 'text_domain')));
    }

    //exibicao visitante pagina
    public function widget($args, $inst) {
        $facebook = get_option('anfitria_perfil_facebook');
        // $facebook = str_replace('/', '%2F', $facebook);
        // $facebook = str_replace(':', '%3A', $facebook);
        ?>

       
<li id="facebook">
<div class="widget-title"><p>FACEBOOK</p></div>
<div class="fb-like-box fb_iframe_widget" data-href="<?php echo get_option('anfitria_perfil_facebook');?>" data-width="225" data-show-faces="false" data-stream="false" data-header="false" fb-xfbml-state="rendered">
    <span style="height: 62px; width: 225px;">
        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F<?php echo $facebook;?>&amp;width=292&amp;height=62&amp;show_faces=false&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=true&amp;appId=386826764720274" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe>
    </span>
</div>
</li>

<?php
}

    //atualiza opcoes
    public function update($new, $old) {
    }

    //exibicao admin pagina
    public function form() {
        echo 'exibe o facebook';
    }

}
?>