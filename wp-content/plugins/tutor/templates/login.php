<?php
/**
 * Tutor login form template - Customized with Arabic support and enhanced features
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.0.1
 */

use TUTOR\Ajax;

$lost_pass = apply_filters( 'tutor_lostpassword_url', wp_lostpassword_url() );
$is_rtl = is_user_logged_in() ? 'rtl' : 'ltr';
$lang = is_user_logged_in() ? 'ar' : get_locale();

// Custom colors
$primary_color = '#f6931e';
$secondary_color = '#00aeac';

// Custom CSS for the colors and RTL support
$custom_css = "
    :root {
        --tutor-primary-color: {$primary_color};
        --tutor-secondary-color: {$secondary_color};
    }
    .tutor-btn-primary, .tutor-btn-primary:hover {
        background-color: var(--tutor-primary-color) !important;
        border-color: var(--tutor-primary-color) !important;
    }
    .tutor-form-check-input:checked {
        background-color: var(--tutor-primary-color) !important;
        border-color: var(--tutor-primary-color) !important;
    }
    .tutor-btn-ghost:hover, .tutor-btn-link {
        color: var(--tutor-secondary-color) !important;
    }
    .password-strength-meter {
        height: 5px;
        margin-top: 5px;
        border-radius: 3px;
        transition: all 0.3s ease;
    }
    .password-strength-meter.weak { background-color: #ff4d4d; width: 25%; }
    .password-strength-meter.medium { background-color: #ffaa00; width: 50%; }
    .password-strength-meter.good { background-color: #73e600; width: 75%; }
    .password-strength-meter.strong { background-color: #00b300; width: 100%; }
    .password-field-wrapper {
        position: relative;
    }
    .password-toggle {
        position: absolute;
        right: " . ($is_rtl === 'rtl' ? 'auto' : '10px') . ";
        left: " . ($is_rtl === 'rtl' ? '10px' : 'auto') . ";
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
    }
    .rtl .password-toggle {
        right: 10px;
        left: auto;
    }
    .password-strength-text {
        font-size: 12px;
        margin-top: 5px;
    }
";

/**
 * Get login validation errors & print
 *
 * @since 2.1.3
 */
$login_errors = get_transient( Ajax::LOGIN_ERRORS_TRANSIENT_KEY ) ? get_transient( Ajax::LOGIN_ERRORS_TRANSIENT_KEY ) : array();

// Arabic translations
$translations = array(
    'username_email' => $lang === 'ar' ? 'اسم المستخدم أو البريد الإلكتروني' : 'Username or Email Address',
    'password' => $lang === 'ar' ? 'كلمة المرور' : 'Password',
    'keep_signed_in' => $lang === 'ar' ? 'البقاء متصلاً' : 'Keep me signed in',
    'forgot_password' => $lang === 'ar' ? 'نسيت كلمة المرور؟' : 'Forgot Password?',
    'sign_in' => $lang === 'ar' ? 'تسجيل الدخول' : 'Sign In',
    'no_account' => $lang === 'ar' ? 'ليس لديك حساب؟' : 'Don\'t have an account?',
    'register_now' => $lang === 'ar' ? 'سجل الآن' : 'Register Now',
    'show_password' => $lang === 'ar' ? 'إظهار كلمة المرور' : 'Show Password',
    'hide_password' => $lang === 'ar' ? 'إخفاء كلمة المرور' : 'Hide Password',
    'password_strength' => $lang === 'ar' ? 'قوة كلمة المرور:' : 'Password Strength:',
    'weak' => $lang === 'ar' ? 'ضعيفة' : 'Weak',
    'medium' => $lang === 'ar' ? 'متوسطة' : 'Medium',
    'good' => $lang === 'ar' ? 'جيدة' : 'Good',
    'strong' => $lang === 'ar' ? 'قوية' : 'Strong',
);
?>
<style>
    <?php echo $custom_css; ?>
</style>

<?php
foreach ( $login_errors as $login_error ) {
    ?>
    <div class="tutor-alert tutor-warning tutor-mb-12" style="display:block; grid-gap: 0px 10px;">
        <?php
        echo wp_kses(
            $login_error,
            array(
                'strong' => true,
                'a'      => array(
                    'href'  => true,
                    'class' => true,
                    'id'    => true,
                ),
                'p'      => array(
                    'class' => true,
                    'id'    => true,
                ),
                'div'    => array(
                    'class' => true,
                    'id'    => true,
                ),
            )
        );
        ?>
    </div>
    <?php
}

do_action( 'tutor_before_login_form' );
?>
<form id="tutor-login-form" method="post" dir="<?php echo esc_attr($is_rtl); ?>" lang="<?php echo esc_attr($lang); ?>">
    <?php if ( is_single_course() ) : ?>
        <input type="hidden" name="tutor_course_enroll_attempt" value="<?php echo esc_attr( get_the_ID() ); ?>">
    <?php endif; ?>
    <?php tutor_nonce_field(); ?>
    <input type="hidden" name="tutor_action" value="tutor_user_login" />
    <input type="hidden" name="redirect_to" value="<?php echo esc_url( apply_filters( 'tutor_after_login_redirect_url', tutor()->current_url ) ); ?>" />

    <div class="tutor-mb-20">
        <input type="text" class="tutor-form-control" placeholder="<?php echo esc_attr($translations['username_email']); ?>" name="log" value="" size="20" required/>
    </div>

    <div class="tutor-mb-32 password-field-wrapper">
        <input type="password" id="password-field" class="tutor-form-control" placeholder="<?php echo esc_attr($translations['password']); ?>" name="pwd" value="" size="20" required/>
        <span id="password-toggle" class="password-toggle" title="<?php echo esc_attr($translations['show_password']); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
        </span>
        <div class="password-strength-meter"></div>
        <div class="password-strength-text"></div>
    </div>

    <div class="tutor-login-error"></div>
    <?php
        do_action( 'tutor_login_form_middle' );
        do_action( 'login_form' );
        apply_filters( 'login_form_middle', '', '' );
    ?>
    <div class="tutor-d-flex tutor-justify-between tutor-align-center tutor-mb-40">
        <div class="tutor-form-check">
            <input id="tutor-login-agmnt-1" type="checkbox" class="tutor-form-check-input tutor-bg-black-40" name="rememberme" value="forever" />
            <label for="tutor-login-agmnt-1" class="tutor-fs-7 tutor-color-muted">
                <?php echo esc_html($translations['keep_signed_in']); ?>
            </label>
        </div>
        <a href="<?php echo esc_url( $lost_pass ); ?>" class="tutor-btn tutor-btn-ghost">
            <?php echo esc_html($translations['forgot_password']); ?>
        </a>
    </div>

    <?php do_action( 'tutor_login_form_end' ); ?>
    <button type="submit" class="tutor-btn tutor-btn-primary tutor-btn-block">
        <?php echo esc_html($translations['sign_in']); ?>
    </button>
    
    <?php if ( get_option( 'users_can_register', false ) ) : ?>
        <?php
            $url_arg = array(
                'redirect_to' => tutor()->current_url,
            );
            if ( is_single_course() ) {
                $url_arg['enrol_course_id'] = get_the_ID();
            }
        ?>
        <div class="tutor-text-center tutor-fs-6 tutor-color-secondary tutor-mt-20">
            <?php echo esc_html($translations['no_account']); ?>&nbsp;
            <a href="<?php echo esc_url( add_query_arg( $url_arg, tutor_utils()->student_register_url() ) ); ?>" class="tutor-btn tutor-btn-link">
                <?php echo esc_html($translations['register_now']); ?>
            </a>
        </div>
    <?php endif; ?>
    <?php do_action( 'tutor_after_sign_in_button' ); ?>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password show/hide toggle
    var passwordField = document.getElementById('password-field');
    var passwordToggle = document.getElementById('password-toggle');
    var isPasswordVisible = false;
    
    var translations = <?php echo json_encode($translations); ?>;
    
    passwordToggle.addEventListener('click', function() {
        isPasswordVisible = !isPasswordVisible;
        passwordField.type = isPasswordVisible ? 'text' : 'password';
        passwordToggle.title = isPasswordVisible ? translations.hide_password : translations.show_password;
        
        // Change the eye icon
        if (isPasswordVisible) {
            passwordToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
        } else {
            passwordToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
        }
    });
    
    // Password strength meter
    var strengthMeter = document.querySelector('.password-strength-meter');
    var strengthText = document.querySelector('.password-strength-text');
    
    passwordField.addEventListener('input', function() {
        var password = passwordField.value;
        var strength = checkPasswordStrength(password);
        
        // Reset classes
        strengthMeter.className = 'password-strength-meter';
        
        if (password.length === 0) {
            strengthMeter.style.display = 'none';
            strengthText.style.display = 'none';
            return;
        }
        
        strengthMeter.style.display = 'block';
        strengthText.style.display = 'block';
        
        if (strength === 1) {
            strengthMeter.classList.add('weak');
            strengthText.innerHTML = translations.password_strength + ' <span style="color: #ff4d4d;">' + translations.weak + '</span>';
        } else if (strength === 2) {
            strengthMeter.classList.add('medium');
            strengthText.innerHTML = translations.password_strength + ' <span style="color: #ffaa00;">' + translations.medium + '</span>';
        } else if (strength === 3) {
            strengthMeter.classList.add('good');
            strengthText.innerHTML = translations.password_strength + ' <span style="color: #73e600;">' + translations.good + '</span>';
        } else if (strength === 4) {
            strengthMeter.classList.add('strong');
            strengthText.innerHTML = translations.password_strength + ' <span style="color: #00b300;">' + translations.strong + '</span>';
        }
    });
    
    function checkPasswordStrength(password) {
        // Initialize variables
        var strength = 0;
        
        // If password length is less than 6, return 1 (weak)
        if (password.length < 6) {
            return 1;
        }
        
        // If password length is greater than or equal to 8, increase strength
        if (password.length >= 8) {
            strength += 1;
        }
        
        // If password contains both lower and uppercase characters, increase strength
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            strength += 1;
        }
        
        // If password has numbers and characters, increase strength
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
            strength += 1;
        }
        
        // If password has one special character, increase strength
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            strength += 1;
        }
        
        return Math.min(strength, 4);
    }
    
    // Modal handling
    var loginModal = document.querySelector('.tutor-modal.tutor-login-modal');
    var errors = <?php echo wp_json_encode( $login_errors ); ?>;
    if (loginModal && errors.length) {
        loginModal.classList.add('tutor-is-active');
    }
});
</script>
<?php
do_action( 'tutor_after_login_form' );
delete_transient( Ajax::LOGIN_ERRORS_TRANSIENT_KEY );
?>
