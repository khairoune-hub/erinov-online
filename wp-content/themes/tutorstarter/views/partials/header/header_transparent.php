<?php

/**
 * Header transparent
 */

use Tutor\Ecommerce\CartController;
use Tutor_Starter\Traits\Header_Components;

/**
 * For php8.1&8.2 compatibility
 */
class Header_COMP {
	use Header_Components;
}
$obj = new Header_COMP();
?>

<!-- Add Expo Arabic font via Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Search popup for .header-transparent -->
<div class="search-field-popup">
	<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
		<div>
			<button class="close-btn">+</button>
			<input type="search" name="s" value="<?php echo get_search_query(); ?>"
				placeholder="<?php esc_attr_e('Search...', 'tutorstarter'); ?>" />
		</div>
	</form>
</div>

<header
	class="header-transparent <?php echo true === get_theme_mod('header_sticky_toggle') ? 'header-sticky' : ''; ?>">
	<nav class="navbar <?php echo tutorstarter_header_switcher(); ?>">
		<div class="navbar-brand">
			<?php tutorstarter_transparent_logo(); ?>
		</div>
		<?php if (has_nav_menu('primary')) : ?>
			<button class="navbar-toggler">
				<div class="toggle-icon"><span></span></div>
			</button>
		<?php endif; ?>
		<?php
		if (has_nav_menu('primary')) :
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'navbar-nav',
				)
			);
		endif;
		?>
		<?php
		if (defined('TUTOR_VERSION')) {
		?>
		<div class="navbar-utils">
			<?php if (true === get_theme_mod('header_search_toggle')) : ?>
				<div class="utils-search">
					<button class="btn-search">
						<svg xmlns="http://www.w3.org/2000/svg" width="19" height="190" viewBox="0 0 19 19" fill="none">
							<path
								d="M11.3839 11.6808C12.3661 10.6987 12.8571 9.51934 12.8571 8.14286C12.8571 6.76637 12.3661 5.59077 11.3839 4.61607C10.4092 3.63393 9.23363 3.14286 7.85714 3.14286C6.48066 3.14286 5.30134 3.63393 4.3192 4.61607C3.34449 5.59077 2.85714 6.76637 2.85714 8.14286C2.85714 9.51934 3.34449 10.6987 4.3192 11.6808C5.30134 12.6555 6.48066 13.1429 7.85714 13.1429C9.23363 13.1429 10.4092 12.6555 11.3839 11.6808ZM18.5714 17.4286C18.5714 17.8155 18.4301 18.1503 18.1473 18.433C17.8646 18.7158 17.5298 18.8571 17.1429 18.8571C16.7411 18.8571 16.4063 18.7158 16.1384 18.433L12.3103 14.6161C10.9784 15.5387 9.49405 16 7.85714 16C6.79316 16 5.77381 15.7954 4.79911 15.3862C3.83185 14.9695 2.99479 14.4115 2.28795 13.7121C1.58854 13.0052 1.03051 12.1682 0.613839 11.2009C0.204613 10.2262 0 9.20684 0 8.14286C0 7.07887 0.204613 6.06324 0.613839 5.09598C1.03051 4.12128 1.58854 3.28423 2.28795 2.58482C2.99479 1.87798 3.83185 1.31994 4.79911 0.910713C5.77381 0.494047 6.79316 0.285713 7.85714 0.285713C8.92113 0.285713 9.93676 0.494047 10.904 0.910713C11.8787 1.31994 12.7158 1.87798 13.4152 2.58482C14.122 3.28423 14.6801 4.12128 15.0893 5.09598C15.506 6.06324 15.7143 7.07887 15.7143 8.14286C15.7143 9.77976 15.253 11.2641 14.3304 12.596L18.1585 16.4241C18.4338 16.6994 18.5714 17.0342 18.5714 17.4286Z"
								fill="white" />
						</svg>
					</button>
				</div>
			<?php endif; ?>
		</div>
		<?php } ?>
	</nav>
</header>
