<?php
/**
 * Handles loading all the necessary files
 *
 * @package Tutor_Starter
 */

defined( 'ABSPATH' ) || exit;

// Content width.
if ( ! isset( $content_width ) ) {
	$content_width = apply_filters( 'tutorstarter_content_width', get_theme_mod( 'content_width_value', 1140 ) );
}

// Theme GLOBALS.
$theme = wp_get_theme();
define( 'TUTOR_STARTER_VERSION', $theme->get( 'Version' ) );

// Load autoloader.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

// Include TGMPA class.
if ( file_exists( dirname( __FILE__ ) . '/inc/Custom/class-tgm-plugin-activation.php' ) ) :
	require_once dirname( __FILE__ ) . '/inc/Custom/class-tgm-plugin-activation.php';
endif;

// Register services.
if ( class_exists( 'Tutor_Starter\\Init' ) ) :
	Tutor_Starter\Init::register_services();
endif;

// Add phone number field to the main user profile section
add_action( 'user_new_form', 'add_phone_number_field' );
add_action( 'show_user_profile', 'add_phone_number_field' );
add_action( 'edit_user_profile', 'add_phone_number_field' );

function add_phone_number_field( $user ) {
	$phone_number = is_object( $user ) ? get_user_meta( $user->ID, 'phone_number', true ) : '';
	?>
	<h3><?php esc_html_e( 'User Information', 'tutor' ); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="phone_number"><?php esc_html_e( 'Phone Number', 'tutor' ); ?></label></th>
			<td>
				<input type="text" name="phone_number" id="phone_number" value="<?php echo esc_attr( $phone_number ); ?>" class="regular-text" />
			</td>
		</tr>
	</table>
	<?php
}

// Save the phone number field
add_action( 'personal_options_update', 'save_phone_number_field' );
add_action( 'edit_user_profile_update', 'save_phone_number_field' );

function save_phone_number_field( $user_id ) {
	if ( isset( $_POST['phone_number'] ) ) {
		update_user_meta( $user_id, 'phone_number', sanitize_text_field( $_POST['phone_number'] ) );
	}
}
