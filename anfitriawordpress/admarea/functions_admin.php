<?php 

class Admin {
	
	public $categoryID;
	public $postID;
	public $subCateogry;
	public $subCateogryID;
	public $post;
	public $action;
	
	public function __construct($posts) {
				
		$this->categoryID = ( isset($posts['category']) && !empty($posts['category']) ) ? $posts['category'] : 0;
		$this->postID = ( isset($posts['post']) && !empty($posts['post']) ) ? $posts['post'] : 0;
		$this->post = ( $this->postID > 0 ) ? get_post( $this->postID ) : null;
		
		if ($this->post)
			$category = get_the_terms( $this->postID, 'category' );
			$this->categoryID = ($category[0]->parent == 0) ? $category[0]->term_id : $category[0]->parent;
			$this->subCateogryID = ($category[0]->parent > 0) ? $category[0]->term_id : 0;
				
		
		if ($this->categoryID > 0)
			$this->subCateogry = $this->getTermsSelect($this->categoryID);

		$this->action = $posts['action'];
		
	}
	
	public function init($posts) {
		
		if ($this->action == 'sbm_post_update') :
		
			$this->update($posts);
			
		endif;
			
		
	}
	
	public function update($posts) {
		
		$this->post->post_title = $posts['post_title'];
		wp_update_post( $this->post );
		
		if ($posts['sub_category'] != $this->subCateogryID) :
			
			wp_set_post_terms( $this->post->ID, $posts['sub_category'], 'category' );
			$this->subCateogryID = $posts['sub_category'];
			
		else :
		
			if ($posts['sub_category'] != $this->categoryID) :
				wp_set_post_terms( $this->post->ID, $posts['category'], 'category' );
				$this->categoryID = $posts['category'];
			endif;
			
		endif;
		
	}

	public function getTermsSelect($parent = 0) {
		
		$args = array(
		    'orderby'       => 'name', 
		    'order'         => 'ASC', 
		    'fields'        => 'all', 
			'hide_empty'    => false, 
		    'parent'         => $parent
		);
		
		return get_terms( 'category', $args );
		
	}
	
	public function getPostsSelect() {
		
		$args = array(
			'offset'           => 0,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_parent'      => '0'
		);
		
		return get_posts( $args );
		
	}
	
	public function postTitle() {
		
		echo ($this->post) ? $this->post->post_title : '';
		
	}
	
	public function postContent() {
		
		echo ($this->post) ? $this->post->post_content : '';
		
	}
	
	public function postLike() {
		
		echo ($this->post) ? get_like($this->post->ID) : '';
		
	}
	
	public function postTime() {
		
		echo ($this->post) ? $this->post->post_date : '';
		
	}
	
	public function postStatus($status) {
		
		if ( $this->post )
			echo ( $this->post->post_status == $status ) ? 'selected' : '';
		
	}

}


?>