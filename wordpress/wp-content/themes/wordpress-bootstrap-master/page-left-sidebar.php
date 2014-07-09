<?php
/*
Template Name: Left Sidebar Page
*/
?>

<?php get_header(); ?>

			<div class="col-md-12 img-wrap">
				<img class="placeholder" src="<?php echo get_template_directory_uri(); ?>/library/img/vaktmesterservice.png" alt=""/>
			</div>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
			<?php endwhile; ?>

			<?php else : ?>

				<article id="post-not-found">
					<header>
						<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					</header>
					<section class="post_content">
						<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					</section>
					<footer>
					</footer>
				</article>

			<?php endif; ?>

<?php get_footer(); ?>
