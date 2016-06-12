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

<?php $kategoris = get_kategori_touristsite();
	$arrKats = array();
	if ( sizeof( $kategoris ) > 0 ) {
		foreach( $kategoris as $kategori ) {
			if( sizeof( $kategori->GetTouristSites()) > 0 ) {
				$arrKats[] = $kategori;
			}
		}
	}
?>
<div id="content">
	<div class="container">
		<div class="shadow_block">
			<div class="page_section">
				<div class="gutter">
					<article class="single_post sltg-wrapper">
						<div class="wrap-top">
							<div class="wrap-navi">
								<a href="<?php _e( home_url()); ?>">Home</a> / <a href="#" class="active">Tourist Site</a>
							</div>
						</div>
						<div class="wrap-middle">
							<div class="sltg-content" class="sltg-content">
								<div class="content-top">
								</div> <!-- END content-top -->
								<div class="content-middle">
									<div class="ctn-md-large-max">
										<div class="mini-opt">
											<ul class="mini-opt-left">
												<li class="active"><a id="thumbnail-model-1" class="thumbnail-model-link" href="#">Grid</a></li>
												<li><a id="thumbnail-model-2" class="thumbnail-model-link" href="#">List</a></li>
												<li><a id="thumbnail-model-3" class="thumbnail-model-link" href="#">Map</a></li>
											</ul>
										</div>
									</div>
									<?php if( sizeof($arrKats) > 0 ): ?>
										<?php foreach($arrKats as $kat) : ?>
										<div class="ctn-md-large-max">
											<!-- <div ><h2><?php // _e( strtoupper($kat->GetNama()) ); ?></h2></div> -->
											<div class="grid-list-area">
												<?php foreach( $kat->GetTouristSites() as $ts ): ?>
														<div class="thumbnail-model thumbnail-grid"> <!-- thumbnail-grid && thumbnail-grid-img -->
															<a href="<?php echo home_url().'/detail-tourist-site?touristsite='. $ts->GetID(); ?>">
															<div class="thumbnail-model-img thumbnail-grid-img" style="background-image:url(<?php _e( $ts->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>)"></div>
															<h4><?php _e( $ts->GetNama() ); ?></h4>
															<p><?php _e( explode('. ', $ts->GetDeskripsi())[0] ); ?></p>
															</a>
														</div>
												<?php endforeach; ?>
											</div>
											<div id="sltg-map"></div>
										</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div> <!-- END content-middle -->
								<div class="content-bottom"></div> <!-- END content-bottom -->
							</div> <!-- END sltg-content -->
						</div> <!-- END wrap-middle -->
						<div class="wrap-bottom">
											
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready( function($) {

	$(window).trigger( 'resize' );
	$( "#sltg-map").fadeOut();

	$( "a.thumbnail-model-link").click( function(){
		//alert(this.id);
		$( ".mini-opt-left li").removeClass( "active" );
		$(this).parent().addClass('active');

		var type = (this.id).split('-').pop();
		if( type==1){
			$( ".thumbnail-model").removeClass('thumbnail-list');
			$( ".thumbnail-model").addClass('thumbnail-grid');
			$( ".thumbnail-model-img").removeClass('thumbnail-list-img');
			$( ".thumbnail-model-img").addClass('thumbnail-grid-img');
			$( "#sltg-map").fadeOut();
			$( ".thumbnail-model").fadeIn();
		}else if( type==2){
			$( ".thumbnail-model").removeClass('thumbnail-grid');
			$( ".thumbnail-model").addClass('thumbnail-list');
			$( ".thumbnail-model-img").removeClass('thumbnail-grid-img');
			$( ".thumbnail-model-img").addClass('thumbnail-list-img');
			$( "#sltg-map").fadeOut();
			$( ".thumbnail-model").fadeIn();
		}else if( type==3) {
			$( ".thumbnail-model").hide();
			$( "#sltg-map").fadeIn();
		}
	});
});
var map;
function initMap() {
	map = new google.maps.Map(document.getElementById('sltg-map'), {
	  center: {lat: -7.324826, lng: 110.504774}, 
	  zoom: 11
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
<?php
get_footer();