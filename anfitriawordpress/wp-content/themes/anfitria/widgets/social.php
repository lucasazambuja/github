<?php

add_action('widgets_init', 'anfitria_widget_social');

function anfitria_widget_social() {
    register_widget('Social');
}

class Social extends WP_Widget {

	function __construct() {
		 parent::WP_Widget('anfitriasocial', $name = 'Anfitria Social', array('description' => __('Use este widget para exibir as redes sociais.', 'text_domain')));
	}

    public function widget($args, $inst) {

		$this->viewWidget();

    }

    public function update($new, $old) {

    }

    public function form() {
        echo 'exibe as redes sociais';
    }

    public function viewWidget() {?>
    
    <li id="social-widget">
		<ul>
			<li class="instagram"><a href="#">@anfitria</a></li>
			<li class="facebook"><a href="#">/bloganfitria</a></li>
			<li class="youtube"><a href="#">/bloganfitria</a></li>
			<li class="vimeo"><a href="#">/bloganfitria</a></li>
		</ul>
	</li>
	
    <?php }

}
?>
