<?php if ( has_post_thumbnail() ) : ?>
	<?php if(!$post_overlay) : ?>
	<div class="header-img" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, "header"); ?>)"></div>
	<?php endif; ?>
<?php endif; ?>

<h1 class="page-sec-title"> <?php echo $title; ?> </h1>	

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
	<div class="page-social-btn share" data-type="linkedin" data-title="<?php echo get_the_title($post->ID) ?>" data-url="<?php echo get_permalink($post->ID) ?>">
		<span class="fab fa-linkedin" aria-hidden="true" ></span>
		<span class="screen-reader-text">LinkedIn</span>
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

