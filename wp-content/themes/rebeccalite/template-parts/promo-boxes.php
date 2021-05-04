<?php
if ( get_theme_mod( 'rebeccalite_promo_boxes_show' ) ) {
    ?>
    <div class="rebeccalite-promo-boxes">
        <div class="row">
            <?php for ( $i = 1; $i <= 3; $i++ ) { ?>
            <div class="col-lg-4">
                <div class="promo-box-item" style="background-image: url('<?php echo esc_url( get_theme_mod( "rebeccalite_promo_box_image_{$i}" ) ); ?>');">
                    <a href="<?php echo esc_url( get_theme_mod( "rebeccalite_promo_box_link_{$i}" ) ); ?>"><?php echo esc_html( get_theme_mod( "rebeccalite_promo_box_title_{$i}" ) ); ?></a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
}
