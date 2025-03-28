<?php
/**
 * Header default - تصميم الترويسة الافتراضي
 */

use Tutor\Ecommerce\CartController;
use Tutor_Starter\Traits\Header_Components;

/**
 * For php8.1&8.2 compatibility
 * للتوافق مع php8.1 و 8.2
 */
class Header_COMP {
	use Header_Components;
}
$obj = new Header_COMP();
?>

<style>

    /* Import an Arabic font with bold weight from Google Fonts */
/* Import Expo Arabic from external source */
@font-face {
    font-family: "ExpoArabic-Bold";
    src: url("https://db.onlinewebfonts.com/t/5a46b722115434b86e5e9719ff7f6f23.eot");
    src: url("https://db.onlinewebfonts.com/t/5a46b722115434b86e5e9719ff7f6f23.eot?#iefix")format("embedded-opentype"),
    url("https://db.onlinewebfonts.com/t/5a46b722115434b86e5e9719ff7f6f23.woff2")format("woff2"),
    url("https://db.onlinewebfonts.com/t/5a46b722115434b86e5e9719ff7f6f23.woff")format("woff"),
    url("https://db.onlinewebfonts.com/t/5a46b722115434b86e5e9719ff7f6f23.ttf")format("truetype"),
    url("https://db.onlinewebfonts.com/t/5a46b722115434b86e5e9719ff7f6f23.svg#ExpoArabic-Bold")format("svg");
}

/* Apply the font to all elements */
html body * {
    font-family: "ExpoArabic-Bold" !important;
  font-weight: 700 !important; /* For bold weight */
}
/* تحسينات تصميم الهيدر */
.header-default {
    padding: 10px 0; /* Reduced padding to make the header smaller */
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

/* جعل الشعار أكبر */
.navbar-brand img {
    max-height: 70px !important; /* Logo size remains the same */
    width: auto;
    transition: all 0.3s ease;
}

/* مساحة بين العناصر في شريط التنقل */
.navbar-utils {
    display: flex;
    align-items: center;
    gap: 20px; /* إضافة مساحة بين العناصر */
}

/* تحسين مظهر السلة */
.utils-cart, .cart-contents {
    padding: 8px 12px;
    border-radius: 8px;
    background-color: #f5f5f5;
    transition: all 0.3s ease;
}

.utils-cart:hover, .cart-contents:hover {
    background-color: #e9e9e9;
}

/* تحسين مظهر صورة الملف الشخصي */
.tutor-header-profile-photo img {
    border-radius: 50%;
    border: 3px solid #f5f5f5; /* Thicker border for better appearance */
    width: 60px; /* Increased size */
    height: 60px; /* Increased size */
    object-fit: cover; /* Ensures the image fits well */
    transition: all 0.3s ease;
}

.tutor-header-profile-photo img:hover {
    border-color: #e9e9e9;
    transform: scale(1.05); /* Slight zoom effect on hover */
}

.tutor-avatar {
    width: 50px; /* Increased size */
    height: 50px; /* Increased size */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: #0078ff; /* Background color for the avatar */
    color: #fff; /* Text color */
    font-size: 22px; /* Larger text size */
    font-weight: bold;
    transition: all 0.3s ease;
    cursor: pointer; /* إضافة مؤشر يد للأفاتار */
}

/* تحسين أزرار التنقل */
.btn-getstarted {
    padding: 10px 15px;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
}

/* إصلاح موضع القائمة المنسدلة بالنسبة للأفاتار */

.tutor-header-submenu {
        direction: rtl;
        text-align: right;
        position: absolute;
        right: 0;
        min-width: 130px;
        border-radius: 4px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        background-color: white;
        z-index: 100;
        padding: 10px;
    }

    .tutor-header-submenu .submenu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tutor-header-submenu .profile-name {
        padding: 8px 10px;
        font-weight: bold;
        border-bottom: 1px solid #eee;
        margin-bottom: 10px;
    }

    .tutor-header-submenu .submenu-item {
        margin-bottom: 5px;
    }

    .tutor-header-submenu .submenu-link {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 8px 10px;
        text-decoration: none;
        color: #333;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .tutor-header-submenu .submenu-link:hover {
        background-color: #f5f5f5;
    }

    .tutor-header-submenu .tutor-dashboard-menu-item-icon {
        margin-left: 10px;
    }


.search-field input:focus {
    box-shadow: 0 0 8px rgba(0,120,255,0.1);
    border-color: #0078ff;
}

/* تصميم متجاوب للهيدر */
@media (max-width: 1200px) {
	    .tutor-header-profile-menu-items {
        margin-left:30px !important;
        font-size: large;

    }

    /* Hide all profile-related elements */
    .tutor-header-profile-photo,
    .tutor-header-submenu,
    .tutor-header-profile-menu-items,
    .tutor-avatar,
    .tutor-avatar-text,
    .tutor-dashboard-menu-item-icon {
        display: none !important;
    }
    
    /* Hide any SVG icons related to profile dropdown */
    .tutor-header-profile-menu-items svg,
    .tutor-avatar svg {
        display: none !important;
    }
}
    .navbar-brand img {
        max-height: 60px !important; /* تصغير الشعار قليلاً */
    }
    
    .navbar-utils {
        gap: 15px; /* تقليل المساحة بين العناصر */
    }
    
    .tutor-header-profile-photo img {
        width: 50px;
        height: 50px;
    }
}

@media (max-width: 992px) {
	    .tutor-header-profile-menu-items {
        margin-left:30px !important;
        font-size: large;

    }

    /* Hide all profile-related elements */
    .tutor-header-profile-photo,
    .tutor-header-submenu,
    .tutor-header-profile-menu-items,
    .tutor-avatar,
    .tutor-avatar-text,
    .tutor-dashboard-menu-item-icon {
        display: none !important;
    }
    
    /* Hide any SVG icons related to profile dropdown */
    .tutor-header-profile-menu-items svg,
    .tutor-avatar svg {
        display: none !important;
    }
}
    .header-default {
        padding: 8px 0;
    }
    
    .navbar-brand img {
        max-height: 50px !important;
    }
    
    .btn-getstarted {
        padding: 8px 12px;
        font-size: 14px;
    }
    
    .tutor-landing-explore {
        display: none; /* إخفاء نص "هل تريد استكشاف" في الشاشات المتوسطة */
    }
    
    .tutor-avatar {
        width: 40px;
        height: 40px;
        font-size: 10px !important;
    }
    .tutor-avatar-text{}

    .utils-cart, .cart-contents {
        padding: 6px 10px;
    }
}


@media (max-width: 768px) {
    /* Move the navbar toggler to the left side */
    .navbar-toggler {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);

    }
    
    /* Ensure the navbar brand (logo) stays centered or slightly right */
    .navbar-brand {
        margin-left: auto;
        padding-left: 30px; /* Make room for the toggler */
    }
    .tutor-header-profile-menu-items {
        margin-left:30px !important;
        font-size: large;

    }

    /* Hide all profile-related elements */
    .tutor-header-profile-photo,
    .tutor-header-submenu,
    .tutor-header-profile-menu-items,
    .tutor-avatar,
    .tutor-avatar-text,
    .tutor-dashboard-menu-item-icon {
        display: none !important;
    }
    
    /* Hide any SVG icons related to profile dropdown */
    .tutor-header-profile-menu-items svg,
    .tutor-avatar svg {
        display: none !important;
    }
}
@media (max-width: 576px) {
    .navbar-utils {
        gap: 8px;
    }
    
    .navbar-brand img {
        max-height: 40px !important;
    }
    
    .btn-getstarted {
        padding: 6px 10px;
        font-size: 13px;
    }
    
    /* تصغير أيقونة السلة */
    .btn-cart svg {
        height: 16px;
        width: 18px;
    }
    
    /* تأكيد إظهار العناصر المهمة فقط في الشاشات الصغيرة جداً */
    .utils-btn, .utils-cart, .tutor-header-profile-menu-items {
        display: flex !important;
    }
    
    /* تنظيم القائمة المنسدلة في الشاشات الصغيرة */
    .tutor-header-submenu {
        max-width: 200px;
        font-size: 13px;
    }
	    .tutor-header-profile-menu-items {
        margin-left:30px !important;
        font-size: large;

    }

    /* Hide all profile-related elements */
    .tutor-header-profile-photo,
    .tutor-header-submenu,
    .tutor-header-profile-menu-items,
    .tutor-avatar,
    .tutor-avatar-text,
    .tutor-dashboard-menu-item-icon {
        display: none !important;
    }
    
    /* Hide any SVG icons related to profile dropdown */
    .tutor-header-profile-menu-items svg,
    .tutor-avatar svg {
        display: none !important;
    }
}
}
</style>

<header class="header-default">
	<!-- .navbar .navbar-center .navbar-right .has-search-field .full-width -->
	<nav
		class="navbar <?php echo tutorstarter_header_switcher(); ?> <?php echo 'navbar-right' === tutorstarter_header_switcher() ? 'has-search-field' : ''; ?>">
		<div class="navbar-brand">
			<?php tutorstarter_site_logo(); ?>
		</div>
		<!-- .has-search-field must use with .navbar-right -->
		<div class="search-field">
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" name="s" value="<?php echo get_search_query(); ?>"
					placeholder="<?php esc_attr_e( 'بحث...', 'tutorstarter' ); ?>" />
			</form>
		</div>
		<?php if ( has_nav_menu( 'primary' ) ) { ?>
			<button class="navbar-toggler">
				<div class="toggle-icon"><span></span></div>
			</button>
		<?php } ?>
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'navbar-nav',
				)
			);
		}
		?>
		<?php 
		if( defined('TUTOR_VERSION') ) {
		?>
		<div class="navbar-utils">
			<?php
			// WooCommerce cart - only show if user is logged in
			if ( class_exists( 'WooCommerce' ) && defined('TUTOR_VERSION') && 'wc' === tutor_utils()->get_option( 'monetize_by' ) && 'header_fullwidth_center' !== get_theme_mod( 'header_type_select' ) && is_user_logged_in() ) {
				global $woocommerce;
				$items = $woocommerce->cart->get_cart();
				if ( true === get_theme_mod( 'cart_btn_toggle', true ) ) {
					if ( $items ) {
						?>
						<div class="utils-cart">
							<?php echo esc_html( tutor_starter_header_cart() ); ?>
						</div>
						<?php
					} else {
						echo tutor_starter_header_cart();
					}
				}
			}
			
			// Show login link for non-logged in users
			if ( defined( 'TDC_VERSION' ) && ! is_user_logged_in() ) {
				?>
				<div class="tutor-landing-explore">
					<span><?php esc_html_e( 'هل تريد استكشاف!', 'tutorstarter' ); ?></span>
					<a class="tutor-version-new-btn"
						href="<?php echo esc_url( home_url() . '/login' ); ?>"><?php esc_html_e( 'تسجيل الدخول السريع', 'tutorstarter' ); ?></a>
				</div>
			<?php } ?>

			<?php
			// Tutor LMS native cart - only show if user is logged in
			if ( defined('TUTOR_VERSION') && class_exists( 'Tutor\Ecommerce\CartController' ) && 'tutor' == tutor_utils()->get_option( 'monetize_by' ) && 'header_fullwidth_center' !== get_theme_mod( 'header_type_select' ) && is_user_logged_in() ) {
				$tutor_native_cart_controller = new CartController();
				
				if ( true === get_theme_mod( 'cart_btn_toggle', true ) ) {
					$items = $tutor_native_cart_controller->get_cart_items()['courses'];
					if ( $items ) {
						?>
						<a class="cart-contents" href="<?php echo esc_url( $tutor_native_cart_controller->get_page_url() ); ?>"
							title="<?php esc_attr_e( 'عرض سلة التسوق الخاصة بك', 'tutorstarter' ); ?>">
							<span class="btn-cart">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" height="19" viewBox="0 0 21 19" width="21">
									<path d="m18.9375 10.832 1.6523-7.31247c.0704-.25781.0235-.49219-.1406-.70312-.164-.21094-.3867-.31641-.668-.31641h-13.81636l-.3164-1.582031c-.04688-.1875-.15235-.339844-.31641-.457031-.14062-.140626-.30469-.210938-.49219-.210938h-3.62109c-.234375 0-.433594.082031-.597656.246094-.164063.164062-.246094.363281-.246094.597656v.5625c0 .23438.082031.43359.246094.59766.164062.16406.363281.24609.597656.24609h2.46094l2.46093 12.0586c-.30468.1875-.55078.4336-.73828.7383-.16406.3047-.24609.6328-.24609.9843 0 .5391.1875.9961.5625 1.3711.39844.3985.86719.5977 1.40625.5977s.99609-.1992 1.37109-.5977c.39844-.375.59766-.8437.59766-1.4062 0-.5391-.19922-.9961-.59766-1.3711h7.38281c-.3984.375-.5977.832-.5977 1.3711 0 .5625.1876 1.0312.5626 1.4062.3984.3985.8671.5977 1.4062.5977s.9961-.1992 1.3711-.5977c.3984-.375.5977-.832.5977-1.3711 0-.375-.1055-.7148-.3165-1.0195-.1875-.3281-.457-.5742-.8085-.7383l.2109-.8789c.0469-.2578-.0117-.4922-.1758-.7031s-.375-.3164-.6328-.3164h-9.45704l-.21094-1.125h10.30078c.1875 0 .3516-.0586.4922-.1758.1641-.1172.2695-.2812.3164-.4922z" />
								</svg>
								<span class="tutor_native_cart_count">(<?php echo $tutor_native_cart_controller->get_cart_items()['courses']['total_count']; ?>)</span>
							</span>
						</a>
						<?php
					}
				}
			}
			
			// CTA button for non-logged in users
			if ( ! is_user_logged_in() || is_customize_preview() ) {
				?>
				<?php if ( true === get_theme_mod( 'cta_text_toggle', true ) ) { ?>
					<div class="utils-btn">
						<a class="btn-getstarted"
							href="<?php echo esc_url( get_theme_mod( 'cta_text_link', '#' ) ); ?>"><?php printf( esc_html__( '%s', 'tutorstarter' ), get_theme_mod( 'cta_text', 'ابدأ الآن' ) ); ?></a>
					</div>
					<?php
				}
			}
			
			// Profile menu for logged in users
			if ( is_user_logged_in() ) {
				if ( class_exists( '\TUTOR\Utils' ) && is_user_logged_in() ) {
					?>
					<div class="tutor-header-profile-menu-items">
						<?php $obj->tutor_multi_column_dropdown(); ?>
					</div> <!-- .tutor-header-profile-menu -->
					<?php
				}
			}
			?>
		</div>
		<?php }; ?>
	</nav>
</header>
