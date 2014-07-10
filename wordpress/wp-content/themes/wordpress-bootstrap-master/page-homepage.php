<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col-sm-12 clearfix" role="main">
					<div ng-controller="HomeImgCtrl">
						<div class="col-md-12 img-wrap">
							<img ng-repeat="slide in slides" class="placeholder am-fade" ng-src="{{ '<?php echo get_template_directory_uri(); ?>/library/img/'+slide.name+'.png' }}" alt="" ng-hide="!isCurrent($index)"/>
						</div>
						<div class="col-md-4" ng-mouseover="change(0)" ng-mouseleave="reset()">
							<div class="panel panel-default" ng-class="{raised:isCurrent(0)}">
								<div class="panel-body">
									<h3>Renhold</h3>
									<p>Vår renholdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt. Vår ren- holdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt. Vår ren- holdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt.</p>
									<hr/>
									<h4 class="pull-right">
										<a href="/wordpress/?page_id=18#renhold">Les mer <i class="fa fa-chevron-right"></i></a>
									</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4" ng-mouseover="change(1)" ng-mouseleave="reset()">
							<div class="panel panel-default" ng-class="{raised:isCurrent(1)}">
								<div class="panel-body">
									<h3>Kantine</h3>
									<p>Vår renholdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt. Vår ren- holdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt. Vår ren- holdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt.</p>
									<hr/>
									<h4 class="pull-right">
										<a href="/wordpress/?page_id=18#kantine">Les mer <i class="fa fa-chevron-right"></i></a>
									</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4" ng-mouseover="change(2)" ng-mouseleave="reset()">
							<div class="panel panel-default" ng-class="{raised:isCurrent(2)}">
								<div class="panel-body">
									<h3>Vaktmesterservice</h3>
									<p>Vår renholdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt. Vår ren- holdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt. Vår ren- holdsavdeling er bygget opp av de mest erfarne fagfolk i vårt distrikt.</p>
									<hr/>
									<h4 class="pull-right">
										<a href="/wordpress/?page_id=18#vaktmester">Les mer <i class="fa fa-chevron-right"></i></a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div> <!-- end #content -->

<?php get_footer(); ?>
