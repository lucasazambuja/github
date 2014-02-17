<?php
/*
 * Plugin Name: WP Plugin Video
 * Description:
 * Version: 0.1
 * License:
 * License URI:
 * Tags: .
 */

/*
 * 	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'anfitria_widget_video');

/*
 * 	Widget registering
 */

function anfitria_widget_video() {
    register_widget('video');
//    register_activation_hook(__FILE__, array('plugin_midias_sociais', 'activate'));
//    register_deactivation_hook(__FILE__, array('plugin_midias_sociais', 'deactivate'));
}

/*
 * 	Widget class
 */

class video extends WP_Widget {

    public function init() {}

    //contrutor do widget
    public function video() {
        parent::WP_Widget('video', $name = 'Video', array('description' => __('Use este widget para exibir os videos.', 'text_domain')));
    }

    //exibicao visitante pagina
    public function widget($args, $inst) {

$video .= '<li id="video">
			   <div class="widget-title"><p>Videos Anfitria</p></div>
			   <a href="http://www.anfitria.com.br/para-minhas-queridas-leitoras/"><div class="mask"></div><object width="250" height="169"><param name="movie" value="//www.youtube.com/v/VI0MpEiBOqc?version=3&amp;hl=pt_BR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/VI0MpEiBOqc?version=3&amp;hl=pt_BR" type="application/x-shockwave-flash" width="250" height="169" allowscriptaccess="always" allowfullscreen="true"></embed></object></a>
		   </li>';
  echo $video;
   }


    //atualiza opcoes
    public function update($new, $old) {
    }

    //exibicao admin pagina
    public function form() {
        echo 'exibe o video';
    }

}
?>