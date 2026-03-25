<?php
/**
 * Location Accordion Component
 * 
 * Simple horizontal accordion component with hover effects
 */

// Get all locations
$locations = get_posts([
    'post_type' => 'location',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
]);

if (empty($locations)) {
    return;
}
?>

<div class="location-accordion">
    <?php foreach ($locations as $location): 
        $location_name = get_field('location_name', $location->ID);
        $image_closed = get_field('location_image_closed', $location->ID);
        $image_open = get_field('location_image_open', $location->ID);

        // Get professionals linked to this location via ACF Relationship field
        $professionals = get_field('professional_location', $location->ID);
    ?>
    
    <div class="location-card">
        <div class="location-header">
            <div class="location-content">
                <h2 class="location-title"><?php echo esc_html($location_name ?: $location->post_title); ?></h2>
                
                <?php if (!empty($professionals)): ?>
                    <div class="location-professionals">
                        <?php foreach ($professionals as $professional): 
                            $prof_name = get_the_title($professional);
                            $prof_thumbnail = get_the_post_thumbnail_url($professional, 'thumbnail');
                        ?>
                            <div class="professional-item ">
                                <?php if ($prof_thumbnail): ?>
                                    <img src="<?php echo esc_url($prof_thumbnail); ?>" 
                                         alt="<?php echo esc_attr($prof_name); ?>" 
                                         class="professional-photo" />
                                <?php endif; ?>
                                <span class="professional-name "><?php echo esc_html($prof_name); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ($image_closed): ?>
                <div class="location-image">
                    <img src="<?php echo esc_url($image_closed['url']); ?>" 
                         alt="<?php echo esc_attr($location_name ?: $location->post_title); ?>" />
                </div>
            <?php endif; ?>

            <?php if ($image_open): ?>
                <div class="location-image-open">
                    <img src="<?php echo esc_url($image_open['url']); ?>" 
                         alt="<?php echo esc_attr($location_name ?: $location->post_title); ?> - open" />
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php endforeach; ?>
</div>