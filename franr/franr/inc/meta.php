<?php
/**
 * This template generates the meta information below each post. 
 * Link to Author, Date, Number of comments
 * List which category and tags are associated with this post
 *
 * @package elmax
 */
?>
<div class="entrymeta">
	<p>
    <!--
    <i class="fa fa-user"></i> <span><?php the_author();?></span> 
    -->
    <i class="fa fa-calendar"></i> <span><?php the_time( 'j M Y' ); ?></span> 
    <i class="fa fa-folder-open"></i> <span><?php the_category(', ');?></span>
    <i class="fa fa-comments"></i> <span><?php comments_popup_link( 'No Comments', '1 Comment', '% Comments' ); ?></span>
    <br/>
      <i class="fa fa-tags"></i> <span><?php the_tags('',', ','');?></span>
    
  </p>
</div>