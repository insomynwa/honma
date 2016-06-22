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
						<div class="wrap-head">
							<div class="content-wrapper wrap-navi">
								<div class="content-holder">
									<div class="content-holder-body">
										<div class="chb-column column-10">
											<a href="<?php _e( home_url()); ?>">Home</a> / <a href="<?php _e( home_url() .'/ukm'); ?>">UKM</a> / <a href="#" class="active">Detail</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="wrap-body">
							<!-- <div id="sltg-content" class="sltg-content"> -->
							<div class="content-wrapper main-content content-middle0">
								<div class="content-holder content-main0">
									<div class="content-holder-head">
										<div class="chb-column column-10">
											<h1><?php _e( $product->GetNama() ); ?></h1>
										</div>
									</div>
									<div class="content-holder-body ctn-mid-dual0">
										<div class="chb-column column-4 ctn-md-small0">
											<img src="<?php _e( $product->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>" />
										</div>
										<div class="chb-column column-6 ctn-md-large0">
											<div class="content-section">
												<div class="section-article">
													<p class="ctn-article0"><?php _e( $product->GetDeskripsi() ); ?></p>
													<p class="ctn-article0"><?php _e( $product->GetOther() ); ?></p>
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
											<?php foreach( $product->GetGambars() as $gbr ): ?>
											<?php  $url = wp_get_attachment_thumb_url( $gbr->GetPostId() ); ?>
											<a class="fancybox" rel="gallery1" href="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>"><img class="pictgrid" src="<?php _e( $url ); ?>?<?php echo millitime(); ?>"></a>
											<!-- <div class="pictgrid" style="background-image:url()"></div> -->
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="content-wrapper creator-content content-bottom0">
								<div class="content-holder content-creator0">
									<div class="content-holder-head">
										<div class="chb-column column-10">
											<h2>UKM</h2>
										</div>
									</div>
									<div class="content-holder-body">
										<?php $ukm = $product->GetProducer(); ?>
										<div class="chb-column column-4 ctn-md-small0">
											<img src="<?php _e( $ukm->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>" />
										</div>
										<div class="chb-column column-6 ctn-md-large0">
											<div class="content-section">
												<div class="section-article">
													<div class="section-title"><h3><?php _e( $ukm->GetNama() ); ?></h3></div>
													<p class="ctn-article0"><?php _e( explode('. ', $ukm->GetDeskripsi())[0] ); ?></p>
												</div>
												<div class="section-article">
													<div class="section-title"><h5>Kontak</h5></div>
													<p class="ctn-article0"><?php _e( $ukm->GetAlamat()); ?></p>
													<p class="ctn-article0"><?php _e( $ukm->GetTelp()); ?></p>
													<p class="ctn-article0"><?php _e( $ukm->GetOther()); ?></p>
												</div>
											</div>
										</div>
									</div>
									<div class="content-holder-foot">
										<div class="chb-column column-10 ctn-md-large0">
											<div class="content-section ctn-pictgrid0">
												<div class="section-article">
													<div class="section-title"><h4>Produk Lainnya</h4></div>
													<div>
														<?php foreach( $ukm->GetProducts() as $prod ): ?>
														<?php if($prod->GetId()!=$product->GetId()): ?>
														<?php $bigImg = $prod->GetGambarUtama(); ?>
														<?php  $url = wp_get_attachment_thumb_url( $bigImg->GetPostId() ); ?>
														<a href="<?php echo home_url().'/detail-product?product='. $prod->GetID(); ?>"><img src="<?php _e( $url ); ?>?<?php echo millitime(); ?>"></a>
														<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> <!-- END content-bottom -->
							<!-- </div> -->
						</div> <!-- END wrap-middle -->
						<div class="wrap-foot"></div> <!-- END wrap-bottom -->
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