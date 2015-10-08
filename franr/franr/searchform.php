<?php
/**
 * The template generates your search form
 *
 * @package elmax
 */
?>

<form method="get" id="searchform" action="<?php esc_url (home_url('/')); ?>">
	<label for="s" class="screen-reader-text">Search for:</label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'elmax'); ?>" />
</form>
