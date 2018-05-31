<?php 
	
	$link = get_permalink($post->ID);
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );
	$title = get_the_title($post->ID);	
	$date = get_the_date('M d, Y', $post->ID);	
	$summary = get_the_excerpt($post->ID);	
	$content = get_the_content($post->ID);
	$cat = '';
	$categories = get_the_category($post->ID);

	foreach( $categories as $c ) {
		$cat = $cat . $c->slug . ' ';
	}

	$vidid = get_field('youtube_vidid');
	$playlist = get_field('youtube_playlist');

	$url_override = get_field('url_override');

	$event = get_field('event');
	$event_date = $event['event_date'];
	$event_start_time = $event['event_start_time'];
	$event_end_time = $event['event_end_time'];	

	$post_overlay = false;	
?>
<?php if ( is_single() ) : ?>

	<?php include( locate_template( 'post-content.php', false, false ) ); ?>

<? else: ?>
	<?php 
		$thumb_style = get_field('thumb_style'); 
		$thumb_layout = $thumb_style['thumb_layout']; 
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
			if($el == "event") $show_event = true;
		}
		
		$thumb = get_the_post_thumbnail_url( $post->ID, $thumb_size );
	?>
	<?php if($show_link) : ?>
		<?php if($url_override != "")  : ?>
			<a href="<?php echo $url_override; ?>" target="_blank" data-postid="<?php echo $post->ID; ?>" class="<?php echo $cat; ?>post" >
		<? else: ?>
			<a href="<?php echo $link; ?>" data-postid="<?php echo $post->ID; ?>" class="<?php echo $cat; ?> post" >
		<?php endif; ?>	
	<?php endif; ?>

	<div class="page-thumb <?php echo $thumb_layout; ?>" >
		<?php if($show_img) : ?>
			<div class="img <?php echo $thumb_size; ?>"><img src="<?php echo $thumb; ?>" alt="<?php echo $title; ?>'"/></div><?php endif; ?><div class="info">	
			<?php if($show_title) : ?>
				<h3 class="title"><?php echo $title; ?>
			<?php endif; ?>
			<?php if($show_date) : ?>
				<div class="date"><?php echo $date ; ?></div>
			<?php endif; ?>

			<?php if($show_event) : ?>
				<div class="date"><?php echo $event_date ; ?></div>
				<div class="time"><?php echo $event_start_time ; ?> - <?php echo $event_end_time; ?></div>	
			<?php endif; ?>
			<?php if($show_title) : ?>
				</h3><!-- title -->	
			<?php endif; ?>
			<?php if($show_body) : ?>
				<div class="body"><?php the_content(); ?> </div>
			<?php endif; ?>
			<?php if($show_summary) : ?>
				<div class="body"><?php echo $summary ?></div>
			<?php endif; ?>
		</div><!-- info -->
	</div><!-- page-thumb -->

	<?php if($show_link) : ?>
		</a><!-- a page-thumb -->	
	<?php endif; ?>

	<?php $post_overlay = true; ?>

	<div id="<?php echo $post->ID; ?>" class="post-content" data-hires="<?php echo $img[0]; ?>" data-hires-w="<?php echo $img[1]; ?>" data-hires-h="<?php echo $img[2]; ?>" data-vidid="<?php echo $vidid; ?>" data-playlist="<?php echo $playlist; ?>" data-cat="<?php echo $cat; ?>">
		<?php include( locate_template( 'post-content.php', false, false ) ); ?>
		<div data-id="<?php echo $post->ID; ?>" class="post-close fas fa-times-circle"></div>
		<div class="right-arrow">
			<span class="fas fa-arrow-circle-right" aria-hidden="true" ></span>
		    <span class="screen-reader-text">Next Post</span>
		</div>
		<div class="left-arrow">
			<span class="fas fa-arrow-circle-left" aria-hidden="true" ></span>
		    <span class="screen-reader-text">Back Post</span>
		</div>
	</div><!-- post-content -->
<?php endif; ?>
