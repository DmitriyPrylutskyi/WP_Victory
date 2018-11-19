<?php
/**
 * The template for displaying the footer
 *
 */

$email = get_option('email_options');
$phone = get_option('phone_options');

?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <a href="#" class="logo">
                    <p>Победа</p>
                    <span>потребительский корпоратив</span>
                </a>
            </div>
            <div class="col-12 col-md-6 contacts">
                <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                <span>Телефон горячей линии</span>
                <a href="tel://<?php echo $phone; ?>"><?php echo $phone; ?></a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>