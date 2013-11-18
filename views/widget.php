<div id="widget-news-scroller" class="widget-news-scroller">
<ul>
<?php
	$args = array('showposts' => $instance['showposts'], 'post_type' => 'post');
	$the_query = new WP_Query( $args );
	while ( $the_query->have_posts() ) : $the_query->the_post(); 
?>
<li class="wns-item">
	<?php 
		if( 1 == $instance['thumbnail'] ){
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), $instance['thumbnailsize'] );
			if(!empty($thumbnail[0])){ 
	?>
			<div class="wns-item-img">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<img src="<?php echo $thumbnail[0]; ?>" alt="<?php the_title(); ?>" />
				</a>
			</div><!-- item-img -->
	<?php
			}
		}
	?>
	<div class="wns-item-content">
		<?php the_title(); ?>
		<?php the_excerpt(); ?>
	</div><!-- item-content -->
</li><!-- item -->
<?php
endwhile; // End the loop.
wp_reset_postdata();
?>
</ul>
<a id="prev" class="wns-prev" href="javascript:void(0)" title="<?php _e( '&lt; prev', 'widget-news-scroller' ) ?>"><?php _e( '&lt; prev', 'widget-news-scroller' ) ?></a>
<a id="next" class="wns-next" href="javascript:void(0)" title="<?php _e( 'next &gt;', 'widget-news-scroller' ) ?>"><?php _e( 'next &gt;', 'widget-news-scroller' ) ?></a>
</div><!-- #widget-news-scroller -->

<?php print_r($instance); ?>