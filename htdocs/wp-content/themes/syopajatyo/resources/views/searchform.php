<?php
/**
 * Template for displaying search forms
 *
 * @package Syopajatyo
 */

?>

<?php $syopajatyo_unique_id = uniqid( 'search-form-' ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $syopajatyo_unique_id ); ?>">
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'syopajatyo' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr( $syopajatyo_unique_id ); ?>" class="search-form__field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'syopajatyo' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-form__submit"><?php echo Syopajatyo\get_svg( [ 'icon' => 'search' ] ); ?><span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', 'syopajatyo' ); ?></span></button>
</form>
