<?php
/**
*
*	Template Name: Tourist Site
*
*/

get_header( 'sltg' );
?><style type="text/css"> 
 			.free-wall { 
				margin: 15px; 
 			} 
		</style> 

<div id="content">
	<div class="container">
		<div class="shadow_block">
			<div class="page_section">
				<div class="gutter">
					<article class="single_post sltg-wrapper">
						<div class="sltg-filter">
						</div>
						<div id="sltg-content" class="sltg-content">
							<?php $kategoris = get_kategori_touristsite(); ?>
							<?php if ( sizeof( $kategoris ) > 0 ): ?>
								<?php foreach( $kategoris as $kategori ): ?>
									<?php if( sizeof( $kategori->GetTouristSites()) > 0 ): ?>
									<div>
										<div><h2><?php _e( $kategori->GetNama() ); ?></h2></div>
										<div id="" class="katwall<?php _e($kategori->GetId()); ?> free-wall">
											<?php foreach( $kategori->GetTouristSites() as $ts ): ?>
											<div class="brick" style="width:400px; height:300px">
												<img src="<?php _e( $ts->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>" />
												<h4><?php _e( $ts->GetNama() ); ?></h4>
												<p><?php _e( $ts->GetDeskripsi() ); ?></p>
											</div>
											<?php endforeach; ?>
										</div>
										<script>
										jQuery(document).ready( function( $) {
											var wall = new Freewall( ".katwall<?php _e($kategori->GetId()); ?>" );
											wall.reset({
												selector: '.brick',
												animate: true,
												// cellW: 400,
												// cellH: 300,
												onResize: function() {
													wall.fitWidth();
												}
											});

											wall.container.find('.brick img').load(function (){
												wall.fitHeight();
											});
										});
										</script>
									</div>
									<hr>
									<?php endif; ?>
								<?php endforeach; ?>
								<div id="sltg-map" style="height:400px"></div>
								<script>
								var map;
								function initMap() {
									map = new google.maps.Map(document.getElementById('sltg-map'), {
									  center: {lat: -7.324826, lng: 110.504774}, 
									  zoom: 15
									});

									<?php if ( sizeof( $kategoris ) > 0 ): ?>
									var infowindow = new google.maps.InfoWindow();
									var location = [], i = 0;
									var marker;
									<?php foreach( $kategoris as $kategori ): ?>
										<?php if( sizeof( $kategori->GetTouristSites()) > 0 ): ?>
											<?php foreach( $kategori->GetTouristSites() as $ts ): ?>

												location[i] = [ "<?php _e( $ts->GetNama()); ?>", <?php _e( $ts->GetLatitude() ) ?>, <?php _e( $ts->GetLongitude()) ?> ]
												i++;
												 

												 
												 
											<?php endforeach; ?>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php endif; ?>
									for ( i=0; i< location.length; i++ ) {
										marker = new google.maps.Marker({
									 		position: new google.maps.LatLng( location[i][1], location[i][2]),
									 		map: map,
									 		title: location[i][0]
										});

										google.maps.event.addListener( marker, 'click', (function(marker, i) {
											return function() {
												infowindow.setContent('<h1>' + location[i][0] + '</h1>');
												infowindow.open(map, marker);
											}
										})(marker, i ));
									}
								}
								</script>
								<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1fLtne1FfQzHeuIqcD3B3sNvcZSqED_c&callback=initMap"
								async defer></script>
							<?php endif; ?>
						</div> <!-- END sltg-content -->
						<div class="sltg-pagination"></div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready( function($) {

	$(window).trigger( 'resize' );

});
</script>
<?php
get_footer();