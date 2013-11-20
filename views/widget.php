<div id="widget-news-scroller-<?php echo $this->number; ?>" class="widget-news-scroller">
<?php 
	if( !empty($instance[ 'title' ]) )
		echo '<h3>' . $instance['title'] . '</h3>';
?>

<ul>
<?php
	if( !empty($instance[ 'category' ]) && 'post' == $instance['posttype'] )
		$args = array('showposts' => $instance['showposts'], 'post_type' => 'post', 'cat' =>  $instance['category'] );
	else
		$args = array('showposts' => $instance['showposts'], 'post_type' => $instance['posttype'] );	
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
		<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
		<?php echo get_custom_excerpt( $instance['excerptlength'] ); ?>
	</div><!-- item-content -->
</li><!-- item -->
<?php
endwhile; // End the loop.
wp_reset_query();
?>
</ul>
<a id="prev-<?php echo $this->number; ?>" class="wns-prev" href="javascript:void(0)" title="<?php _e( '&lt; prev', 'widget-news-scroller' ) ?>"><?php _e( '&lt; prev', 'widget-news-scroller' ) ?></a>
<a id="next-<?php echo $this->number; ?>" class="wns-next" href="javascript:void(0)" title="<?php _e( 'next &gt;', 'widget-news-scroller' ) ?>"><?php _e( 'next &gt;', 'widget-news-scroller' ) ?></a>
<?php if( !empty( $instance['archiveurl'] ) ): ?>
	<a id="archiveurl-<?php echo $this->number; ?>" class="wns-archiveurl" href="<?php echo $instance['archiveurl']; ?>" title="<?php _e( 'Go to archive &gt;', 'widget-news-scroller' ) ?>"><?php _e( 'Go to archive &gt;', 'widget-news-scroller' ) ?></a>
<?php endif; ?>


</div><!-- #widget-news-scroller -->

<script type="text/javascript">
jQuery( "document" ).ready( function($){
	
		/*	CarouFredSel: a circular, responsive jQuery carousel.
			Configuration created by the "Configuration Robot"
			at caroufredsel.dev7studios.com
		*/
		jQuery("#<?php echo $this->id; ?> ul").carouFredSel({
			circular: false,
			infinite: false,
			responsive: true,
			items: {
				visible: 1
			},
			auto: false,
			prev: "#prev-<?php echo $this->number; ?>",
			next: "#next-<?php echo $this->number; ?>"
		});
	});	
</script>