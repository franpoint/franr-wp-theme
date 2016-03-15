<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package elmax
 */

get_header(); ?>

<div id="main">

	<section id="content">

		<article class="hentry">		
			<h1><?php _e( '404', 'elmax' ); ?></h1>
			<p><img src="<?php echo get_template_directory_uri()?>/img/404.jpg"></img></p>		
			<p>Because bad news are better with cats</p>
		</article>

	</section><!-- #content -->

<?php get_sidebar(); ?>

</div><!-- end of main div -->

<?php get_footer(); ?>
