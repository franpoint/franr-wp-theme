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
			<h1><?php _e( 'Oops... File or page not found.', 'elmax' ); ?></h1>
			<p><?php _e( 'We have recently made changes to our website and the page you are looking for might have been deleted or moved. Please', 'elmax' ); ?> <a href="<?php esc_url (home_url('/')); ?>"><?php _e( 'visit our home page instead', 'elmax' ); ?></a>.</p>
			<p><?php _e( 'Sorry for the inconvenience', 'elmax' ); ?>.</p>		
		</article>

	</section><!-- #content -->

<?php get_sidebar(); ?>

</div><!-- end of main div -->

<?php get_footer(); ?>
