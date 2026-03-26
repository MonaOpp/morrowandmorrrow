<?php
/**
 * Professional Cards Component
 *
 * Displays professionals grouped by taxonomy "professional-type".
 * - "professionals" slug: alternating large cards (odd = image left, even = image right)
 * - "multidisciplinary" slug: compact grid cards
 */

$taxonomy = 'professional-type';

// Get all terms in the professional-type taxonomy
$terms = get_terms([
    'taxonomy'   => $taxonomy,
    'hide_empty' => true,
    'orderby'    => 'slug',
    'order'      => 'DESC', // "professionals" before "multidisciplinary" alphabetically reversed
]);

if ( is_wp_error( $terms ) || empty( $terms ) ) {
    return;
}

foreach ( $terms as $term ) :

    $professionals = get_posts([
        'post_type'      => 'professionals',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'tax_query'      => [
            [
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $term->slug,
            ],
        ],
    ]);

    if ( empty( $professionals ) ) {
        continue;
    }

    if ( $term->slug === 'professionals' ) :
        // ─── Large alternating cards layout ───
        ?>
        <div class="professionals-section">
            <?php
            $index = 0;
            foreach ( $professionals as $professional ) :
                $image       = get_field( 'professional_image', $professional->ID );
                $name        = get_field( 'professional_name', $professional->ID );
                $title       = get_field( 'professional_title', $professional->ID );
                $description = get_field( 'professional_description', $professional->ID );
                $email       = get_field( 'professional_email_', $professional->ID );
                $tel         = get_field( 'professional_tell', $professional->ID );
                $cell        = get_field( 'professional_cell', $professional->ID );

                $is_even     = ( $index % 2 === 1 );
                $card_class  = $is_even ? 'prof-card--reversed' : '';
                $index++;
            ?>
                <div class="prof-card <?php echo esc_attr( $card_class ); ?>">
                    <div class="prof-card__body">
                        <!-- Name & Title inside body, above the two columns -->
                        <div class="prof-card__header">
                            <h3 class="prof-card__name"><?php echo esc_html( $name ?: $professional->post_title ); ?></h3>
                            <?php if ( $title ) : ?>
                                <p class="prof-card__title"><?php
                                    $title_parts = preg_split('/\r\n|\r|\n/', trim( $title ));
                                    $formatted = array_map(function($part) { return esc_html( trim( $part ) ); }, $title_parts);
                                    $formatted = array_filter($formatted);
                                    echo implode(' <span class="prof-card__title-sep">|</span> ', $formatted);
                                ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="prof-card__columns">
                        <div class="prof-card__image-col">
                            <div class="prof-card__image">
                                <?php if ( $image ) : ?>
                                    <img src="<?php echo esc_url( is_array( $image ) ? $image['url'] : $image ); ?>"
                                         alt="<?php echo esc_attr( $name ?: $professional->post_title ); ?>" />
                                <?php endif; ?>
                            </div>
                            <?php if ( $email ) : ?>
                                <div class="prof-card__email">
                                    <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="prof-card__content">
                            <?php if ( $description ) : ?>
                                <div class="prof-card__description"><?php echo wp_kses_post( $description ); ?></div>
                            <?php endif; ?>

                            <div class="prof-card__contact">
                                <?php if ( $tel ) : ?>
                                    <span class="prof-card__contact-item">
                                        Tell : <?php echo esc_html( $tel ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $cell ) : ?>
                                    <span class="prof-card__contact-item">
                                        Cell : <?php echo esc_html( $cell ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        </div><!-- .prof-card__columns -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php
    elseif ( $term->slug === 'multidisciplinary' ) :
        // ─── Compact grid cards layout ───
        ?>
        <h2 class="text-7xl font-bold text-primary mb-10 mt-10 uppercase">OUR DEDICATED MULTIDISCIPLINARY TEAM</h2>
        <div class="professionals-multi-section">
            <div class="professionals-multi-grid">
                <?php foreach ( $professionals as $professional ) :
                    $image = get_field( 'professional_image', $professional->ID );
                    $name  = get_field( 'professional_name', $professional->ID );
                    $title = get_field( 'professional_title', $professional->ID );
                ?>
                    <div class="prof-mini-card">
                        <div class="prof-mini-card__image">
                            <?php if ( $image ) : ?>
                                <img src="<?php echo esc_url( is_array( $image ) ? $image['url'] : $image ); ?>"
                                     alt="<?php echo esc_attr( $name ?: $professional->post_title ); ?>" />
                            <?php endif; ?>
                            <div class="prof-mini-card__overlay">
                                <h3 class="prof-mini-card__name"><?php echo esc_html( $name ?: $professional->post_title ); ?></h3>
                                <?php if ( $title ) : ?>
                                    <p class="prof-mini-card__title"><?php echo esc_html( $title ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php
    endif;

endforeach;
