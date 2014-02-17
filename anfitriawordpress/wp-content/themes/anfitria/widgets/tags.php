<?php

add_action('widgets_init', 'anfitria_widget_tags');

function anfitria_widget_tags() {
    register_widget('Tags');
}

class Tags extends WP_Widget {

    public function __construct() {
        parent::WP_Widget('tags', $name = 'Tags', array('description' => __('Use este widget para exibir as Tags.', 'text_domain')));
    }

    public function widget( $args, $instance) {

	echo $args['before_widget']; 

	echo '<li id="tags">';
	$tags = $this->list_tags();

		$this->viewWidget($tags);
	echo '</ul>';
	
	echo '</li>';

	echo $args['after_widget']; 

    }

    public function update( $new_instance, $old_instance ) {
    
    }

    public function form( $instance ) {
	    echo '<p><ul>';
	    echo '<li class="title">tags</li>';
		$tags = get_tags(array('number' => 10));
		$this->viewWidget($tags);
		echo '</ul></p>';
    }

    public function viewWidget( $tags ) {
    	
	    echo '<ul class="taxonomy">';
	    
			echo '<li class="title"><a href="#">tags</a></li>';
	
			foreach ( $tags as $tag ) : ?>
				<li class="tag"><a href="<?php echo get_tag_link($tag->term_id);?>"><?php echo $tag->name;?></a></li>
			<?php endforeach;?>
		
		<?php echo '</ul>';?>

    <?php } //end viewWidget
    
	public function list_tags($termID = 0) {

		$args = array(
		    	'fields'        => 'all',
			'hide_empty' 	=> 0,
			'orderby'	=> 'count',
			'parent'	=> $termID
		); 
		
		return get_terms( 'post_tag', $args );

	}

}
?>