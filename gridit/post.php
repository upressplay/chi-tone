<?php 
	
	$link = get_permalink($post->ID);
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );
	$title = get_the_title($post->ID);	
	$date = get_the_date('M d, Y', $post->ID);	
	$summary = get_the_excerpt($post->ID);	
	$content = get_the_content($post->ID);
	$cat = get_the_category($post->ID);
	$cat = $cat[0]->slug;

	$vidid = get_field('youtube_vidid');
	$playlist = get_field('youtube_playlist');

	$url_override = get_field('url_override');

	$event = get_field('event');
	$event_date = $event['event_date'];
	$event_start_time = $event['event_start_time'];
	$event_end_time = $event['event_end_time'];		
?>
<?php if ( is_single() ) : ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="header-img" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, "header"); ?>)"></div>
	<?php endif; ?>

	<?php if( !is_front_page() ) : ?>
		<h1 class="page-sec-title"> <?php echo $title; ?> </h1>	
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
	</div><!-- page-share -->
	
    <div class="page-links">
	    <?php if ( have_rows('post_links') ) : while( have_rows('post_links') ) : the_row(); ?>

		<a href="<?php echo get_sub_field('post_link'); ?>" target="_blank" class="pageLink">
			<?php echo get_sub_field('post_link_text'); ?>
		</a>
		<?php endwhile; endif; ?>
	</div>

    	<div class="page-body">
    		<?php the_content(); ?>
    	</div><!-- page-body -->	

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
		//$img = get_the_post_thumbnail_url( $post->ID );
	?>
	<?php if($show_link) : ?>
		<?php if($url_override != "")  : ?>
			<a href="<?php echo $url_override; ?>" target="_blank" data-postid="<?php echo $post->ID; ?>" class="<?php echo $cat; ?> post" >
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
<?php endif; ?>
