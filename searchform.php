<?php
/**
 * Search Form
 * - called by the get_search_form() function
 *
 * @package Wordpress
 * @subpackage Most
 */
?>
<form role="search" method="get" class="form-search" action="<?php echo home_url( '/' ); ?>">
    <label class="sr-only" for="s">Search for:</label>
    <input type="search" value="" name="s" class="search-field input-medium" placeholder="" title="Search for:" />
	<input type="image" value="Search" class="search-btn" src="<?php echo get_template_directory_uri(); ?>/img/button-search.gif" alt="Search MOST" />
</form>