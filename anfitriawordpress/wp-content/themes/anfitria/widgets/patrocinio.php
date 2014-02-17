<?php
/*
 * Plugin Name: WP Plugin Patrocinio
 * Description:
 * Version: 0.1
 * License:
 * License URI:
 * Tags: .
 */

/*
 * 	Add function to widgets_init that'll load the widget
 */
add_action('widgets_init', 'anfitria_widget_patrocinio');

/*
 * 	Widget registering
 */

function anfitria_widget_patrocinio() {
    register_widget('patrocinio');
}

/*
 * 	Widget class
 */

class patrocinio extends WP_Widget {

    public function init() {}

    //contrutor do widget
    public function patrocinio() {
        parent::WP_Widget('patrocinio', $name = 'Patrocinio', array('description' => __('Use este widget para exibir os patrocinios.', 'text_domain')));
    }

    //exibicao visitante pagina
    public function widget($args, $inst) {
    	
    	// WP_Query arguments
		$args = array (
			'post_type'              => 'patrocinio',
			'post_status'            => 'publish',
			'posts_per_page'         => '1000',
			'order'                  => 'ASC'
		);
		
		// The Query
		$query = new WP_Query( $args ); ?>
		
		<?php if ( $query->have_posts() ) : ?>
		
		<li id="widget-patrocinio">
		
			<ul>
			
			<?php while ( $query->have_posts() ): $query->the_post();?>
			
				<li><a href="<?php $this->theLink();?>" target="_blank"><img src="<?php $this->theUrlThumbFull();?>"></a></li>
				
			<?php endwhile;?>
			
			</ul>
			
		</li>
			
		<?php else : ?>
			
		<?php endif;?>
		
	<?php
		wp_reset_postdata();
    	

    }

    //atualiza opcoes
    public function update($new, $old) {
    	
    }

    //exibicao admin pagina
    public function form() {
        echo '<p> exibe os patrocinios </p>';
    }
    
    public function theLink($postID = null) {
    	
    	global $post;
		$postID = (!$postID) ? $post->ID : $postID;
		
		$value = get_post_meta( $postID, 'link_text_value_key', true );
		echo esc_url( $value );
    	
    }
    
	function theUrlThumbFull($postID = null) {
		
		global $post;
		
		$postID = (!$postID) ? $post->ID : $postID;
		$thumb_id = get_post_thumbnail_id($postID);
		
		$thumb_url = wp_get_attachment_image_src($thumb_id, false);
		echo esc_url ($thumb_url[0]);
		
	}

}
?>