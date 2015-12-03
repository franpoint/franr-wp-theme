<?php
/**
 * elmax functions and definitions
 *
 * @package elmax
 */


add_action( 'after_setup_theme', 'elmax_theme_setup' );
function elmax_theme_setup() {

	global $content_width;
	/* Set the $content_width for things such as video embeds. */
	if ( !isset( $content_width ) )
	$content_width = 680;
	
	add_theme_support( 'title-tag' );

	/* Add theme support for automatic feed links. */
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );

	/* Add theme support for post thumbnails (featured images). */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'small-thumb', 300, 225 );
	add_image_size( 'big-thumb', 680, 300, true );
}

/* Add your nav menus function to the 'init' action hook. */
   add_action( 'init', 'elmax_register_menus' );

/* Add custom actions. */
   add_action( 'widgets_init', 'elmax_register_sidebars' );


// Add menu features 
function elmax_register_menus() {
	register_nav_menus(array('primary'=>__( 'Primary Menu' ), ));
}

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function elmax_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'elmax_page_menu_args' );

function elmax_register_sidebars() {
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Primary Sidebar', 'elmax' ),
			'description' => __( 'The following widgets will appear in the main sidebar div.', 'elmax' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		)
	);
}

/**
 * Enqueue scripts and styles
 */

function elmax_scripts() {

	if ( ! is_admin() ) {
 
		wp_enqueue_style( 'style', get_stylesheet_uri() );
	
		wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Muli|Rokkitt:700' );

 		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', null, '4.0.1' );

		wp_enqueue_script( 'elmax_navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

		wp_enqueue_script( 'elmax-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'elmax_scripts' );

//Set up title if SEO plugin is not used.

function franr_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Init with the site name.
	//$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && !strpos($title,$site_description) && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'elmax' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'franr_wp_title', 10, 2 );

function elmax_wp_pagination() {
global $wp_query;
$big = 12345678;
$page_format = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'type'  => 'array'
) );
if( is_array($page_format) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div><ul>';
            foreach ( $page_format as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul></div>';
}
}

function elmax_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'elmax_excerpt_length', 999 );

function elmax_excerpt_more($more) {
       global $post;
	return '...<span class="read-more"><a href="'. get_permalink($post->ID) . '">Continue Reading &rarr;</a></span>';
}
add_filter('excerpt_more', 'elmax_excerpt_more');

if ( ! function_exists( 'elmax_wp_render_title_tag' ) ) {
	function elmax_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	//add_action( 'wp_head', 'elmax_render_title' );
}
	
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'elmax_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function elmax_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
        // Include WP Product Review plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'WP Product Review',
            'slug'      => 'wp-product-review',
            'required'  => false,
        ),
        
        // Include Revive Old Post plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Revive Old Post',
            'slug'      => 'tweet-old-post',
            'required'  => false,
        ),
 
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}
