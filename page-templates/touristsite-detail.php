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
						<div class="sltg-filter">filter (remove)</div>
						<div id="sltg-content" class="sltg-content dual-area">
							<div class="title-area">
								<h1><?php _e( $touristsite->GetNama() ); ?></h1>
								<?php $numImg = sizeof( $touristsite->GetGambars() ); ?>
							</div>
							<hr>
							<article>
								<div class="image-area">
									<div class="csslider1 autoplay">
										<?php for( $i=0; $i < $numImg; $i++): ?>
											<input name="cs_anchor1" id='cs_slide1_<?php _e($i); ?>' type="radio" class='cs_anchor slide' >
										<?php endfor; ?>
										<input name="cs_anchor1" id='cs_play1' type="radio" class='cs_anchor' checked>
										<?php for( $i=0; $i < $numImg; $i++): ?>
											<input name="cs_anchor1" id='cs_pause1_<?php _e($i); ?>' type="radio" class='cs_anchor pause'>
										<?php endfor; ?>
										<ul>
										<?php $num=0; foreach( $touristsite->GetGambars() as $gbr ): ?>
											<?php if( $gbr->GetGambarUtama() == 1 ): ?>
											<li class="cs_skeleton"><img src="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>" style="width: 100%;"></li>
											<?php endif; ?>
											<li class='num<?php _e($num); ?> img slide'><img src='<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>' alt='' title='' /></li>
											<?php $num += 1; ?>
										<?php endforeach; ?>
										</ul>
										<div class='cs_arrowprev'>
											<?php for( $i=0; $i < $numImg; $i++): ?>
												<label class='num<?php _e($i); ?>' for='cs_slide1_<?php _e($i); ?>'><span><i></i><b></b></span></label>
											<?php endfor; ?>
										</div>
										<div class='cs_arrownext'>
											<?php for( $i=0; $i < $numImg; $i++): ?>
												<label class='num<?php _e($i); ?>' for='cs_slide1_<?php _e($i); ?>'><span><i></i><b></b></span></label>
											<?php endfor; ?>
										</div>
										<div class='cs_bullets'>
											<?php $num=0; foreach( $touristsite->GetGambars() as $gbr ): ?>
												<?php  $url = wp_get_attachment_thumb_url( $gbr->GetPostId() ); ?>
												<label class='num<?php _e($num); ?>' for='cs_slide1_<?php _e($num); ?>'> <span class='cs_point'></span><span class='cs_thumb'><img src='<?php _e( $url ); ?>?<?php echo millitime(); ?>' alt='' title='' /></span></label>
												<?php $num += 1; ?>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
								<div class="article-area">
									<div class="deskription-area"><?php _e( $touristsite->GetDeskripsi() ); ?></div>
									<hr>
									<div class="info-area"><?php _e( $touristsite->GetOther() ); ?></div>
									<hr>
								</div>
							</article>
							<div>
								<div id="sltg-map" style="height:400px"></div>
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
						</div> <!-- END sltg-content -->
						<div class="sltg-pagination"></div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();