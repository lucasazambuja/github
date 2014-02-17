<?php
/*
 * Plugin Name: WP Plugin Perfil
 * Description:
 * Version: 0.1
 * License:
 * License URI:
 * Tags: .
 */

/*
 * 	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'anfitria_widget_perfil');

/*
 * 	Widget registering
 */

function anfitria_widget_perfil() {
    register_widget('perfil');
//    register_activation_hook(__FILE__, array('plugin_midias_sociais', 'activate'));
//    register_deactivation_hook(__FILE__, array('plugin_midias_sociais', 'deactivate'));
}

/*
 * 	Widget class
 */

class perfil extends WP_Widget {

    public function init() {}

    //contrutor do widget
    public function perfil() {
        parent::WP_Widget('perfil', $name = 'Perfil', array('description' => __('Use este widget para exibir os perfils.', 'text_domain')));
    }

    //exibicao visitante pagina
    public function widget($args, $inst) {
$perfil .= '<li id="perfil"> 
                <div class="widget-title"><p>A ANFITRIÃ</p></div>
                
                   <div id="perfil-header">
	                <div id="attachment-perfil"><img src="' . get_template_directory_uri () . '/img/perfil.jpg"></div>
	           </div>
	           
	           <div id="content-perfil">
	           
		        <p>Celebrar momentos...</p>
				<p>Isso faz parte da minha vida!</p>
				<p>E divido tudo com minhas Leitoras!</p>
				<p>Escrevo para todas que amam ser Anfitriã como eu,</p>
				<p>o que está relacionado a muito carinho, pois somente o AMOR pode estar envolvido em RECEBER EM CASA.</p> 
				<p>Aqui há muito de meus sentimentos e emoção,</p>
				<p>minhas fotos refletem o amor pelo que faço!</p>
				<p>Minhas Leitoras me inspiram através dos lindos recados que me enviam, </p>
				<p>e comemoram sempre comigo, tornando os momentos ainda mais especiais!</p>
				<p>Uma boa dose de inspiração para todos!</p>
				<p>Priscilla Marques</p>
	           
	           </div>
                
			</li>';
	echo $perfil; 
    }

    //atualiza opcoes
    public function update($new, $old) {
    }

    //exibicao admin pagina
    public function form() {
        echo 'exibe o perfil';
    }

}
?>