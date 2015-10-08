<?php
/**
 * The Template for displaying all single posts.
 *
 * @package elmax
 */

get_header(); ?>

<div id="main">
	
	<section id="content">
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h1 class="post-title"><?php the_title(); ?></h1>
						
			<?php get_template_part( 'inc/meta' ); ?>

			<?php if ( has_post_thumbnail()) : ?>
				<div class="post-thumb">
					<?php the_post_thumbnail('big-thumb'); ?>
				</div>
			 <?php endif; ?>

			<?php the_content(); ?>

			<?php wp_link_pages(); ?>

			<div class="p-tags"><?php the_tags('','',''); ?></div>
			
			<nav class="post-navigation">
				<div class="nav-previous"><?php previous_post_link( '&laquo; %link' ); ?></div>
				<div class="nav-next"><?php next_post_link( '%link &raquo;' ); ?></div>
				<div class="clear"></div>
			</nav>
			
		</article>

	  <?php comments_template(); ?>
	
	  <?php endwhile; endif; ?>
	
	</section>
	
<?php get_sidebar(); ?>

</div><!-- end of main div -->

<?php get_footer(); ?>