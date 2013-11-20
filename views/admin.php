<!-- This file is used to markup the administration form of the widget. -->
<?php 
	global $thumbnailsizes;
	global $posttypes;
	global $categories;
?>

<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget title', 'widget-news-scroller' ) ?></label><br />
	<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p id="posttypelist-<?php echo $this->number; ?>">
	<label for="<?php echo $this->get_field_id( 'posttype' ); ?>"><?php _e( 'Post type', 'widget-news-scroller' ) ?></label><br />
	<select id="<?php echo $this->get_field_id( 'posttype' ); ?>" name="<?php echo $this->get_field_name( 'posttype' ); ?>">
	<?php foreach( $posttypes as $type){ ?>
		<option value="<?php echo $type; ?>" <?php if( $type == $instance['posttype'] ) echo 'selected="selected"'; ?>><?php echo $type; ?></option>
	<?php } ?>
	</select>
</p>

<p id="categorylist-<?php echo $this->number; ?>" class="categorylist">
	<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'widget-news-scroller' ) ?></label><br />
	<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
	<?php foreach( $categories as $category){ ?>
		<option value="<?php echo $category->cat_ID; ?>" <?php if( $category->cat_ID == $instance['category'] ) echo 'selected="selected"'; ?>><?php echo $category->name; ?></option>
	<?php } ?>
	</select>
</p>


<p>
	<label for="<?php echo $this->get_field_id( 'showposts' ); ?>"><?php _e( 'Number of items', 'widget-news-scroller' ) ?></label><br />
	<input type="text" id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" value="<?php echo $instance['showposts']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'excerptlength' ); ?>"><?php _e( 'Length of excerpt', 'widget-news-scroller' ) ?></label><br />
	<input type="text" id="<?php echo $this->get_field_id( 'excerptlength' ); ?>" name="<?php echo $this->get_field_name( 'excerptlength' ); ?>" value="<?php echo $instance['excerptlength']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'thumbnail' ); ?>"><?php _e( 'Display thumbnail', 'widget-news-scroller' ) ?></label><br />
	<select id="<?php echo $this->get_field_id( 'thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail' ); ?>">
	<option value="1" <?php if( 1 == $instance['thumbnail'] ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'widget-news-scroller' ) ?></option>
	<option value="0" <?php if( 0 == $instance['thumbnail'] ) echo 'selected="selected"'; ?>><?php _e( 'No', 'widget-news-scroller' ) ?></option>	
	</select>
</p>

<p id="thumbnailsizelist">
	<label for="<?php echo $this->get_field_id( 'thumbnailsize' ); ?>"><?php _e( 'Thumbnail size', 'widget-news-scroller' ) ?></label><br />
	<select id="<?php echo $this->get_field_id( 'thumbnailsize' ); ?>" name="<?php echo $this->get_field_name( 'thumbnailsize' ); ?>">
	<?php foreach( $thumbnailsizes as $size){ ?>
		<option value="<?php echo $size; ?>" <?php if( $size == $instance['thumbnailsize'] ) echo 'selected="selected"'; ?>><?php echo $size; ?></option>
	<?php } ?>
	</select>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'archiveurl' ); ?>"><?php _e( 'Archive URL', 'widget-news-scroller' ) ?><br /><small><?php _e( 'Leave blank if you don\'t want use it', 'widget-news-scroller' ) ?></small></label><br />
	<input type="text" id="<?php echo $this->get_field_id( 'archiveurl' ); ?>" name="<?php echo $this->get_field_name( 'archiveurl' ); ?>" value="<?php echo $instance['archiveurl']; ?>" />
</p>

<script type="text/javascript">

jQuery('document').ready(function(){
	if( 'post' === jQuery( '#posttypelist-<?php echo $this->number; ?> select option:selected' ).val() )
			jQuery( '#categorylist-<?php echo $this->number; ?>' ).show();
		else
			jQuery( '#categorylist-<?php echo $this->number; ?>' ).hide();
	// Place your administration-specific JavaScript here
	jQuery( '#posttypelist-<?php echo $this->number; ?> select' ).change(function() {
		if( 'post' === jQuery( '#posttypelist-<?php echo $this->number; ?> select option:selected' ).val() )
			jQuery( '#categorylist-<?php echo $this->number; ?>' ).show();
		else
			jQuery( '#categorylist-<?php echo $this->number; ?>' ).hide();
	});
});

</script>

