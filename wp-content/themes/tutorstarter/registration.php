<?php
/**
 * Template Name: Custom Tutor Registration
 */
get_header();
?>

<div class="custom-registration-container">
    <h2>Student Registration</h2>
    
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
                $errors[] = 'Username is required';
            }
            
            if ( empty( $user_email ) ) {
                $errors[] = 'Email is required';
            }
            
            if ( empty( $user_pass ) ) {
                $errors[] = 'Password is required';
            }
            
            if ( $user_pass !== $pass_confirm ) {
                $errors[] = 'Passwords do not match';
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
                    
                    // Redirect to login page
                    wp_redirect( site_url( '/login' ) );
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
        <form id="custom-registration-form" method="post" action="">
            <p>
                <label for="user_login">Username <span class="required">*</span></label>
                <input type="text" name="user_login" id="user_login" value="<?php echo isset( $_POST['user_login'] ) ? esc_attr( $_POST['user_login'] ) : ''; ?>" required />
            </p>
            
            <p>
                <label for="user_email">Email <span class="required">*</span></label>
                <input type="email" name="user_email" id="user_email" value="<?php echo isset( $_POST['user_email'] ) ? esc_attr( $_POST['user_email'] ) : ''; ?>" required />
            </p>
            
            <p>
                <label for="user_pass">Password <span class="required">*</span></label>
                <input type="password" name="user_pass" id="user_pass" required />
            </p>
            
            <p>
                <label for="pass_confirm">Confirm Password <span class="required">*</span></label>
                <input type="password" name="pass_confirm" id="pass_confirm" required />
            </p>
            
            <p>
                <input type="submit" name="register_submit" value="Register" />
            </p>
        </form>
        <?php
    else :
        echo '<p>Registration is currently disabled.</p>';
    endif;
    ?>
</div>

<style>
    .custom-registration-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .custom-registration-container form {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
    }
    
    .custom-registration-container label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .custom-registration-container input[type="text"],
    .custom-registration-container input[type="email"],
    .custom-registration-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }
    
    .custom-registration-container input[type="submit"] {
        background: #2271b1;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 3px;
    }
    
    .error {
        color: red;
        background: #ffeeee;
        padding: 10px;
        margin-bottom: 20px;
        border-left: 3px solid red;
    }
</style>

<?php get_footer(); ?>
