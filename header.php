<!DOCTYPE html>
<html id="html" lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<meta name="format-detection" content="telephone=no" />
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Lavishly+Yours&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
	
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(''); ?>>
	
	<?php $announcement = get_field( 'announcement', 'option' ); ?>
	<?php if ( $announcement ) : ?>
		<?php $post = $announcement; ?>
		<?php setup_postdata( $post ); ?> 
			<aside class="announcement-bar">
				<div class="container">
					<?php the_post_thumbnail(); ?>
					<?php the_content(); ?>
				</div>
			</aside>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
	
	<header class="header">
		<div class="container">
			
			<?php if ( have_rows( 'header_button' , 'option' ) ) : ?>
				<?php while ( have_rows( 'header_button' , 'option' ) ) : the_row(); 
					$text = get_sub_field( 'text' );
					$link = get_sub_field( 'link' );
					$external_link = get_sub_field( 'external_link' );
					if ( $external_link != '' ) :
						$target = $external_link;
					else :
						$target = $link;
					endif;
					if ( $target && $text ) : ?>
						<a href="<?php echo $target; ?>" class="button"<?php if ( $external_link ) : ?> target="_blank"<?php endif; ?>>
							<?php echo $text; ?>
						</a>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			
			<a href="<?php echo home_url(); ?>" class="logo" aria-label="Go to Homepage">
				<?php load_svg('logo'); ?>
			</a>
			
			<button class="mobile-menu-toggle" aria-label="Open Mobile Menu">
				<?php load_svg('hamburger'); ?>
			</button>
			
		</div>
	</header>