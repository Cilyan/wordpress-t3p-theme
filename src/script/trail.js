import $ from 'jquery';
import wp from 'wordpress';

var meta_image_frame = null;

// React to add image link
$('#t3p-trail-icon-set').on('click', function(e){
  // Prevents the default action from occuring.
  e.preventDefault();

  // If the frame already exists, re-open it.
  if ( meta_image_frame ) {
    meta_image_frame.open();
    return;
  }

  // Sets up the media library frame
  meta_image_frame = wp.media({
    title: trail_icon_params.title,
    button: { text:  trail_icon_params.button },
    library: { type: 'image' },
    multiple: false
  });

  // When an image is selected in the media frame...
  meta_image_frame.on('select', function() {
    // Get media attachment details from the frame state
    var attachment = meta_image_frame.state().get('selection').first().toJSON();
    // Send the attachment URL to our custom image input field.
    $('#t3p-trail-icon-set').html('<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>');
    // Send the attachment id to our hidden input
    $('#t3p-meta-trail-icon').val(attachment.id);
    // Show hidden elements
    $('#t3p-trail-icon-desc').removeClass('hidden');
    $('#t3p-trail-icon-remove').removeClass('hidden');
  });

  // Opens the media library frame.
  meta_image_frame.open();
});

// React to delete image link
$('#t3p-trail-icon-remove').on('click', function(e){
   e.preventDefault();

  // Clear out the preview image
  $('#t3p-trail-icon-set').html(trail_icon_params.set_icon_text);
  // Remove attachment id to our hidden input
  $('#t3p-meta-trail-icon').val(-1);
  // Hide elements
  $('#t3p-trail-icon-desc').addClass('hidden');
  $('#t3p-trail-icon-remove').addClass('hidden');
});
