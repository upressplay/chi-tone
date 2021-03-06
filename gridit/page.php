<?php  get_header(); 
	$section_link = get_sub_field('section_page');
	$page_poster = get_field('page_poster');
?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post();?>	
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="header-img" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, "header"); ?>)"></div>
		<?php endif; ?>

		<?php if(!is_front_page() ) : ?>
			<h1 class="page-sec-title"><?php echo get_the_title() ?> </h1>	
		<?php endif; ?>
			<div class="page-share">
				SHARE: 
				<div class="page-social-btn share" data-type="facebook" data-title="<?php echo get_the_title($post->ID) ?>" data-url="<?php echo get_permalink($post->ID) ?>">
					<span class="fab fa-facebook-square" aria-hidden="true" ></span>
					<span class="screen-reader-text">Facebook</span>
				</div>
				<div class="page-social-btn share" data-type="twitter" data-title="<?php echo get_the_title($post->ID) ?>" data-url="<?php echo get_permalink($post->ID) ?>">
					<span class="fab fa-twitter-square" aria-hidden="true" ></span>
					<span class="screen-reader-text">Twitter</span>
				</div>
			</div><!-- pageShare -->
			<?php if( have_rows('page_links') ) : ?>
				<div class="page-links">
					<?php while( have_rows('page_links') ) : the_row(); ?>
						<?php if( get_sub_field('page_link_icon') !== "" ) : ?>
							<div class="social-btn share">
	                          <span class="<?php echo get_sub_field('page_link_icon'); ?>" aria-hidden="true" ></span>
	                          <span class="screen-reader-text"><?php echo get_sub_field('page_link_txt'); ?></span>
	                        </div>
						<?php else: ?>
						<a href="<?php echo get_sub_field('page_link'); ?>" target="_blank" class="page-link">
							<?php echo get_sub_field('page_link_txt'); ?>
						</a>
						<?php endif; ?>	
					<?php endwhile; ?>	
				</div><!-- pageLinks -->
			<?php endif; ?>	

			<?php echo $content; ?>

		<?php $content = get_the_content($post->ID); if(!empty_content($content)) : ?>
    		<div class="page-body">
    		<?php the_content(); ?>
    		</div><!-- pageBody -->
    	<?php endif; ?>	

    	<?php if( have_rows('page_gallery') ) : while( have_rows('page_gallery') ) : the_row(); ?>

    		<?php if( get_sub_field('section_title') != "") : ?>
    			<?php if( get_sub_field('section_page') != "") : ?>
    				<div class="page-sec-title-link">
    					<a href="<?php echo get_sub_field('section_page'); ?>">
    						<h2 class="page-sec-title">
    							<?php echo get_sub_field('section_title'); ?>
    						</h2><!-- pageSecTitle -->
    					</a>
    				</div><!-- pageSecTitleLink -->
    			<?php else: ?>	
    				<h2 class="page-sec-title"> <?php echo get_sub_field('section_title'); ?> </h2>
    			<?php endif; ?>	

    		<?php endif; ?>	
    		<?php 
    			$thumb_style = get_sub_field('thumb_style'); 
		       	$thumb_size = $thumb_style['thumb_size'];
		       	$show_img = false;
	       		$show_title = false;
	       		$show_date = false;
	       		$show_body = false;
	       		$show_summary = false;
	       		$show_link = false;

	       		foreach( $thumb_style['thumb_elements'] as $el ) {
	       			if($el == "img") $show_img = true;
	       			if($el == "title") $show_title = true;
	       			if($el == "date") $show_date = true;
	       			if($el == "body") $show_body = true;
	       			if($el == "summary") $show_summary = true;
	       			if($el == "link") $show_link = true;
	       		}

	       		$thumb_layout = $thumb_style['thumb_layout']; 
	       		
	       		$post_objects = get_sub_field('page_objects');
    		?>
    		<div class="page-row">	

    			<?php foreach ( $post_objects as $post_object ) {
						foreach ( $post_object as $post) {
							setup_postdata( $post );

							include( locate_template( 'page-thumb.php', false, false ) ); 

							wp_reset_postdata();	
						}
					} ?>
    		</div><!-- pageRow -->
    	<?php endwhile; ?>	

    	<?php endif; ?>		
    	<div id="post-overlay"></div><!-- postOverlay -->
		<?php 
			
			$cats = get_categories();

			foreach ( $cats as $cat ) {

				 $cat_name =$cat->name;

				 if( is_page($cat_name)) {
					global $post;
					$args = array( 'category_name' => $cat_name,  'numberposts' => 100, );
					$output  .=  '<div class="page-row">'; 
					$category_posts = get_posts( $args );

					$posts_count = count($category_posts);
					foreach ( $category_posts as $post ) {
						setup_postdata( $post ); 
						$show_link = true;
						$show_img = true;
		       			$show_title = true;
		       			$show_date = true;
		       			$show_body = false;
		       			$show_summary = true;
		       			$thumb_size = 'pageThumbRect';
		       			$thumb_layout = "Vert";
		       			if($cat_name == "News") {
		       				$thumb_size = 'pageThumbSq';
		       				$thumb_layout = "Horz";	
		       			}

		       			if($cat_name == "Gallery") {
		       				$thumb_size = 'pageThumbSqSm';
		       				$thumb_layout = "Sm";
		       				$show_title = false;
		       				$show_date = false;
		       				$show_summary = false;
		       			}
		       			if($cat_name == "Team") {
		       				$show_link = false;
		       				$show_date = false;
		       				$thumb_size = 'pageThumbSq';
		       				$thumb_layout = "Horz";	
		       			}
		       			if($cat_name == "Services") {
		       				$show_link = false;
		       				$show_date = false;
		       				$show_body = true;
		       				$show_summary = false;
		       			}

						include( locate_template( 'page-thumb.php', false, false ) ); 	

					}
					$output  .=  '</div>'; 
					wp_reset_postdata();
				}
			}
			echo $output;
?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>