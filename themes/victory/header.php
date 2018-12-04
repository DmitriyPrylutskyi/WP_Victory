<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 */

$email = get_option('email_options');
$phone = get_option('phone_options');

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon/16.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon/32.png">
	<link rel="icon" type="image/png" sizes="64x64" href="<?php echo get_template_directory_uri(); ?>/img/favicon/64.png">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>

<div class="wrapper">

<nav class="menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="menu_button">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <a href="<?php echo home_url(); ?>" class="logo">
                    <p>Победа</p>
                    <span>потребительский кооператив</span>
                </a>
				<?php victory_nav(); ?>
            </div>
        </div>
    </div>
</nav>
<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wrapper">
                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                    <span>Телефон горячей линии</span>
                    <a href="tel://<?php echo $phone; ?>"><?php echo $phone; ?></a>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
    if ( is_user_logged_in() ) {
    ?>
        <script type="application/javascript">
            $('.main-menu .login a').text('Выйти').attr('data-toggle', '').attr('data-target', '').attr('href', '<?php echo wp_logout_url(); ?>');
        </script>
    <?php
    } else {
    ?>
        <script type="application/javascript">
            $('.main-menu .login a').text('Войти').attr('data-toggle', 'modal').attr('data-target', '#enter').attr('href', '#');
        </script>
    <?php
    }
?>

