<?php
/**
 * Location Accordion Component
 * 
 * @param array $args {
 *     Optional. Component arguments.
 *     @type string $context Either 'contact' (shows address) or 'professional' (shows linked professionals)
 *     @type int    $location_id Specific location ID (optional)
 * }
 */

$context = $args['context'] ?? 'contact';
$specific_location = $args['location_id'] ?? null;

// Get all locations or specific location
if ($specific_location) {
    $locations = [get_post($specific_location)];
} else {
    $locations = get_posts([
        'post_type' => 'location',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ]);
}

if (empty($locations)) {
    return;
}
?>

<div class="location-accordion" data-context="<?php echo esc_attr($context); ?>">
    <?php foreach ($locations as $index => $location): 
        $location_name = get_field('location_name', $location->ID);
        $location_address = get_field('location_address', $location->ID);
        $image_open = get_field('location_image_open', $location->ID);
        $image_closed = get_field('location_image_closed', $location->ID);
        
        // Get professionals for this location if context is professional
        $professionals = [];
        if ($context === 'professional') {
            $professionals = get_posts([
                'post_type' => 'professional',
                'meta_query' => [
                    [
                        'key' => 'location',
                        'value' => $location->ID,
                        'compare' => '='
                    ]
                ],
                'posts_per_page' => -1
            ]);
        }
    ?>
    
    <div class="location-card" data-location-id="<?php echo $location->ID; ?>">
        <!-- Closed State -->
        <div class="location-closed">
            <div class="location-header">
                <div class="location-content">
                    <h3 class="location-title"><?php echo esc_html($location_name ?: $location->post_title); ?></h3>
                </div>
                <div class="location-image">
                    <?php if ($image_closed): ?>
                        <img src="<?php echo esc_url($image_closed['url']); ?>" 
                             alt="<?php echo esc_attr($location_name ?: $location->post_title); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Open State -->
        <div class="location-open" style="display: none;">
            <div class="location-header-open">
                <div class="location-content-expanded">
                    <h3 class="location-title"><?php echo esc_html($location_name ?: $location->post_title); ?></h3>
                    
                    <?php if ($context === 'contact' && $location_address): ?>
                        <div class="location-details">
                            <div class="location-address">
                                <?php echo wp_kses_post(nl2br($location_address)); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($context === 'professional' && !empty($professionals)): ?>
                        <div class="location-professionals">
                            <h4>Our Team</h4>
                            <div class="professionals-list">
                                <?php foreach ($professionals as $professional): 
                                    $job_title = get_field('job_title', $professional->ID);
                                    $photo = get_field('photo', $professional->ID);
                                ?>
                                <div class="professional-item">
                                    <?php if ($photo): ?>
                                        <img src="<?php echo esc_url($photo['sizes']['thumbnail']); ?>" 
                                             alt="<?php echo esc_attr($professional->post_title); ?>" 
                                             class="professional-photo" />
                                    <?php endif; ?>
                                    <div class="professional-info">
                                        <h5><?php echo esc_html($professional->post_title); ?></h5>
                                        <?php if ($job_title): ?>
                                            <p class="job-title"><?php echo esc_html($job_title); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="location-image-open">
                    <?php if ($image_open): ?>
                        <img src="<?php echo esc_url($image_open['url']); ?>" 
                             alt="<?php echo esc_attr($location_name ?: $location->post_title); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php endforeach; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const accordion = document.querySelector('.location-accordion');
    if (!accordion) return;

    const locationCards = accordion.querySelectorAll('.location-card');

    locationCards.forEach(card => {
        const closedState = card.querySelector('.location-closed');
        const openState = card.querySelector('.location-open');

        closedState.addEventListener('click', function() {
            // Close all other cards
            locationCards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.querySelector('.location-closed').style.display = 'block';
                    otherCard.querySelector('.location-open').style.display = 'none';
                    otherCard.classList.remove('active');
                }
            });

            // Open this card
            closedState.style.display = 'none';
            openState.style.display = 'block';
            card.classList.add('active');
        });

        // Optional: Click to close when open
        openState.addEventListener('click', function() {
            closedState.style.display = 'block';
            openState.style.display = 'none';
            card.classList.remove('active');
        });
    });
});
</script>