<?php
/*
Template Name: Left Sidebar List Page
*/
?>

<?php get_header(); ?>
		<div id="main" ng-controller="SidebarPageListCtrl">
			<div class="col-md-12 img-wrap">
				<img class="placeholder" src="<?php echo get_template_directory_uri(); ?>/library/img/vaktmesterservice.png" alt=""/>
			</div>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="col-md-3">
					<ul class="nav sidenav">
						<li ng-repeat="choice in choices" ng-click="change(choice.id)" ng-class="{selected: isSelected(choice.id)}">{{choice.title}}</li>
					</ul>
				</div>

				<div class="col-md-7">
					<div class="panel panel-default panel-standalone">
						<div class="panel-body">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
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
<?php get_footer(); ?>
