<?php
/**
 * Media template tags.
 *
 * Media template functions. These functions are meant to handle various features
 * needed in theme templates for media and attachments.
 *
 * @package   HybridCore
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2018, Justin Tadlock
 * @link      https://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid;

use Hybrid\MediaGrabber\MediaGrabber;
use Hybrid\MediaMeta\Repository as MediaMetaRepository;

/**
 * Returns a media grabber object. This is just a wrapper for the class.
 *
 * @since  5.0.0
 * @access public
 * @param  array   $args
 * @return object
 */
function media_grabber( $args = [] ) {

	return new MediaGrabber( $args );
}

/**
 * Prints the post media from the media grabber.
 *
 * @since  5.0.0
 * @access public
 * @param  array   $args
 * @return void
 */
function post_media( $args = [] ) {

	media_grabber( $args )->render();
}

/**
 * Getter function for grabbing the post media.
 *
 * @since  5.0.0
 * @access public
 * @param  array   $args
 * @return string
 */
function get_post_media( $args = [] ) {

	return media_grabber( $args )->fetch();
}

/**
 * Returns an instance of a media meta repository based on the attachment ID.
 *
 * @since  5.0.0
 * @access public
 * @param  int    $post_id
 * @return object
 */
function media_meta_repo( $post_id ) {

	$repositories = app( 'media_meta' );

	if ( ! $repositories->has( $post_id ) ) {

		$repositories[ $post_id ] = new MediaMetaRepository( $post_id );
	}

	return $repositories[ $post_id ];
}

/**
 * Prints media meta directly to the screen.
 *
 * @since  5.0.0
 * @access public
 * @param  string  $property
 * @param  array   $args
 * @return void
 */
function media_meta( $property, $args = [] ) {

	echo get_media_meta( $property, $args );
}

/**
 * Returns media meta from a media meta object.
 *
 * @since  5.0.0
 * @access public
 * @param  string  $property
 * @param  array   $args
 * @return string
 */
function get_media_meta( $property, $args = [] ) {

	$html = '';

	$args = wp_parse_args( $args, [
		'post_id' => get_the_ID(),
		'itemtag' => 'span',
		'label'   => '',
		'text'    => '%s',
		'before'  => '',
		'after'   => ''
	] );

	// Get the media meta repository for this post.
	$meta_object = media_meta_repo( $args['post_id'] );

	// Retrieve the meta value that we want from the repository.
	$meta = is_object( $meta_object ) ? $meta_object->get( $property )->fetch() : '';

	if ( $meta ) {

		$label = $args['label'] ? sprintf( '<span class="media-meta__label">%s</span> ', $args['label'] ) : '';

		$data = '<span class="media-meta__data">' . sprintf( $args['text'], $meta ) . '</span>';

		$html = sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			tag_escape( $args['itemtag'] ),
			esc_attr( "media-meta__item media-meta__item--{$property}" ),
			$label . $data
		);

		$html = $args['before'] . $html . $args['after'];
	}

	return $html;
}

/**
 * Splits the attachment mime type into two distinct parts: type / subtype
 * (e.g., image / png). Returns an array of the parts.
 *
 * @since  5.0.0
 * @access public
 * @param  int    $post_id
 * @return array
 */
function get_attachment_types( $post_id = 0 ) {

	$post_id = empty( $post_id ) ? get_the_ID() : $post_id;
	$mime    = get_post_mime_type( $post_id );

	list( $type, $subtype ) = false !== strpos( $mime, '/' ) ? explode( '/', $mime ) : [ $mime, '' ];

	return (object) [ 'type' => $type, 'subtype' => $subtype ];
}

/**
 * Returns the main attachment mime type.  For example, `image` when the file
 * has an `image / jpeg` mime type.
 *
 * @since  5.0.0
 * @access public
 * @param  int    $post_id
 * @return string
 */
function get_attachment_type( $post_id = 0 ) {

	return get_attachment_types( $post_id )->type;
}

/**
 * Returns the attachment mime subtype.  For example, `jpeg` when the file has
 * an `image / jpeg` mime type.
 *
 * @since  5.0.0
 * @access public
 * @param  int    $post_id
 * @return string
 */
function get_attachment_subtype( $post_id = 0 ) {

	return get_attachment_types( $post_id )->subtype;
}

/**
 * Checks if the current post has a mime type of 'audio'.
 *
 * @since  5.0.0
 * @access public
 * @param  int    $post_id
 * @return bool
 */
function attachment_is_audio( $post_id = 0 ) {

	return 'audio' === get_attachment_type( $post_id );
}

/**
 * Checks if the current post has a mime type of 'video'.
 *
 * @since  5.0.0
 * @access public
 * @param  int    $post_id
 * @return bool
 */
function attachment_is_video( $post_id = 0 ) {

	return 'video' === get_attachment_type( $post_id );
}

/**
 * Returns a set of image attachment links based on size.
 *
 * @since  5.0.0
 * @access public
 * @return string
 */
function get_image_size_links() {

	// If not viewing an image attachment page, return.
	if ( ! wp_attachment_is_image( get_the_ID() ) ) {
		return;
	}

	// Set up an empty array for the links.
	$links = [];

	// Get the intermediate image sizes and add the full size to the array.
	$sizes   = get_intermediate_image_sizes();
	$sizes[] = 'full';

	// Loop through each of the image sizes.
	foreach ( $sizes as $size ) {

		// Get the image source, width, height, and whether it's intermediate.
		$image = wp_get_attachment_image_src( get_the_ID(), $size );

		// Add the link to the array if there's an image and if $is_intermediate (4th array value) is true or full size.
		if ( ! empty( $image ) && ( true === $image[3] || 'full' == $size ) ) {

			$label = sprintf(
				// Translators: Media dimensions - 1 is width and 2 is height.
				esc_html__( '%1$s &#215; %2$s', 'hybrid-core' ),
				number_format_i18n( absint( $image[1] ) ),
				number_format_i18n( absint( $image[2] ) )
			);

			$links[] = sprintf(
				'<a href="%s" class="image-size-link">%s</a>',
				esc_url( $image[0] ),
				$label
			);
		}
	}

	// Join the links in a string and return.
	return join( ' <span class="sep">/</span> ', $links );
}

/**
 * Gets the "transcript" for an audio attachment.  This is typically saved as
 * "unsynchronised_lyric", which is the ID3 tag sanitized by WordPress.
 *
 * @since  5.0.0
 * @access public
 * @param  int     $post_id
 * @return string
 */
function get_audio_transcript( $post_id = 0 ) {

	return get_media_meta( 'lyrics', [
		'wrap'    => '',
		'post_id' => $post_id ?: get_the_ID()
	] );
}

/**
 * Loads the correct function for handling attachments.  Checks the attachment
 * mime type to call correct function. Image attachments are not loaded with
 * this function.  The functionality for them should be handled by the theme's
 * attachment or image attachment file.
 *
 * Ideally, all attachments would be appropriately handled within their
 * templates. However, this could lead to messy template files.
 *
 * @since  5.0.0
 * @access public
 * @return void
 */
function attachment() {

	$type = get_attachment_type();
	$mime = get_post_mime_type();
	$url  = wp_get_attachment_url();
	$func = __NAMESPACE__ . "\\{$type}_attachment";

	$attachment = function_exists( $func ) ? call_user_func( $func, $mime, $url ) : '';

	echo apply_filters(
		'hybrid/attachment',
		apply_filters( "hybrid/{$type}_attachment", $attachment )
	);
}

/**
 * Handles application attachments on their attachment pages.  Uses the `<object>`
 * tag to embed media on those pages.
 *
 * @since  5.0.0
 * @access public
 * @param  string $mime attachment mime type
 * @param  string $file attachment file URL
 * @return string
 */
function application_attachment( $mime = '', $file = '' ) {
	$embed_defaults = wp_embed_defaults();

	return sprintf(
		'<object type="%1$s" data="%2$s" width="%3$s" height="%4$s"><param name="src" value="%2$s" /></object>',
		esc_attr( $mime ),
		esc_url( $file ),
		absint( $embed_defaults['width'] ),
		absint( $embed_defaults['height'] )
	);
}

/**
 * Handles text attachments on their attachment pages.  Uses the `<object>`
 * element to embed media in the pages.
 *
 * @since  5.0.0
 * @access public
 * @param  string $mime attachment mime type
 * @param  string $file attachment file URL
 * @return string
 */
function text_attachment( $mime = '', $file = '' ) {
	$embed_defaults = wp_embed_defaults();

	return sprintf(
		'<object type="%1$s" data="%2$s" width="%3$s" height="%4$s"><param name="src" value="%2$s" /></object>',
		esc_attr( $mime ),
		esc_url( $file ),
		absint( $embed_defaults['width'] ),
		absint( $embed_defaults['height'] )
	);
}

/**
 * Handles the output of the media for audio attachment posts. This should be
 * used within The Loop.
 *
 * @since  5.0.0
 * @access public
 * @return string
 */
function audio_attachment() {

	return get_post_media( [ 'type' => 'audio' ] );
}

/**
 * Handles the output of the media for video attachment posts. This should be
 * used within The Loop.
 *
 * @since  5.0.0
 * @access public
 * @return string
 */
function video_attachment() {

	return get_post_media( [ 'type' => 'video' ] );
}
