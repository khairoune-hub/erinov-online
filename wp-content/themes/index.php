<?php
/**
 * Erinov Online Hero Section Template
 * 
 * This template creates a responsive hero section with Arabic content,
 * conditional CTAs based on user authentication, and animation elements
 * for robotics education theme.
 */

// Check if user is logged in
$user_logged_in = is_user_logged_in();
?>

<section class="erinov-hero-section" dir="rtl">
    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title">إيرينوف أونلاين</h1>
            <p class="hero-subtitle">منصة تعليمية رائدة تساعد الأطفال على تعلم الروبوتات والابتكار</p>
            
            <?php if (!$user_logged_in) : ?>
                <!-- CTAs for guests -->
                <div class="hero-cta-container">
                    <a href="<?php echo esc_url(site_url('/register')); ?>" class="hero-cta primary-cta">سجل الآن</a>
                    <a href="<?php echo esc_url(site_url('/login')); ?>" class="hero-cta secondary-cta">تسجيل الدخول</a>
                </div>
            <?php else : ?>
                <!-- CTAs for logged-in users -->
                <div class="hero-cta-container">
                    <a href="<?php echo esc_url(site_url('/my-courses')); ?>" class="hero-cta primary-cta">استكمل دوراتك</a>
                    <a href="<?php echo esc_url(site_url('/new-courses')); ?>" class="hero-cta secondary-cta">استكشف دورات جديدة</a>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="hero-animation">
            <!-- Animation elements -->
            <div class="animation-element arduino-board"></div>
            <div class="animation-element raspberry-pi"></div>
            <div class="animation-element robot-arm"></div>
            <div class="animation-element code-block"></div>
            <div class="animation-element gear gear-1"></div>
            <div class="animation-element gear gear-2"></div>
            <div class="animation-element gear gear-3"></div>
        </div>
    </div>
</section>

<style>
:root {
    --erinov-primary: #1bb6b4;
    --erinov-secondary: #0a5a59;
    --erinov-light: #7ee6e5;
    --erinov-dark: #053534;
    --erinov-accent: #ff7700;
    --erinov-text: #333333;
    --erinov-bg: #f8f8f8;
}

.erinov-hero-section {
    position: relative;
    background: linear-gradient(135deg, var(--erinov-bg) 0%, #ffffff 100%);
    padding: 4rem 2rem;
    overflow: hidden;
    font-family: 'Cairo', 'Tajawal', sans-serif;
}

.hero-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: row-reverse;
    align-items: center;
    justify-content: space-between;
}

.hero-content {
    width: 50%;
    z-index: 5;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    color: var(--erinov-dark);
    position: relative;
}

.hero-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    right: 0;
    width: 100px;
    height: 5px;
    background-color: var(--erinov-primary);
    border-radius: 3px;
}

.hero-subtitle {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    color: var(--erinov-text);
}

.hero-cta-container {
    display: flex;
    gap: 1rem;
}

.hero-cta {
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    text-align: center;
    transition: all 0.3s ease;
}

.primary-cta {
    background-color: var(--erinov-primary);
    color: white;
    box-shadow: 0 4px 15px rgba(27, 182, 180, 0.3);
}

.primary-cta:hover {
    background-color: var(--erinov-secondary);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(27, 182, 180, 0.4);
}

.secondary-cta {
    background-color: transparent;
    color: var(--erinov-primary);
    border: 2px solid var(--erinov-primary);
}

.secondary-cta:hover {
    background-color: var(--erinov-light);
    color: var(--erinov-dark);
    transform: translateY(-3px);
}

.hero-animation {
    width: 45%;
    height: 400px;
    position: relative;
}

/* Animation elements styling */
.animation-element {
    position: absolute;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

.arduino-board {
    width: 150px;
    height: 100px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/arduino.svg');
    top: 30%;
    left: 10%;
    animation: float 6s ease-in-out infinite;
}

.raspberry-pi {
    width: 120px;
    height: 120px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/raspberry-pi.svg');
    top: 60%;
    left: 40%;
    animation: float 7s ease-in-out infinite 1s;
}

.robot-arm {
    width: 180px;
    height: 180px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/robot-arm.svg');
    top: 20%;
    left: 50%;
    animation: float 8s ease-in-out infinite 0.5s;
}

.code-block {
    width: 100px;
    height: 100px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/code.svg');
    top: 70%;
    left: 20%;
    animation: float 5s ease-in-out infinite 1.5s;
}

.gear {
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/gear.svg');
    opacity: 0.1;
}

.gear-1 {
    width: 80px;
    height: 80px;
    top: 10%;
    left: 10%;
    animation: rotate 20s linear infinite;
}

.gear-2 {
    width: 120px;
    height: 120px;
    top: 50%;
    left: 70%;
    animation: rotate 25s linear infinite reverse;
}

.gear-3 {
    width: 60px;
    height: 60px;
    top: 80%;
    left: 40%;
    animation: rotate 15s linear infinite;
}

/* Animations */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
    100% {
        transform: translateY(0px);
    }
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Responsive styles */
@media (max-width: 991px) {
    .hero-container {
        flex-direction: column;
    }
    
    .hero-content, .hero-animation {
        width: 100%;
    }
    
    .hero-content {
        margin-bottom: 3rem;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .erinov-hero-section {
        padding: 3rem 1rem;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-cta-container {
        flex-direction: column;
    }
    
    .hero-cta {
        width: 100%;
    }
    
    .hero-animation {
        height: 300px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add additional animation effects
    const elements = document.querySelectorAll('.animation-element');
    
    // Create observer for animation on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    });
    
    elements.forEach(element => {
        observer.observe(element);
    });
});
</script>
