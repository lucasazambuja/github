<?php
/*
 * Plugin Name: WP Plugin Destaque
 * Description:
 * Version: 0.1
 * License:
 * License URI:
 * Tags: .
 */

/*
 * 	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'anfitria_widget_destaque');

/*
 * 	Widget registering
 */

function anfitria_widget_destaque() {
    register_widget('destaque');
//    register_activation_hook(__FILE__, array('plugin_midias_sociais', 'activate'));
//    register_deactivation_hook(__FILE__, array('plugin_midias_sociais', 'deactivate'));
}

/*
 * 	Widget class
 */

class destaque extends WP_Widget {

    public function init() {}

    //contrutor do widget
    public function destaque() {
        parent::WP_Widget('destaque', $name = 'Destaque', array('description' => __('Use este widget para exibir os destaques.', 'text_domain')));
    }

    //exibicao visitante pagina
    public function widget($args, $inst) {
        
?>

<li id="destaque">

<div class="widget-title"><p>DESTAQUES</p></div>
	 
	 <?php $query = $this->getDestak();?>
	 
	 <?php if ( $query->have_posts() ) :?>
	 	<ul>
	 	<?php while ( $query->have_posts() ) : $query->the_post();?>
	 		<li id="destaque">
				<div class="content">
					<img src="<?php $this->theUrlThumbFull();?>">
					<div class="mask">
					<span>
						<a href="<?php $this->theLinkTerm();?>"><?php the_title();?></a>
					</span>
					</div>
				</div>
	 		</li>
	 	<?php endwhile;?>
	 	</ul>
	 <?php endif;?>
	 
	 
</li>

<?php
}

	public function getDestak() {
		
		// WP_Query arguments
		$args = array (
			'post_type'              => 'destaque',
			'post_status'            => 'publish',
			'pagination'             => false,
			'posts_per_page'         => '100',
		);
	
		// The Query
		return new WP_Query( $args );
	
	}
	
	public function theUrlThumbFull($postID = null) {
		
		global $post;
		
		$postID = (!$postID) ? $post->ID : $postID;
		$thumb_id = get_post_thumbnail_id($postID);
		
		$thumb_url = wp_get_attachment_image_src($thumb_id, false);
		echo esc_url ($thumb_url[0]);
		
	}
	public function theLinkTerm($postID = null) {
		
		global $post;
		$postID = ($postID) ? $postID : $post->ID;
		$value = get_post_meta( $postID, 'link_value_key_destak', true );	
		
		$term = get_term( $value, 'category');
		echo esc_url ( get_term_link( $term, $taxonomy ) );
		
	}

    //atualiza opcoes
    public function update($new, $old) {
    
    }

    //exibicao admin pagina
    public function form() {
        echo 'exibe os destaques';
    }

}
?>