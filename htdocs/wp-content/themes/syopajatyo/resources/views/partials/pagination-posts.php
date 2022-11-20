<?php
/**
 * Posts pagination.
 *
 * @package Syopajatyo
 */
?>

<div class="pagination-wrapper container">
    <?php the_posts_pagination(
        [
            'prev_text'          => Syopajatyo\get_svg( [ 'icon' => 'arrow-left' ] ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'syopajatyo' ) . '</span>',
            'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'syopajatyo' ) . '</span>' . Syopajatyo\get_svg( [ 'icon' => 'arrow-right' ] ),
            'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'syopajatyo' ) . ' </span>',
        ]
    ); ?>
</div>
