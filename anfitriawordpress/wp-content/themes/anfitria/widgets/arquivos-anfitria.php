<?php
/*
 * Plugin Name: WP Plugin Arquivos Anfitria
 * Description:
 * Version: 0.1
 * License:
 * License URI:
 * Tags: .
 */

/*
 * 	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'anfitria_widget_arquivos_anfitria');

/*
 * 	Widget registering
 */

function anfitria_widget_arquivos_anfitria() {
    register_widget('arquivos_anfitria');
//    register_activation_hook(__FILE__, array('plugin_midias_sociais', 'activate'));
//    register_deactivation_hook(__FILE__, array('plugin_midias_sociais', 'deactivate'));
}

/*
 * 	Widget class
 */

class arquivos_anfitria extends WP_Widget {

    public function init() {}

    //contrutor do widget
    public function arquivos_anfitria() {
        parent::WP_Widget('arquivos_anfitria', $name = 'Arquivos Anfitria', array('description' => __('Use este widget para exibir os arquivos_anfitrias.', 'text_domain')));
    }

    //exibicao visitante pagina
    public function widget($args, $inst) {?>

<li id="arquivos">

    <div class="widget-title"><p>Arquivos</p></div>
    
<form id="archiveform" action="">
<select name="archive_chrono" onchange="window.location =
(document.forms.archiveform.archive_chrono[document.forms.archiveform.archive_chrono.selectedIndex].value);">
    <option id="options" value=''>SELECIONE</option>
<?php get_archives('monthly','','option'); ?>
</select>
</form>

</li>

    <?php
    }

    //atualiza opcoes
    public function update($new, $old) {
    }

    //exibicao admin pagina
    public function form() {
        echo '<p>Para configurar os contatos acesse as configurações do tema.<a href="' . get_bloginfo('url') . '/wp-admin/admin.php?page=dozeweb_theme_social_settings">Social Settings</a></p>';
    }

}
?>