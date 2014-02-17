<?php
/*
 * Plugin Name: WP Plugin Links Anfitria
 * Description:
 * Version: 0.1
 * License:
 * License URI:
 * Tags: .
 */

/*
 * 	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'anfitria_widget_links_anfitria');

/*
 * 	Widget registering
 */

function anfitria_widget_links_anfitria() {
    register_widget('links_anfitria');
//    register_activation_hook(__FILE__, array('plugin_midias_sociais', 'activate'));
//    register_deactivation_hook(__FILE__, array('plugin_midias_sociais', 'deactivate'));
}

/*
 * 	Widget class
 */

class links_anfitria extends WP_Widget {

    public function init() {}

    //contrutor do widget
    public function links_anfitria() {
        parent::WP_Widget('links_anfitria', $name = 'Links Anfitria', array('description' => __('Use este widget para exibir os links_anfitrias.', 'text_domain')));
    }

    //exibicao visitante pagina
    public function widget($args, $inst) {
    	
        $query = array('post_type' => 'links', 'posts_per_page' => 100, 'orderby' => 'title', 'order' =>'ASC');
        query_posts($query);
?>

<li id="links">

    <div class="widget-title"><p>LINKS</p></div>
        <ul>
        
            <?php if (have_posts()) : while (have_posts()) : the_post();?>    
                <li>
                    <a href="<?php $this->theLink();?>" target="_blank" class="maisculas"><?php the_title();?></a>
                </li>
            <?php endwhile;
            wp_reset_query();
            endif;?>
            
        </ul>

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
    
    public function theLink($postID = null) {
    	
    	global $post;
    	$postID = ($postID) ? $postID : $post->ID;
		$value = get_post_meta( $postID, 'link_text_value_key', true );
    	
		echo esc_attr( $value );
		
    }

}
?>