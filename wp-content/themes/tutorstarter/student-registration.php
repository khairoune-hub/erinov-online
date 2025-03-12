<?php
/*
Template Name: Student Registration
*/
get_header();
?>

<div class="registration-form">
    <?php
    if (function_exists('tutor_load_template')) {
        tutor_load_template('global.registration');
    }
    ?>
</div>

<?php get_footer(); ?>
