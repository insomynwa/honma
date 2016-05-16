<?php
/**
*
*	Template Name: Product - Detail
*
*/

get_header( 'sltg' );

$product = get_detail_product();
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
								<h1><?php _e( $product->GetNama() ); ?></h1>
								<?php $numImg = sizeof( $product->GetGambars() ); ?>
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
										<?php $num=0; foreach( $product->GetGambars() as $gbr ): ?>
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
											<?php $num=0; foreach( $product->GetGambars() as $gbr ): ?>
												<?php  $url = wp_get_attachment_thumb_url( $gbr->GetPostId() ); ?>
												<label class='num<?php _e($num); ?>' for='cs_slide1_<?php _e($num); ?>'> <span class='cs_point'></span><span class='cs_thumb'><img src='<?php _e( $url ); ?>?<?php echo millitime(); ?>' alt='' title='' /></span></label>
												<?php $num += 1; ?>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
								<div class="article-area">
									<div class="deskription-area"><?php _e( $product->GetDeskripsi() ); ?></div>
									<hr>
									<div class="info-area"><?php _e( $product->GetOther() ); ?></div>
									<hr>
									<div>
										<?php $ukm = $product->GetProducer(); _e( $ukm->GetNama() ); ?>
									</div>
								</div>
							</article>
						</div>
						<div class="sltg-pagination"></div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();