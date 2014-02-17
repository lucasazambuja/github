<?php


function register_anfitria_list_category_widget() {
    register_widget( 'ListCategory' );
}

add_action( 'widgets_init', 'register_anfitria_list_category_widget' );

/**
 * Adds Foo_Widget widget.
 */
class ListCategory extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		 parent::WP_Widget('anfitrialistcategory', $name = 'Anfitria List Category', array('description' => __('Use este widget para exibir algumas categorias e sub categorias.', 'text_domain')));
	}

	public function widget( $args, $instance ) {
		
		echo $this->viewWidget($this->list_terms(), $instance);	
		
	}

	public function form( $instance ) {

		$terms = $this->list_terms();
		var_dump($instance[$this->getFieldCategory( $terms[1] )]);
		$this->formView($terms, $instance);

	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$terms = $this->list_terms();

		foreach ($terms as $term) {
			$field = $this->getFieldCategory( $term );
			$instance[$field] = ( $new_instance[$field] != NULL) ? 'true' : 'false';
		}

		return $instance;

	}

	public function viewWidget( $terms, $instance ) { ?>
	
		<li id="taxonomy-widget">
		<div class="widget-title"><p>Categorias</p></div>
		
			<ul>
	
			<?php foreach ($terms as $term) : $field = $this->getFieldCategory($term);?>
	
					<li>
						<ul class="taxonomy">
							<li class="title"><?php echo $this->getLink(get_term_link($term), $term->name); ?></li>
							<?php $this->listChildren($term->term_id); ?>
						</ul>
					</li>
	
			<?php endforeach;?>
			
			</ul>
		
		</li>

	<?php }

	public function listChildren( $id, $before = '<li>', $after = '</li>' ) {
		$terms = $this->list_terms( $id );
		foreach ($terms as $term)
			echo $before . $this->getLink(get_term_link($term), $term->name) . $after;
	}

	public function getLink( $url, $view ) {
		return '<a href="' . esc_url($url) . '">' . $view . '</a>';
	}

	public function the_field_id( $field ) {
		echo $this->get_field_id( $field );
	}

	public function the_field_name ( $field ) {
		echo $this->get_field_name( $field );
	}

	public function formView( $terms, $instance ) { ?>

		<p>
		<?php foreach ($terms as $term) : $field = $this->getFieldCategory($term);?>
			<input type="checkbox" name="<?php $this->the_field_name($field); ?>" id="<?php $this->the_field_id($field); ?>" value="<?php echo $instance[$field]; ?>" <?php echo $this->checkField($instance[$field]); ?> ><?php echo $term->name; ?><br>
		<?php endforeach;?>
		</p>

	<?php }

	public function checkField( $value ) {
		return ($value == 'true') ? 'checked' : '';
	}

	public function getFieldCategory ( $term ) {
		return 'taxonomy_field_' . $term->term_id;
	}

	public function list_terms($termID = 0) {

		$args = array(
	    'fields'        => 'all',
		'hide_empty' 	=> 0,
		'parent'		=> $termID
		); 
		
		return get_terms( 'category', $args );

	}
	
	public function list_tags($termID = 0) {

		$args = array(
		    'fields'        => 'all',
			'hide_empty' 	=> 0,
			'number'		=> 10,
			'orderby'	=> 'count',
			'parent'		=> $termID
		); 
		
		return get_terms( 'post_tag', $args );

	}
	
	 public function viewWidgetTags( $tags ) {
    	
	    echo '<ul class="taxonomy">';
	    
			echo '<li class="title"><a href="#">tags</a></li>';
	
			foreach ( $tags as $tag ) : ?>
				<li class="tag"><a href="<?php echo get_tag_link($tag->term_id);?>"><?php echo $tag->name;?></a></li>
			<?php endforeach;?>
		
		<?php echo '</ul>';?>

    <?php } //end viewWidget

} // class ListCategory

?>