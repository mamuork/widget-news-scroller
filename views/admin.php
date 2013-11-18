<!-- This file is used to markup the administration form of the widget. -->
<?php 
	global $thumbnailsizes;
	
?>

<p>
	<label for="<?php echo $this->get_field_id( 'showposts' ); ?>"><?php _e( 'Number of items', 'widget-news-scroller' ) ?></label>
	<input type="text" id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" value="<?php echo $instance['showposts']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'excerptlength' ); ?>"><?php _e( 'Length of excerpt', 'widget-news-scroller' ) ?></label>
	<input type="text" id="<?php echo $this->get_field_id( 'excerptlength' ); ?>" name="<?php echo $this->get_field_name( 'excerptlength' ); ?>" value="<?php echo $instance['excerptlength']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'thumbnail' ); ?>"><?php _e( 'Display thumbnail', 'widget-news-scroller' ) ?></label>
	<select id="<?php echo $this->get_field_id( 'thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail' ); ?>">
	<option value="1" <?php if( 1 == $instance['thumbnail'] ) echo 'selected="selected"'; ?>><?php _e( 'Yes', 'widget-news-scroller' ) ?></option>
	<option value="0" <?php if( 0 == $instance['thumbnail'] ) echo 'selected="selected"'; ?>><?php _e( 'No', 'widget-news-scroller' ) ?></option>	
	</select>
</p>


<p>
	<label for="<?php echo $this->get_field_id( 'thumbnailsize' ); ?>"><?php _e( 'Thumbnail size', 'widget-news-scroller' ) ?></label>
	<select id="<?php echo $this->get_field_id( 'thumbnailsize' ); ?>" name="<?php echo $this->get_field_name( 'thumbnailsize' ); ?>">

	<?php foreach( $thumbnailsizes as $size){ ?>
		<option value="<?php echo $size; ?>" <?php if( $size == $instance['thumbnailsize'] ) echo 'selected="selected"'; ?>><?php echo $size; ?></option>
	<?php } ?>
	</select>
</p>

