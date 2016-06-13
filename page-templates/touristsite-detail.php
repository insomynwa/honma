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
						<div class="wrap-top">
							<div class="wrap-navi">
								<a href="<?php _e( home_url()); ?>">Home</a> / <a href="<?php _e( home_url() .'/escape-plan/tourist-site'); ?>">Tourist Site</a>
							</div>
						</div>
						<div class="wrap-middle">
							<div id="sltg-content" class="sltg-content dual-area">
								<div class="content-top">
									<h1><?php _e( $touristsite->GetNama() ); ?></h1><?php $numImg = sizeof( $touristsite->GetGambars() ); ?>
								</div> <!-- END content-top -->
								<hr>
								<article class="content-middle ctn-mid-dual">
									<div class="ctn-md-small">
										<img src="<?php _e( $touristsite->GetGambarUtama()->GetLinkGambar() ); ?>" />
									</div>
									<div class="ctn-md-large">
										<div class=""><p class="ctn-article"><?php _e( $touristsite->GetDeskripsi() ); ?></p></div>
										<hr>
										<div class=""><p class="ctn-article"><?php _e( $touristsite->GetOther() ); ?></p></div>
										<hr>
										<div class="">
											<h2>Gallery</h2>
											<div class="ctn-pictgrid">
												<?php foreach( $touristsite->GetGambars() as $gbr ): ?>
												<?php  $url = wp_get_attachment_thumb_url( $gbr->GetPostId() ); ?>
												<a class="fancybox" rel="gallery1" href="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>"><img class="pictgrid" src="<?php _e( $url ); ?>?<?php echo millitime(); ?>"></a>
												<!-- <div class="pictgrid" style="background-image:url()"></div> -->
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</article>
								<div class="content-bottom">
									<div class="">
										<h2>Map</h2>
										<div id="sltg-map"></div>
										<script>
										var map;
										var thisPosition = { lat: <?php _e( $touristsite->GetLatitude() ); ?>, lng: <?php _e( $touristsite->GetLongitude() ); ?> };
										function initMap() {
											map = new google.maps.Map(document.getElementById('sltg-map'), {
											  center: thisPosition, 
											  zoom: 20
											});

											var marker = new google.maps.Marker( {
												position: thisPosition,
												map: map,
												title: "<?php _e( $touristsite->GetNama() ); ?>"
											});
										}
										</script>
										<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1fLtne1FfQzHeuIqcD3B3sNvcZSqED_c&callback=initMap"
										async defer></script>
									</div>
									<hr>
								</div> <!-- END content-bottom -->
							</div> <!-- END sltg-content -->
						</div>
						<div class="wrap-bottom"></div>
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
</script>
<?php
get_footer();