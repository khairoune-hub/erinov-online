<?php
/**
 * Plugin AJAX functions.
 *
 * @package  header-footer-elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use HFE\WidgetsManager\Base\HFE_Helper;

if ( ! class_exists( 'HFE_Addons_Actions' ) ) {

	/**
	 * Initialization
	 *
	 * @since 1.6.0
	 */
	class HFE_Addons_Actions {

		/**
		 * Member Variable
		 *
		 * @var HFE_Addons_Actions
		 */
		private static $instance;

		/**
		 * Widget list variable
		 * 
		 * @var HFE_Addons_Actions
		 */
		private static $widget_list;

		/**
		 *  Initiator
		 *
		 * @return HFE_Addons_Actions
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'wp_ajax_hfe_recommended_plugin_activate', [ $this, 'hfe_activate_addon' ] );
			add_action( 'wp_ajax_hfe_recommended_plugin_install', [ $this, 'hfe_plugin_install' ] );
			add_action( 'wp_ajax_hfe_recommended_theme_install', [ $this, 'hfe_theme_install' ] );
			add_action( 'wp_ajax_hfe_admin_modal', [ $this, 'hfe_admin_modal' ] );
			add_action( 'wp_ajax_hfe-update-subscription', [ $this, 'update_subscription' ] );

			add_action( 'wp_ajax_hfe_activate_widget', [ $this, 'activate_widget' ] );
			add_action( 'wp_ajax_hfe_deactivate_widget', [ $this, 'deactivate_widget' ] );

			add_action( 'wp_ajax_hfe_bulk_activate_widgets', [ $this, 'bulk_activate_widgets' ] );
			add_action( 'wp_ajax_hfe_bulk_deactivate_widgets', [ $this, 'bulk_deactivate_widgets' ] );

			add_action( 'wp_ajax_save_theme_compatibility_option', [ $this, 'save_hfe_compatibility_option_callback' ] );

		}

		/**
		 * Handles the installation and saving of required plugins.
		 *
		 * This function is responsible for installing and saving required plugins.
		 * It checks for the plugin slug in the AJAX request, verifies the nonce, and initiates the plugin installation process.
		 * If the plugin is successfully installed, it schedules a database update to map the plugin slug to a custom key for analytics tracking.
		 *
		 * @since 2.2.0
		 */
		public function hfe_plugin_install() {

			check_ajax_referer( 'updates', '_ajax_nonce' );

			// Fetching the plugin slug from the AJAX request.
			// @psalm-suppress PossiblyInvalidArgument
			$plugin_slug = isset( $_POST['slug'] ) && is_string( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';

			if ( empty( $plugin_slug ) ) {
				wp_send_json_error( array( 'message' => __( 'Plugin slug is missing.', 'header-footer-elementor' ) ) );
			}

			// Schedule the database update if the plugin is installed successfully.
			add_action(
				'shutdown',
				function () use ( $plugin_slug ) {
					// Iterate through all plugins to check if the installed plugin matches the current plugin slug.
					$all_plugins = get_plugins();
					foreach ( $all_plugins as $plugin_file => $_ ) {
						if ( class_exists( '\BSF_UTM_Analytics\Inc\Utils' ) && is_callable( '\BSF_UTM_Analytics\Inc\Utils::update_referer' ) && strpos( $plugin_file, $plugin_slug . '/' ) === 0 ) {
							// If the plugin is found and the update_referer function is callable, update the referer with the corresponding product slug.
							\BSF_UTM_Analytics\Inc\Utils::update_referer( 'header-footer-elementor', $plugin_slug );
							return;
						}
					}
				}
			);

			if ( function_exists( 'wp_ajax_install_plugin' ) ) {
				// @psalm-suppress NoValue
				wp_ajax_install_plugin();
			} else {
				wp_send_json_error( array( 'message' => __( 'Plugin installation function not found.', 'header-footer-elementor' ) ) );
			}
		}

		
		/**
		 * Handles the installation and saving of required theme.
		 *
		 * This function is responsible for installing and saving required plugins.
		 * It checks for the plugin slug in the AJAX request, verifies the nonce, and initiates the plugin installation process.
		 * If the theme is successfully installed, it schedules a database update to map the plugin slug to a custom key for analytics tracking.
		 *
		 * @since 2.2.0
		 */
		public function hfe_theme_install() {

			check_ajax_referer( 'updates', '_ajax_nonce' );

			// Fetching the plugin slug from the AJAX request.
			// @psalm-suppress PossiblyInvalidArgument
			$theme_slug = isset( $_POST['slug'] ) && is_string( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';

			if ( empty( $theme_slug ) ) {
				wp_send_json_error( array( 'message' => __( 'Theme slug is missing.', 'header-footer-elementor' ) ) );
			}

			// Schedule the database update if the theme is installed successfully.
			add_action(
				'shutdown',
				function () use ( $theme_slug ) {
					// Iterate through all themes to check if the installed theme matches the current theme slug.
					$all_themes = wp_get_themes();
					foreach ( $all_themes as $theme_file => $_ ) {
						if ( class_exists( '\BSF_UTM_Analytics\Inc\Utils' ) && is_callable( '\BSF_UTM_Analytics\Inc\Utils::update_referer' ) && strpos( $theme_file, $theme_slug . '/' ) === 0 ) {
							// If the theme is found and the update_referer function is callable, update the referer with the corresponding product slug.
							\BSF_UTM_Analytics\Inc\Utils::update_referer( 'header-footer-elementor', $theme_slug );
							return;
						}
					}
				}
			);

			if ( function_exists( 'wp_ajax_install_theme' ) ) {
				// @psalm-suppress NoValue
				wp_ajax_install_theme();
			} else {
				wp_send_json_error( array( 'message' => __( 'Theme installation function not found.', 'header-footer-elementor' ) ) );
			}
		}

		/**
		 * Activate all module
		 */
		public static function bulk_activate_widgets() {

			check_ajax_referer( 'hfe-admin-nonce', 'nonce' );

			if ( ! isset( self::$widget_list ) ) {
				self::$widget_list = HFE_Helper::get_widget_list();
			}

			$new_widgets = [];

			// Set all extension to enabled.
			foreach ( self::$widget_list  as $slug => $value ) {
				$new_widgets[ $slug ] = $slug;
			}

			// Escape attrs.
			$new_widgets = array_map( 'esc_attr', $new_widgets );

			// Update new_extensions.
			HFE_Helper::update_admin_settings_option( '_hfe_widgets', $new_widgets );

			// Send a JSON response.
			wp_send_json_success( 'Widgets activated successfully.' );
		}

		/**
		 * Deactivate all module
		 */
		public static function bulk_deactivate_widgets() {

			check_ajax_referer( 'hfe-admin-nonce', 'nonce' );

			if ( ! isset( self::$widget_list ) ) {
				self::$widget_list = HFE_Helper::get_widget_list();
			}

			$new_widgets = [];

			// Set all extension to enabled.
			foreach ( self::$widget_list as $slug => $value ) {
				$new_widgets[ $slug ] = 'disabled';
			}

			// Escape attrs.
			$new_widgets = array_map( 'esc_attr', $new_widgets );

			// Update new_extensions.
			HFE_Helper::update_admin_settings_option( '_hfe_widgets', $new_widgets );

			// Send a JSON response.
			wp_send_json_success( 'Widgets deactivated successfully.' );
		}

		/**
		 * Deactivate module
		 */
		public static function deactivate_widget() {

			check_ajax_referer( 'hfe-admin-nonce', 'nonce' );

			$module_id = isset( $_POST['module_id'] ) ? sanitize_text_field( $_POST['module_id'] ) : '';
			$widgets   = HFE_Helper::get_admin_settings_option( '_hfe_widgets', [] );

			$widgets[ $module_id ] = 'disabled';
			$widgets               = array_map( 'esc_attr', $widgets );

			// Update widgets.
			HFE_Helper::update_admin_settings_option( '_hfe_widgets', $widgets );

			wp_send_json( $module_id );
		}

		/**
		 * Activate module
		 */
		public static function activate_widget() {

			check_ajax_referer( 'hfe-admin-nonce', 'nonce' );

			$module_id             = isset( $_POST['module_id'] ) ? sanitize_text_field( $_POST['module_id'] ) : '';
			$widgets               = HFE_Helper::get_admin_settings_option( '_hfe_widgets', [] );
			$widgets[ $module_id ] = $module_id;
			$widgets               = array_map( 'esc_attr', $widgets );

			// Update widgets.
			HFE_Helper::update_admin_settings_option( '_hfe_widgets', $widgets );

			wp_send_json( $module_id );
		}

		/**
		 * Open modal popup.
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function hfe_admin_modal() {

			// Run a security check.
			check_ajax_referer( 'hfe-admin-nonce', 'nonce' );

			update_user_meta( get_current_user_id(), 'hfe-popup', 'dismissed' );
		}

		/**
		 * Update Subscription
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function update_subscription() {

			check_ajax_referer( 'hfe-admin-nonce', 'nonce' );

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( 'You can\'t perform this action.' );
			}

			$api_domain = trailingslashit( $this->get_api_domain() );
			// PHPCS:Ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$arguments = isset( $_POST['data'] ) ? array_map( 'sanitize_text_field', json_decode( stripslashes( wp_unslash( $_POST['data'] ) ), true ) ) : [];

			$url = add_query_arg( $arguments, $api_domain . 'wp-json/starter-templates/v1/subscribe/' ); // add URL of your site or mail API.

			$response = wp_remote_post( $url, [ 'timeout' => 60 ] );

			if ( ! is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) === 200 ) {
				$response = json_decode( wp_remote_retrieve_body( $response ), true );

				// Successfully subscribed.
				if ( isset( $response['success'] ) && $response['success'] ) {
					update_user_meta( get_current_user_ID(), 'hfe-subscribed', 'yes' );
					wp_send_json_success( $response );
				}
			} else {
				wp_send_json_error( $response );
			}
		}

		/**
		 * Get the API URL.
		 *
		 * @since 1.6.0
		 * @return string
		 */
		public function get_api_domain() {
			return apply_filters( 'hfe_api_domain', 'https://websitedemos.net/' );
		}

		/**
		 * Activate addon.
		 *
		 * @since 1.6.0
		 * @return void
		 */
		public function hfe_activate_addon() {

			// Run a security check.
			check_ajax_referer( 'hfe-admin-nonce', 'nonce' );

			if ( isset( $_POST['plugin'] ) ) {

				$type = '';
				if ( ! empty( $_POST['type'] ) ) {
					$type = sanitize_key( wp_unslash( $_POST['type'] ) );
				}

				$plugin = sanitize_text_field( wp_unslash( $_POST['plugin'] ) );

				if ( 'plugin' === $type ) {

					// Check for permissions.
					if ( ! current_user_can( 'activate_plugins' ) ) {
						wp_send_json_error( esc_html__( 'Plugin activation is disabled for you on this site.', 'header-footer-elementor' ) );
					}

					$activate = activate_plugins( $plugin );

					if ( ! is_wp_error( $activate ) ) {

						do_action( 'hfe_plugin_activated', $plugin );

						wp_send_json_success( esc_html__( 'Plugin Activated.', 'header-footer-elementor' ) );
					}
				}

				if ( 'theme' === $type ) {

					if ( isset( $_POST['slug'] ) ) {
						$slug = sanitize_key( wp_unslash( $_POST['slug'] ) );

						// Check for permissions.
						if ( ! ( current_user_can( 'switch_themes' ) ) ) {
							wp_send_json_error( esc_html__( 'Theme activation is disabled for you on this site.', 'header-footer-elementor' ) );
						}

						$activate = switch_theme( $slug );

						if ( ! is_wp_error( $activate ) ) {

							do_action( 'hfe_theme_activated', $plugin );

							wp_send_json_success( esc_html__( 'Theme Activated.', 'header-footer-elementor' ) );
						}
					}
				}
			}

			if ( 'plugin' === $type ) {
				wp_send_json_error( esc_html__( 'Could not activate plugin. Please activate from the Plugins page.', 'header-footer-elementor' ) );
			} elseif ( 'theme' === $type ) {
				wp_send_json_error( esc_html__( 'Could not activate theme. Please activate from the Themes page.', 'header-footer-elementor' ) );
			}
		}

		/**
		 * Save HFE compatibility option via AJAX.
		 *
		 * @since 2.2.0
		 * @return void
		 */
		public function save_hfe_compatibility_option_callback() {
			// Check nonce for security.
			check_ajax_referer( 'hfe-admin-nonce', 'nonce' );

			if ( isset( $_POST['hfe_compatibility_option'] ) ) {
				// Sanitize and update option.
				$option = sanitize_text_field( $_POST['hfe_compatibility_option'] );
				update_option( 'hfe_compatibility_option', $option );

				// Return a success response.
				wp_send_json_success( 'Settings saved successfully!' );
			} else {
				// Return an error response if the option is not set.
				wp_send_json_error( 'Unable to save settings.' );
			}
		}

	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	HFE_Addons_Actions::get_instance();

}
