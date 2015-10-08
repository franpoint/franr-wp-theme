<?php
/**
 * Master Template. This template will be used to display your blog posts and pages if page.php does not exist.
 *
 * @package elmax
 */

get_header(); ?>

<div id="main">
	
	<section id="content">
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if( is_sticky() ) { ?> <span class="sticky-post"><?php _e('Sticky Post', 'elmax'); ?></span> <?php } ?>
			<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
			<?php get_template_part( 'inc/meta' ); ?>

			<?php if ( has_post_thumbnail()) : ?>
				<div class="post-thumb">
					   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						   <?php the_post_thumbnail('big-thumb'); ?>
					   </a>
				</div>
			 <?php endif; ?>

			<?php the_excerpt(); ?>

			<div class="clear"></div>
		</article>
		
	<?php endwhile; endif; ?>
	
	<?php get_template_part( 'inc/nav' ); ?>
	
	</section><!-- #content -->

<?php get_sidebar(); ?>

</div><!-- #main -->

<?php get_footer(); ?>