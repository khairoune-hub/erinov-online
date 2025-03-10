<?php
/**
 * Arabic E-Learning Platform Responsive Footer
 * 2 columns with properly vertical links and RTL support
 */
?>
<?php
    $page_meta         = get_post_meta( get_the_ID(), '_tutorstarter_page_metadata', true );
    $selected_footer   = ( ! empty( $page_meta['footer_select'] ) ? $page_meta['footer_select'] : '' );
    $footer_style      = get_theme_mod( 'footer_type_select' );
?>
<section class="footer-widgets arabic-footer" dir="rtl">
    <div class="container">
        <div class="row justify-between align-top">
            <!-- Quick Links Widget -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-4">
                <h3 class="widget-title"><?php echo esc_html__( 'روابط سريعة', 'tutorstarter' ); ?></h3>
                <div class="footer-links-wrapper">
                    <a href="/" class="footer-link"><?php echo esc_html__( 'الصفحة الرئيسية', 'tutorstarter' ); ?></a>
                    <a href="/courses" class="footer-link"><?php echo esc_html__( 'الدورات', 'tutorstarter' ); ?></a>
                    <a href="/account" class="footer-link"><?php echo esc_html__( 'حسابي', 'tutorstarter' ); ?></a>
                </div>
            </div>
            
            <!-- Other Links Widget -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-4">
                <h3 class="widget-title"><?php echo esc_html__( 'روابط إضافية', 'tutorstarter' ); ?></h3>
                <div class="footer-links-wrapper">
                    <a href="https://erinov.com/blog/" class="footer-link"><?php echo esc_html__( 'المدونة', 'tutorstarter' ); ?></a>
                    <a href="https://erinov.com/shop/" class="footer-link"><?php echo esc_html__( 'المتجر', 'tutorstarter' ); ?></a>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->
</section><!-- .footer-widgets -->

<style>
/* Arabic E-Learning Platform Footer Styles */
.arabic-footer {
    background-color: #13151f;
    padding: 40px 0;
    font-family: 'Cairo', 'Tajawal', sans-serif;
    color: #fff;
    text-align: right;
}

.arabic-footer .widget-title {
    color: #fff;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 10px;
    text-align: center;
}

.arabic-footer .widget-title:after {
    content: '';
    position: absolute;
    right: 50%;
    transform: translateX(50%);
    bottom: 0;
    width: 50px;
    height: 2px;
    background-color: #1BB6B4; /* Updated color as requested */
}

.footer-links-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.footer-link {
    display: block;
    color: #fff;
    text-decoration: none;
    transition: color 0.3s ease;
    padding: 5px 0;
    width: 100%;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.footer-link:last-child {
    border-bottom: none;
}

.footer-link:hover {
    color: #1BB6B4; /* Updated color as requested */
}

/* Responsive Adjustments */
@media (max-width: 991px) {
    .arabic-footer .widget-title {
        margin-top: 20px;
    }
}

@media (max-width: 767px) {
    .footer-links-wrapper {
        margin-bottom: 30px;
    }
}
</style>