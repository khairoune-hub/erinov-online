
<?php
/**
 * Template for displaying single course
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

$course_id     = get_the_ID();
$course_rating = tutor_utils()->get_course_rating( $course_id );
$is_enrolled   = tutor_utils()->is_enrolled( $course_id, get_current_user_id() );

// Prepare the nav items.
$course_nav_item = apply_filters( 'tutor_course/single/nav_items', tutor_utils()->course_nav_items(), $course_id );
$is_public       = \TUTOR\Course_List::is_public( $course_id );
$is_mobile       = wp_is_mobile();

$enrollment_box_position = tutor_utils()->get_option( 'enrollment_box_position_in_mobile', 'bottom' );
if ( '-1' === $enrollment_box_position ) {
	$enrollment_box_position = 'bottom';
}
$student_must_login_to_view_course = tutor_utils()->get_option( 'student_must_login_to_view_course' );

tutor_utils()->tutor_custom_header();

if ( ! is_user_logged_in() && ! $is_public && $student_must_login_to_view_course ) {
	tutor_load_template( 'login' );
	tutor_utils()->tutor_custom_footer();
	return;
}
?>

<!-- Add custom CSS for styling and animations -->
<style>
    /* Enhanced Course Header */
    .tutor-course-details-header {
        background: linear-gradient(to right, rgba(27, 182, 180, 0.1), rgba(27, 182, 180, 0.05));
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(27, 182, 180, 0.1);
        transition: all 0.4s ease;
    }
    
    .tutor-course-details-header:hover {
        box-shadow: 0 6px 20px rgba(27, 182, 180, 0.15);
    }
    
    .tutor-course-details-title {
        font-size: 2.5rem !important;
        color: #1BB6B4 !important;
        margin-bottom: 1rem;
        font-weight: 700 !important;
        line-height: 1.2;
    }
    
    /* Button Animation */
    .tutor-btn {
        transition: all 0.3s ease !important;
        position: relative;
        overflow: hidden;
    }
    
    .tutor-btn:hover {
        background-color: #1BB6B4 !important;
        transform: translateY(-3px);
        color: white !important;
    }
    
    .tutor-btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transition: all 0.5s ease;
    }
    
    .tutor-btn:hover::after {
        left: 100%;
    }
    
    /* Course tab links */
    .tutor-nav-link {
        border-bottom: 2px solid transparent;
        transition: all 0.3s ease;
    }
    
    .tutor-nav-link.is-active, 
    .tutor-nav-link:hover {
        color: #1BB6B4 !important;
        border-bottom-color: #1BB6B4;
    }
    
    /* Course entry box */
    .tutor-course-sidebar-card {
        border-top: 3px solid #1BB6B4;
        transition: all 0.4s ease;
    }
    
    .tutor-course-sidebar-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    /* Category links styling */
    .tutor-course-details-info a {
        color: #1BB6B4;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .tutor-course-details-info a:hover {
        text-decoration: underline;
    }
    
    /* Star rating color */
    .tutor-icon-star-line {
        color: #1BB6B4;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .tutor-animate-fade-in {
        animation: fadeIn 0.6s ease forwards;
    }

    /* Enhanced Course Content Section */
    .tutor-accordion-item {
        margin-bottom: 1rem;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .tutor-accordion-item:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .tutor-accordion-item-header {
        background-color: #1BB6B4;
        color: white;
        padding: 1rem;
        font-size: 1.25rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.3s ease;
    }

    .tutor-accordion-item-header.is-active {
        background-color: #159a98;
    }

    .tutor-accordion-item-header::after {
        content: '\25BC';
        font-size: 0.8rem;
        transition: transform 0.3s ease;
    }

    .tutor-accordion-item-header.is-active::after {
        transform: rotate(180deg);
    }

    .tutor-accordion-item-body {
        background-color: #f9f9f9;
        padding: 1rem;
        border-top: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .tutor-accordion-item-body-content {
        padding: 0.5rem;
    }

    .tutor-course-content-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tutor-course-content-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e0e0e0;
        transition: background-color 0.3s ease;
    }

    .tutor-course-content-list-item:last-child {
        border-bottom: none;
    }

    .tutor-course-content-list-item:hover {
        background-color: #f0f0f0;
    }

    .tutor-course-content-list-item-icon {
        font-size: 1.2rem;
        color: #1BB6B4;
    }

    .tutor-course-content-list-item-title {
        font-size: 1rem;
        font-weight: 500;
        color: #333;
        margin: 0;
    }

    .tutor-course-content-list-item-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .tutor-course-content-list-item-title a:hover {
        color: #1BB6B4;
    }

    .tutor-course-content-list-item-duration {
        font-size: 0.875rem;
        color: #666;
    }

    .tutor-course-content-list-item-status {
        font-size: 1rem;
        color: #666;
    }
</style>

<?php do_action( 'tutor_course/single/before/wrap' ); ?>
<div <?php tutor_post_class( 'tutor-full-width-course-top tutor-course-top-info tutor-page-wrap tutor-wrap-parent' ); ?>>
	<div class="tutor-course-details-page tutor-container">
		<?php ( isset( $is_enrolled ) && $is_enrolled ) ? tutor_course_enrolled_lead_info() : tutor_course_lead_info(); ?>
		<div class="tutor-row tutor-gx-xl-5">
			<main class="tutor-col-xl-8">
				<?php tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
				<?php do_action( 'tutor_course/single/before/inner-wrap' ); ?>

				<?php if ( $is_mobile && 'top' === $enrollment_box_position ) : ?>
					<div class="tutor-mt-32">
											<?php tutor_load_template( 'single.course.course-entry-box' ); ?>
					</div>
				<?php endif; ?>

				<div class="tutor-course-details-tab tutor-mt-32">
					<?php if ( is_array( $course_nav_item ) && count( $course_nav_item ) > 1 ) : ?>
						<div class="tutor-is-sticky">
							<?php tutor_load_template( 'single.course.enrolled.nav', array( 'course_nav_item' => $course_nav_item ) ); ?>
						</div>
					<?php endif; ?>
					<div class="tutor-tab tutor-pt-24">
						<?php foreach ( $course_nav_item as $key => $subpage ) : ?>
							<div id="tutor-course-details-tab-<?php echo esc_attr( $key ); ?>" class="tutor-tab-item<?php echo 'info' == $key ? ' is-active' : ''; ?>">
								<?php
									do_action( 'tutor_course/single/tab/' . $key . '/before' );

									$method = $subpage['method'];
								if ( is_string( $method ) ) {
									$method();
								} else {
									$_object = $method[0];
									$_method = $method[1];
									$_object->$_method( get_the_ID() );
								}

									do_action( 'tutor_course/single/tab/' . $key . '/after' );
								?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php do_action( 'tutor_course/single/after/inner-wrap' ); ?>
			</main>

			<aside class="tutor-col-xl-4">
				<?php $sidebar_attr = apply_filters( 'tutor_course_details_sidebar_attr', '' ); ?>
				<div class="tutor-single-course-sidebar tutor-mt-40 tutor-mt-xl-0" <?php echo esc_attr( $sidebar_attr ); ?> >
					<?php do_action( 'tutor_course/single/before/sidebar' ); ?>

					<?php if ( ( $is_mobile && 'bottom' === $enrollment_box_position ) || ! $is_mobile ) : ?>
						<?php tutor_load_template( 'single.course.course-entry-box' ); ?>
					<?php endif ?>

					<div class="tutor-single-course-sidebar-more tutor-mt-24">
						<?php tutor_course_instructors_html(); ?>
						<?php tutor_course_requirements_html(); ?>
						<?php tutor_course_tags_html(); ?>
						<?php tutor_course_target_audience_html(); ?>
					</div>

					<?php do_action( 'tutor_course/single/after/sidebar' ); ?>
				</div>
			</aside>
		</div>
	</div>
</div>

<script>
// Add animation classes to buttons and elements
document.addEventListener('DOMContentLoaded', function() {
    // Add animation classes to header elements
    const courseHeader = document.querySelector('.tutor-course-details-header');
    if (courseHeader) {
        courseHeader.classList.add('tutor-animate-fade-in');
    }
    
    const courseTitle = document.querySelector('.tutor-course-details-title');
    if (courseTitle) {
        courseTitle.classList.add('tutor-animate-fade-in');
        courseTitle.style.animationDelay = '0.2s';
    }
    
    // Apply animation to all buttons
    const buttons = document.querySelectorAll('.tutor-btn');
    buttons.forEach(function(button, index) {
        button.classList.add('tutor-animate-fade-in');
        button.style.animationDelay = (0.3 + (index * 0.1)) + 's';
    });
    
    // Apply primary color to all primary buttons
    const primaryButtons = document.querySelectorAll('.tutor-btn-primary');
    primaryButtons.forEach(function(button) {
        button.style.backgroundColor = '#1BB6B4';
        button.style.borderColor = '#1BB6B4';
    });
    
    // Apply color to all outline buttons
    const outlineButtons = document.querySelectorAll('.tutor-btn-outline-primary');
    outlineButtons.forEach(function(button) {
        button.style.borderColor = '#1BB6B4';
        button.style.color = '#1BB6B4';
    });
    
    // Animate course sidebar card
    const sidebarCard = document.querySelector('.tutor-course-sidebar-card');
    if (sidebarCard) {
        sidebarCard.classList.add('tutor-animate-fade-in');
        sidebarCard.style.animationDelay = '0.4s';
    }
    
    // Animate ratings section
    const ratingsSection = document.querySelector('.tutor-course-details-ratings');
    if (ratingsSection) {
        ratingsSection.classList.add('tutor-animate-fade-in');
        ratingsSection.style.animationDelay = '0.1s';
    }
    
    // Animate course details top section
    const courseDetailsTop = document.querySelector('.tutor-course-details-top');
    if (courseDetailsTop) {
        courseDetailsTop.classList.add('tutor-animate-fade-in');
        courseDetailsTop.style.animationDelay = '0.3s';
    }

    // Remove the share button from the header
    const shareButton = document.querySelector('.tutor-course-share-btn');
    if (shareButton) {
        shareButton.remove();
    }
});
</script>

<?php do_action( 'tutor_course/single/after/wrap' ); ?>

<?php
tutor_utils()->tutor_custom_footer();
