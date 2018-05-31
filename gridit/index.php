<?php get_header(); ?>
		<div id="site-content">
			<div id="post-overlay"></div><!-- postOverlay -->
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'post' ); ?>
		<?php endwhile; endif; ?>
		</div>
<?php get_footer(); ?>