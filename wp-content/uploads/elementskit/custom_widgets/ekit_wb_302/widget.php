<?php

namespace Elementor;

defined('ABSPATH') || exit;

class Ekit_Wb_302 extends Widget_Base {

	public function get_name() {
		return 'ekit_wb_302';
	}


	public function get_title() {
		return esc_html__( 'New Widget', 'elementskit-lite' );
	}


	public function get_categories() {
		return ['basic'];
	}


	public function get_icon() {
		return 'fas fa-american-sign-language-interpreting';
	}


	protected function register_controls() {
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
<?php if ( is_user_logged_in() ) { ?>
   <a href="/profile" class="profile-icon">Profile</a>
<?php } ?>

		<?php
	}


}
