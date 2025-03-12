<?php
/**
 * Template Name: Custom Tutor Registration Arabic
 */
get_header();
?>

<div class="custom-registration-container">
    <h2>تسجيل الطالب</h2>
    
    <?php
    // Check if registration is enabled in WordPress
    if ( get_option( 'users_can_register' ) ) :
        
        // Check if form is submitted
        if ( isset( $_POST['register_submit'] ) ) {
            
            // Validate and sanitize inputs
            $user_login = sanitize_user( $_POST['user_login'] );
            $user_email = sanitize_email( $_POST['user_email'] );
            $user_pass = $_POST['user_pass'];
            $pass_confirm = $_POST['pass_confirm'];
            
            // Form validation
            $errors = array();
            
            if ( empty( $user_login ) ) {
                $errors[] = 'اسم المستخدم مطلوب';
            }
            
            if ( empty( $user_email ) ) {
                $errors[] = 'البريد الإلكتروني مطلوب';
            }
            
            if ( empty( $user_pass ) ) {
                $errors[] = 'كلمة المرور مطلوبة';
            }
            
            if ( $user_pass !== $pass_confirm ) {
                $errors[] = 'كلمات المرور غير متطابقة';
            }
            
            // If no errors, create the user
            if ( empty( $errors ) ) {
                $user_id = wp_create_user( $user_login, $user_pass, $user_email );
                
                if ( is_wp_error( $user_id ) ) {
                    // Display WP errors
                    echo '<div class="error">' . $user_id->get_error_message() . '</div>';
                } else {
                    // Set user role to student
                    $user = new WP_User( $user_id );
                    $user->set_role( 'tutor_student' );
                    
                    // Auto log in the user
                    wp_set_current_user( $user_id );
                    wp_set_auth_cookie( $user_id );
                    
                    // Redirect to my-account page
                    wp_redirect( site_url( '/my-account' ) );
                    exit;
                }
            } else {
                // Display errors
                foreach ( $errors as $error ) {
                    echo '<div class="error">' . esc_html( $error ) . '</div>';
                }
            }
        }
        
        // Display registration form
        ?>
        <form id="custom-registration-form" method="post" action="" dir="rtl">
            <div class="form-group">
                <label for="user_login">اسم المستخدم <span class="required">*</span></label>
                <input type="text" name="user_login" id="user_login" value="<?php echo isset( $_POST['user_login'] ) ? esc_attr( $_POST['user_login'] ) : ''; ?>" required />
            </div>
            
            <div class="form-group">
                <label for="user_email">البريد الإلكتروني <span class="required">*</span></label>
                <input type="email" name="user_email" id="user_email" value="<?php echo isset( $_POST['user_email'] ) ? esc_attr( $_POST['user_email'] ) : ''; ?>" required />
            </div>
            
            <div class="form-group password-container">
                <label for="user_pass">كلمة المرور <span class="required">*</span></label>
                <div class="password-input-container">
                    <input type="password" name="user_pass" id="user_pass" required />
                    <span class="toggle-password" onclick="togglePasswordVisibility('user_pass')">
                        <svg class="eye-show" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg class="eye-hide" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                            <line x1="3" y1="3" x2="21" y2="21"></line>
                        </svg>
                    </span>
                </div>
                <div class="password-strength-meter">
                    <div class="strength-meter-bar" id="strength-meter"></div>
                    <div class="strength-text" id="password-strength">قوة كلمة المرور</div>
                </div>
            </div>
            
            <div class="form-group password-container">
                <label for="pass_confirm">تأكيد كلمة المرور <span class="required">*</span></label>
                <div class="password-input-container">
                    <input type="password" name="pass_confirm" id="pass_confirm" required />
                    <span class="toggle-password" onclick="togglePasswordVisibility('pass_confirm')">
                        <svg class="eye-show" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg class="eye-hide" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                            <line x1="3" y1="3" x2="21" y2="21"></line>
                        </svg>
                    </span>
                </div>
            </div>
            
            <div class="form-group">
                <input type="submit" name="register_submit" value="تسجيل" />
            </div>

            <div class="login-link">
                لديك حساب بالفعل؟ <a href="<?php echo wp_login_url(); ?>">تسجيل الدخول</a>
            </div>
        </form>
        <?php
    else :
        echo '<p>التسجيل معطل حاليا.</p>';
    endif;
    ?>
</div>

<style>
    .custom-registration-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Tajawal', Arial, sans-serif;
    }
    
    .custom-registration-container h2 {
        color: #00aeac;
        text-align: center;
        margin-bottom: 30px;
    }
    
    .custom-registration-container form {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .custom-registration-container label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }
    
    .custom-registration-container input[type="text"],
    .custom-registration-container input[type="email"],
    .custom-registration-container input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border 0.3s;
    }
    
    .custom-registration-container input[type="text"]:focus,
    .custom-registration-container input[type="email"]:focus,
    .custom-registration-container input[type="password"]:focus {
        border-color: #00aeac;
        outline: none;
    }
    
    .custom-registration-container input[type="submit"] {
        background: #f6931e;
        color: white;
        border: none;
        padding: 14px 20px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        width: 100%;
        transition: background 0.3s;
    }
    
    .custom-registration-container input[type="submit"]:hover {
        background: #e5820d;
    }
    
    .error {
        color: #fff;
        background: #ff5858;
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        text-align: right;
    }
    
    .password-input-container {
        position: relative;
    }
    
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
    }
    
    .eye-hide {
        display: none;
    }
    
    .password-strength-meter {
        margin-top: 8px;
    }
    
    .strength-meter-bar {
        height: 5px;
        background: #eee;
        border-radius: 3px;
        margin-bottom: 5px;
    }
    
    .strength-text {
        font-size: 14px;
        color: #777;
        text-align: right;
    }
    
    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #777;
    }
    
    .login-link a {
        color: #00aeac;
        text-decoration: none;
    }
    
    .required {
        color: #ff5858;
    }
</style>

<script>
function togglePasswordVisibility(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleButton = passwordInput.parentElement.querySelector('.toggle-password');
    const eyeShow = toggleButton.querySelector('.eye-show');
    const eyeHide = toggleButton.querySelector('.eye-hide');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeShow.style.display = 'none';
        eyeHide.style.display = 'inline';
    } else {
        passwordInput.type = 'password';
        eyeShow.style.display = 'inline';
        eyeHide.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('user_pass');
    const strengthMeter = document.getElementById('strength-meter');
    const strengthText = document.getElementById('password-strength');
    
    passwordInput.addEventListener('input', function() {
        const value = passwordInput.value;
        let strength = 0;
        
        // Check password strength
        if (value.length >= 8) strength += 1;
        if (value.match(/[a-z]+/)) strength += 1;
        if (value.match(/[A-Z]+/)) strength += 1;
        if (value.match(/[0-9]+/)) strength += 1;
        if (value.match(/[^a-zA-Z0-9]+/)) strength += 1;
        
        // Update strength meter
        switch(strength) {
            case 0:
                strengthMeter.style.width = '0%';
                strengthMeter.style.background = '#eee';
                strengthText.textContent = 'قوة كلمة المرور';
                break;
            case 1:
                strengthMeter.style.width = '20%';
                strengthMeter.style.background = '#ff5858';
                strengthText.textContent = 'ضعيفة جداً';
                break;
            case 2:
                strengthMeter.style.width = '40%';
                strengthMeter.style.background = '#ffac58';
                strengthText.textContent = 'ضعيفة';
                break;
            case 3:
                strengthMeter.style.width = '60%';
                strengthMeter.style.background = '#f6931e';
                strengthText.textContent = 'متوسطة';
                break;
            case 4:
                strengthMeter.style.width = '80%';
                strengthMeter.style.background = '#8bc34a';
                strengthText.textContent = 'قوية';
                break;
            case 5:
                strengthMeter.style.width = '100%';
                strengthMeter.style.background = '#00aeac';
                strengthText.textContent = 'قوية جداً';
                break;
        }
    });
});
</script>

<?php get_footer(); ?>
