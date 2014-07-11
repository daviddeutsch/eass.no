<!doctype html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		<!-- IE8 fallback moved below head to work properly. Added respond as well. Tested to work. -->
			<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

			<!-- respond.js -->
		<!--[if lt IE 9]>
		          <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
		<![endif]-->

	</head>

	<body <?php body_class(); ?> ng-app="eassApp">

		<div id="header">
			<div class="container">
				<p id="home" class="pull-right">
					<a href="#"><i class="fa fa-2x fa-home"></i></a>
				</p>
				<div id="logo"><img src="<?php echo get_template_directory_uri(); ?>/library/img/eass-logo.png" alt=""/></div>
				<!--<form class="navbar-form navbar-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					<div class="form-group">
						<input name="s" id="s" type="text" class="search-query form-control" autocomplete="off" placeholder="<?php _e('Search','wpbootstrap'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
					</div>
				</form>-->
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="/wordpress/">Forside</a></li>
						<li><a href="/wordpress/?page_id=8">Om oss</a></li>
						<li><a href="/wordpress/?page_id=14">Kvalitet/HMS/Miljø</a></li>
						<li><a href="/wordpress/?page_id=18">Tjenester</a></li>
						<li><a href="/wordpress/?page_id=30">Aktuelt</a></li>
						<li><a href="/wordpress/?page_id=32">Befaring</a></li>
						<li><a href="/wordpress/?page_id=34">Jobb hos oss</a></li>
						<li><a href="/wordpress/?page_id=20">Kontakt</a></li>
					</ul>
				</div>
				<?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
			</div>
		</div>

			<div class="container">
