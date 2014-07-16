<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>

		<div id="main">
			<div class="col-md-12 img-wrap">
				<img class="placeholder" src="<?php echo get_template_directory_uri(); ?>/library/img/vaktmesterservice.png" alt=""/>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default panel-standalone">
					<div class="panel-body">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

							<section class="post_content">
								<?php the_content(); ?>

							</section> <!-- end article section -->

						</article> <!-- end article -->

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

					</div>

				</div> <!-- end #main -->

				<?php //get_sidebar(); // sidebar 1 ?>

			</div> <!-- end #content -->
		</div>

<?php get_footer(); ?>
