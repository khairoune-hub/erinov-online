<?php
/**
 * Template Name: Custom Tutor Login Arabic
 */
get_header();
?>

<div class="custom-login-container">
    <h2>تسجيل الدخول</h2>
    
    <?php
    // Check if form is submitted
    if ( isset( $_POST['login_submit'] ) ) {
        
        // Validate and sanitize inputs
        $user_login = sanitize_user( $_POST['user_login'] );
        $user_pass = $_POST['user_pass'];
        $remember = isset( $_POST['remember'] ) ? true : false;
        
        // Form validation
        $errors = array();
        
        if ( empty( $user_login ) ) {
            $errors[] = 'اسم المستخدم أو البريد الإلكتروني مطلوب';
        }
        
        if ( empty( $user_pass ) ) {
            $errors[] = 'كلمة المرور مطلوبة';
        }
        
        // If no errors, attempt login
        if ( empty( $errors ) ) {
            $creds = array(
                'user_login'    => $user_login,
                'user_password' => $user_pass,
                'remember'      => $remember
            );
            
            $user = wp_signon( $creds, false );
            
            if ( is_wp_error( $user ) ) {
                // Display login errors
                echo '<div class="error">' . $user->get_error_message() . '</div>';
            } else {
                // Redirect to my-account page on successful login
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
    
    // Display login form
    ?>
    <form id="custom-login-form" method="post" action="" dir="rtl">
        <div class="form-group">
            <label for="user_login">اسم المستخدم أو البريد الإلكتروني <span class="required">*</span></label>
            <input type="text" name="user_login" id="user_login" value="<?php echo isset( $_POST['user_login'] ) ? esc_attr( $_POST['user_login'] ) : ''; ?>" required />
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
        </div>
        
        <div class="form-group remember-container">
            <label for="remember" class="remember-label">
                <input type="checkbox" name="remember" id="remember" />
                <span>البقاء متصلاً</span>
            </label>
            <a href="<?php echo wp_lostpassword_url(); ?>" class="forgot-password">نسيت كلمة المرور؟</a>
        </div>
        
        <div class="form-group">
            <input type="submit" name="login_submit" value="تسجيل الدخول" />
        </div>

        <div class="register-link">
            ليس لديك حساب؟ <a href="<?php echo site_url( '/student-registration' ); ?>">تسجيل حساب جديد</a>
        </div>
    </form>
</div>

<style>
    .custom-login-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Tajawal', Arial, sans-serif;
    }
    
    .custom-login-container h2 {
        color: #00aeac;
        text-align: center;
        margin-bottom: 30px;
    }
    
    .custom-login-container form {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .custom-login-container label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }
    
    .custom-login-container input[type="text"],
    .custom-login-container input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border 0.3s;
    }
    
    .custom-login-container input[type="text"]:focus,
    .custom-login-container input[type="password"]:focus {
        border-color: #00aeac;
        outline: none;
    }
    
    .custom-login-container input[type="submit"] {
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
    
    .custom-login-container input[type="submit"]:hover {
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
        left: 10px; /* Left for RTL */
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
    }
    
    .eye-hide {
        display: none;
    }
    
    .remember-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .remember-label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    
    .remember-label input {
        margin-left: 8px;
    }
    
    .forgot-password {
        color: #00aeac;
        text-decoration: none;
    }
    
    .register-link {
        text-align: center;
        margin-top: 20px;
        color: #777;
    }
    
    .register-link a {
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
</script>

<?php get_footer(); ?>
