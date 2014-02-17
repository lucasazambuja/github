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

$instagran = '<li id="instagran">
                <div class="widget-title"><p>A ANFITRIÃ</p></div>';
                
                $user_id=21211540;$count=4;

    $url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent/?access_token=235976990.f59def8.f7f2b7b39f6d49afb012e98feeffe455&count='.$count;

    // Also Perhaps you should cache the results as the instagram API is slow
    $cache = 'cache/cache.json';
    if(file_exists($cache) && filemtime($cache) > time() - 60*60){
        // If a cache file exists, and it is newer than 1 hour, use it
        $jsonData = json_decode(file_get_contents($cache));
    } else {
        $jsonData = json_decode((file_get_contents($url)));
        file_put_contents($cache,json_encode($jsonData));
    }

	foreach ($jsonData->data as $key=>$value) {
		$instagran .= '<a href="'.$value->link.'" style="display:block;padding-bottom:5px;margin-left:15px" target="_blank"><img src="'.$value->images->low_resolution->url.'" width="200" heigth"200"/></a>';
	}
                
$instagran .= '</li>';
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