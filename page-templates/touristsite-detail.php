<?php
/**
*
*	Template Name: Tourist Site - Detail
*
*/

get_header( 'sltg' );

$touristsite = get_detail_touristsite();
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
											<a href="<?php _e( home_url()); ?>">Home</a> / <a href="<?php _e( home_url() .'/escape-plan/tourist-site'); ?>">Tourist Site</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="wrap-body">
							<div class="content-wrapper main-content content-middle0">
								<div class="content-holder content-main0">
									<div class="content-holder-head">
										<div class="chb-column column-10">
											<h1><?php _e( $touristsite->GetNama() ); ?></h1>
										</div>
									</div>
									<div class="content-holder-body ctn-mid-dual0">
										<div class="chb-column column-4 ctn-md-small0">
											<img src="<?php _e( $touristsite->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>" />
										</div>
										<div class="chb-column column-6 ctn-md-large0">
											<div class="content-section">
												<div class="section-article">
													<p class="ctn-article0"><?php _e( $touristsite->GetDeskripsi() ); ?></p>
													<p class="ctn-article0"><?php _e( $touristsite->GetOther() ); ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="content-wrapper gallery-content content-galler0">
								<div class="content-holder gallery-area0">
									<div class="content-holder-head">
										<div class="chb-column column-10">
											<h2>GALERI</h2>
										</div>
									</div>
									<div class="content-holder-body ctn-pictgrid0">
										<div class="chb-column column-10 ctn-md-large0">
											<?php foreach( $touristsite->GetGambars() as $gbr ): ?>
											<?php  $url = wp_get_attachment_thumb_url( $gbr->GetPostId() ); ?>
											<a class="fancybox" rel="gallery1" href="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>"><img class="pictgrid" src="<?php _e( $url ); ?>?<?php echo millitime(); ?>"></a>
											<!-- <div class="pictgrid" style="background-image:url()"></div> -->
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="content-wrapper map-content content-galler0">
								<div class="content-holder gallery-area0">
									<div class="content-holder-head">
										<div class="chb-column column-10">
											<h2>MAP</h2>
										</div>
									</div>
									<div id="sltg-map"></div>
								</div>
							</div>
						</div>
						<div class="wrap-foot"></div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$( ".fancybox").fancybox();
});

var map;
var thisPosition = { lat: <?php _e( $touristsite->GetLatitude() ); ?>, lng: <?php _e( $touristsite->GetLongitude() ); ?> };
function initMap() {
	map = new google.maps.Map(document.getElementById('sltg-map'), {
	  center: thisPosition, 
	  zoom: 18
	});

	var marker = new google.maps.Marker( {
		position: thisPosition,
		map: map,
		title: "<?php _e( $touristsite->GetNama() ); ?>"
	});
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1fLtne1FfQzHeuIqcD3B3sNvcZSqED_c&callback=initMap" async defer></script>
<?php
get_footer();