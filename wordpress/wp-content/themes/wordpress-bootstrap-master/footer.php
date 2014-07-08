			<footer role="contentinfo">

				<div id="inner-footer" class="container clearfix">
					<?php if( is_page_template( 'page-homepage.php' ) ) { ?>
						<div id="footer-omoss" class="row">
							<div class="col-md-8">
								<h4>EASS</h4>
								<p>
									<img class="pull-right" src="<?php echo get_template_directory_uri(); ?>/library/img/toma-gruppen.png" alt="Toma Gruppen"/>
									Eiendomsassistanse AS er en del av Toma Gruppen og er en totalleverandør av servicetjenester innenfor renhold, vaktmester, kantine, gartner, vakt og sikkerhet og eiendomsforvaltning.
								</p>
							</div>
							<div class="col-md-2 col-md-offset-2">
								<h4>KONTAKT</h4>
								<p>
									Eiendomsassistanse AS<br/>
									Tel.: 71 21 61 40<br/>
									E-post: post@eass.no
								</p>
							</div>
						</div>
					<?php } else { ?>
						<div id="footer-omoss-small" class="row">
							<div class="col-md-12">
								<p>
									Eiendomsassistanse AS, Tel. 71 21 61 40, E-post: post@eass.no
								</p>
							</div>
						</div>
					<?php } ?>
		          <div id="widget-footer" class="clearfix row">
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
		            <?php endif; ?>
		          </div>

					<nav class="clearfix">
						<?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>

				</div> <!-- end #inner-footer -->

			</footer> <!-- end footer -->

			</div>
		</div>
	</div> <!-- end #container -->

		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>
