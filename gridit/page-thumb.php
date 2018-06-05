<?php
	$link = get_permalink($post->ID);
	$title = get_the_title($post->ID);	
	$date = get_the_date('M d, Y', $post->ID);	
	$body = get_the_content($post->ID);
	$summary = get_the_excerpt($post->ID);	
	$cat = get_the_category($post->ID);
	$cat = $cat[0]->slug;

	$vidid = get_field('youtube_vidid');
	$playlist = get_field('youtube_playlist');

	$thumb = get_the_post_thumbnail_url( $post->ID, $thumb_size );
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );
	
	?>
	<?php if($show_link) : ?>
		<a href="<?php echo $link; ?>" data-postid="<?php echo $post->ID; ?>" class="<?php echo $cat; ?> post" >	
	<?php endif; ?>
		<div class="page-thumb <?php echo $thumb_layout; ?>" >
		<?php if($show_img) : ?>
			<div class="img <?php echo $thumb_size; ?>">
				<img src="<?php echo $thumb ; ?>" alt="<?php echo $title; ?>"/>
			</div>	<!-- page-thumb -->
			<?php if($show_title || $show_date || $show_body || $show_summary) : ?>
				<div class="info">	
					<?php if($show_title) : ?>
						<h3 class="title"><?php echo $title; ?>	
					<?php endif; ?>
					<?php if($show_date) : ?>
						<div class="date"><?php echo $date; ?></div>	
					<?php endif; ?>
					<?php if($show_title) : ?>
						</h3><!-- title -->	
					<?php endif; ?>
					<?php if($show_body) : ?>
						<div class="body"><?php echo the_content(); ?></div><!-- pageThumbBody -->
					<?php endif; ?>
					<?php if($show_summary) : ?>
						<div class="body"><?php echo $summary; ?></div><!-- pageThumbBody -->
					<?php endif; ?>
				</div><!-- info -->
			<?php endif; ?>	
		<?php endif; ?>				
		</div><!-- page-thumb -->
	<?php if($show_link) : ?>
		</a>	
	<?php endif; ?>