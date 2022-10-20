<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package starter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Main Body -->
<div class="starter-header-container">

	<!-- Main Header -->
	<header class="starter-header">

		<!-- Main Navbar -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light starter-nav">
			<div class="container">

				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php 

					$starter_logo_id = get_theme_mod( 'custom_logo' );
					$logo_url = wp_get_attachment_image_src( $starter_logo_id , 'full' );					

					if( function_exists ( 'the_custom_logo'  ) && has_custom_logo() ): 
						echo '<img class="starter-logo" src="'.esc_url( $logo_url[0] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"/>';
					else: 
						bloginfo( 'name' ); 
					endif; ?>
				</a>
				
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					
					<?php /* Primary navigation */

					wp_nav_menu( 
						array(
							'theme_location' => 'primary',
							'depth' => 4,
							'container' => false,
							'menu_class' => 'navbar-nav mx-auto main-menu-nav',
							'fallback_cb'  => 'starter_primary_menu_fallback',
							//Process nav menu using our custom nav walker
							'walker' => new WP_Bootstrap_Navwalker(),                       
						)
					);

					?>

					<div class="d-flex">
						<?php if( is_user_logged_in() ){ ?>
						<!-- Dropdown button -->
						<div class="starter-user-dashboard dropdown user-dashboard">
							<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink_1" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo get_avatar( get_current_user_id(), '30', '' , '' , array( 'class' => array( 'loggedin-user-image' ) ) ); ?>	
								<?php echo esc_html( wp_get_current_user()->display_name ); ?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
								<li><a href="<?php echo wp_logout_url( home_url() ); ?>" class="dropdown-item"><?php esc_html_e( 'Logout', 'starter' ); ?></a></li>
							</ul>
						</div>
						<?php } else { ?>
							<?php if( get_theme_mod( 'singin_text') ): ?><a class="starter-primary" href="<?php echo esc_url( get_theme_mod( 'singin_url', '#' ) ); ?>"><i class="las la-user"></i> <?php echo esc_html( get_theme_mod( 'singin_text', __( 'Sign In', 'starter' ) ) ); ?></a><?php endif; ?>
						<?php } ?>
					</div>					
				</div>
			</div>
		</nav>

	</header><!-- #masthead -->
