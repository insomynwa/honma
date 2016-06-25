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
						<div class="wrap-head">
							<div class="content-wrapper wrap-navi">
								<div class="content-holder">
									<div class="content-holder-body">
										<div class="chb-column column-10">
											<a href="<?php _e( home_url()); ?>">Home</a> / <a href="#" class="active">Tourist Site</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="wrap-body">
							<div class="content-wrapper content-navi">
								<div class="content-holder">
									<div class="content-holder-body">
										<div class="chb-column column-10">
											<ul class="mini-opt-left0">
												<li class="active"><a id="0thumbnail-model-1" class="0thumbnail-model-link" href="#">Grid</a></li>
												<li><a id="0thumbnail-model-2" class="0thumbnail-model-link" href="#">List</a></li>
												<li><a id="0thumbnail-model-3" class="0thumbnail-model-link" href="#">Map</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="content-wrapper tourist-content">
								<div class="content-holder">
									<div class="content-holder-body">
										<?php if( sizeof($arrKats) > 0 ): ?>
											<?php foreach($arrKats as $kat) : ?>
											<!-- <div class="ctn-md-large-max0"> -->
												<!-- <div ><h2><?php // _e( strtoupper($kat->GetNama()) ); ?></h2></div> -->
											<div class="chb-column column-10 grid-body grid-list-area0">
												<?php foreach( $kat->GetTouristSites() as $ts ): ?>
														<div class="grid-column g-column-4 thumbnail-model0 thumbnail-grid0"> <!-- thumbnail-grid && thumbnail-grid-img -->
															<div class="grid-content">
																<a class="img-a link-img0" href="<?php echo home_url().'/detail-tourist-site?touristsite='. $ts->GetID(); ?>">
																<div class="thumbnail-model-img0 thumbnail-grid-img0" style="background-image:url(<?php _e( $ts->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>)"></div>
																</a>
																<a class="title-a link-title0" href="<?php echo home_url().'/detail-tourist-site?touristsite='. $ts->GetID(); ?>">
																<h4><?php _e( $ts->GetNama() ); ?></h4>
																</a>
																<p class="thumbnail-model-desc0 thumbnail-grid-description0"><?php _e( explode('. ', $ts->GetDeskripsi())[0] ); ?></p>
															</div>
														</div>
												<?php endforeach; ?>
												<?php foreach( $kat->GetTouristSites() as $ts ): ?>
														<div class="grid-column g-column-4 thumbnail-model0 thumbnail-grid0"> <!-- thumbnail-grid && thumbnail-grid-img -->
															<div class="grid-content">
																<a class="img-a link-img0" href="<?php echo home_url().'/detail-tourist-site?touristsite='. $ts->GetID(); ?>">
																<div class="thumbnail-model-img0 thumbnail-grid-img0" style="background-image:url(<?php _e( $ts->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>)"></div>
																</a>
																<a class="title-a link-title0" href="<?php echo home_url().'/detail-tourist-site?touristsite='. $ts->GetID(); ?>">
																<h4><?php _e( $ts->GetNama() ); ?></h4>
																</a>
																<p class="thumbnail-model-desc0 thumbnail-grid-description0"><?php _e( explode('. ', $ts->GetDeskripsi())[0] ); ?></p>
															</div>
														</div>
												<?php endforeach; ?>
											</div>
												<div id="sltg-map"></div>
											<!-- </div> -->
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div> <!-- END wrap-body -->
						<div class="wrap-foot">
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

	$( ".grid-content").hover( function(){
		$( this ).children('a.title-a').children('h4').addClass('to-top');
		$( this ).children('a.img-a').children('div').addClass('transparent-down');
		$( this ).children('p').fadeIn();
	}, function() {
		$( this ).children('a.title-a').children('h4').removeClass('to-top');
		$( this ).children('a.img-a').children('div').removeClass('transparent-down');
		$( this ).children('p').fadeOut();
	});

	/*$( ".thumbnail-grid p").hover( function(){
		$( ".thumbnail-grid p").show();
	}, function() {
		$( ".thumbnail-grid p").hide();
	});*/

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
			$( ".thumbnail-model-desc").removeClass('thumbnail-list-description');
			$( ".thumbnail-model-desc").addClass('thumbnail-grid-description');
			$( "#sltg-map").fadeOut('fast');
			$( ".thumbnail-model").fadeIn();
		}else if( type==2){
			$( ".thumbnail-model").removeClass('thumbnail-grid');
			$( ".thumbnail-model").addClass('thumbnail-list');
			$( ".thumbnail-model-img").removeClass('thumbnail-grid-img');
			$( ".thumbnail-model-img").addClass('thumbnail-list-img');
			$( ".thumbnail-model-desc").addClass('thumbnail-list-description');
			$( ".thumbnail-model-desc").removeClass('thumbnail-grid-description');
			$( "#sltg-map").fadeOut('fast');
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