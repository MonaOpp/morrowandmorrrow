<?php
/**
 * Service Sections Component
 *
 * Displays all services with:
 * - 3-column nav links at top (anchored)
 * - Service sections with title, description, and accordion
 */

$services = get_posts([
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_key'       => 'order_of_services',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
]);

if ( empty( $services ) ) {
    return;
}

// ─── Service Navigation (3-column with red pipes) ───
?>
<nav class="service-nav">
    <?php
    $nav_items = [];
    foreach ( $services as $service ) {
        $service_title = get_field( 'service_title', $service->ID );
        $display_name  = $service_title ?: $service->post_title;
        $slug          = sanitize_title( $display_name );
        $nav_items[]   = '<a href="#service-' . esc_attr( $slug ) . '" class="service-nav__link">' . esc_html( $display_name ) . '</a>';
    }
    echo implode( '<span class="service-nav__sep">|</span>', $nav_items );
    ?>
</nav>

<?php
// ─── Service Sections ───
foreach ( $services as $service ) :
    $service_title = get_field( 'service_title', $service->ID );
    $description   = get_field( 'service_description', $service->ID );
    $accordions    = get_field( 'service_accordion', $service->ID );
    $display_name  = $service_title ?: $service->post_title;
    $slug          = sanitize_title( $display_name );
?>
    <section id="service-<?php echo esc_attr( $slug ); ?>" class="service-section">
        <h2 class="service-section__title"><?php echo esc_html( $display_name ); ?></h2>

        <?php if ( $description ) : ?>
            <div class="service-section__description"><?php echo wp_kses_post( $description ); ?></div>
        <?php endif; ?>

        <?php if ( $accordions && is_array( $accordions ) ) : ?>
            <div class="service-accordion">
                <?php foreach ( $accordions as $i => $accordion ) : ?>
                    <div class="service-accordion__item">
                        <button class="service-accordion__trigger" aria-expanded="false">
                            <span><?php echo esc_html( $accordion['accordion_title'] ?? '' ); ?></span>
                            <svg class="service-accordion__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 9l6 6 6-6"/>
                            </svg>
                        </button>
                        <div class="service-accordion__panel">

                            <?php if ( ! empty( $accordion['accordion_descriptions'] ) ) : ?>
                                <div class="service-accordion__text">
                                    <?php echo wp_kses_post( $accordion['accordion_descriptions'] ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $accordion['accordion_blocks'] ) && is_array( $accordion['accordion_blocks'] ) ) : ?>
                                <div class="service-accordion__blocks">
                                    <?php $block_index = 1; ?>
                                    <?php foreach ( $accordion['accordion_blocks'] as $block ) : ?>
                                        <?php if ( ! empty( $block['blocks_list'] ) ) : ?>
                                            <div class="service-accordion__block-card">
                                                <span class="service-accordion__block-num"><?php echo str_pad( $block_index, 2, '0', STR_PAD_LEFT ); ?>.</span>
                                                <span class="service-accordion__block-text"><?php echo esc_html( $block['blocks_list'] ); ?></span>
                                            </div>
                                        <?php $block_index++; endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $accordion['accordion_grid'] ) && is_array( $accordion['accordion_grid'] ) ) : ?>
                                <?php foreach ( $accordion['accordion_grid'] as $grid ) : ?>
                                    <div class="service-accordion__grid">
                                        <?php if ( ! empty( $grid['grid_title'] ) ) : ?>
                                            <h4 class="service-accordion__grid-title"><?php echo esc_html( $grid['grid_title'] ); ?></h4>
                                        <?php endif; ?>

                                        <table class="service-accordion__table">
                                            <thead>
                                                <tr>
                                                    <?php if ( ! empty( $grid['column_1_heading'] ) ) : ?>
                                                        <th><?php echo esc_html( $grid['column_1_heading'] ); ?></th>
                                                    <?php endif; ?>
                                                    <?php if ( ! empty( $grid['column_2_heading'] ) ) : ?>
                                                        <th><?php echo esc_html( $grid['column_2_heading'] ); ?></th>
                                                    <?php endif; ?>
                                                    <?php if ( ! empty( $grid['column_3_heading'] ) ) : ?>
                                                        <th><?php echo esc_html( $grid['column_3_heading'] ); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <?php if ( ! empty( $grid['grid_rows'] ) && is_array( $grid['grid_rows'] ) ) : ?>
                                                <tbody>
                                                    <?php foreach ( $grid['grid_rows'] as $row ) : ?>
                                                        <tr>
                                                            <?php if ( ! empty( $grid['column_1_heading'] ) ) : ?>
                                                                <td><?php echo esc_html( $row['col_1_value'] ?? '' ); ?></td>
                                                            <?php endif; ?>
                                                            <?php if ( ! empty( $grid['column_2_heading'] ) ) : ?>
                                                                <td><?php echo esc_html( $row['col_2_value'] ?? '' ); ?></td>
                                                            <?php endif; ?>
                                                            <?php if ( ! empty( $grid['column_3_heading'] ) ) : ?>
                                                                <td><?php echo esc_html( $row['col_3_value'] ?? '' ); ?></td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            <?php endif; ?>
                                        </table>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
<?php endforeach; ?>
