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
						<div class="wrap-top">
							<div class="wrap-navi">
								<a href="<?php _e( home_url()); ?>">Home</a> / <a href="<?php _e( home_url() .'/ukm'); ?>">UKM</a> / <a href="#" class="active">Detail</a>
							</div>
						</div>
						<div class="wrap-middle">
							<div id="sltg-content" class="sltg-content">
								<div class="content-top">
									<h1><?php _e( $product->GetNama() ); ?></h1>
								</div> <!-- END content-top -->
								<hr>
								<article class="content-middle ctn-mid-dual">
									<div class="ctn-md-small">
										<img src="<?php _e( $product->GetGambarUtama()->GetLinkGambar() ); ?>" />
									</div>
									<div class="ctn-md-large">
										<div class=""><p class="ctn-article"><?php _e( $product->GetDeskripsi() ); ?></p></div>
										<hr>
										<div class=""><p class="ctn-article"><?php _e( $product->GetOther() ); ?></p></div>
										<hr>
										<div class="">
											<h2>Gallery</h2>
											<div class="ctn-pictgrid">
												<?php foreach( $product->GetGambars() as $gbr ): ?>
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
										<h2>Creator</h2>
										<div>
											<?php $ukm = $product->GetProducer(); _e( $ukm->GetNama() ); ?>
											<?php $bigImg = $ukm->GetGambarUtama(); ?>
											<?php  $url = wp_get_attachment_thumb_url( $bigImg->GetPostId() ); ?>
											<img src="<?php _e( $url ); ?>?<?php echo millitime(); ?>">
											<p><?php _e( $ukm->GetAlamat()); ?></p>
											<p><?php _e( $ukm->GetDeskripsi()); ?></p>
											<p><?php _e( $ukm->GetTelp()); ?></p>
											<p><?php _e( $ukm->GetOther()); ?></p>
											<ul>Other Product
												<?php foreach( $ukm->GetProducts() as $prod ): ?>
												<?php if($prod->GetId()!=$product->GetId()): ?>
												<?php $bigImg = $prod->GetGambarUtama(); ?>
												<?php  $url = wp_get_attachment_thumb_url( $bigImg->GetPostId() ); ?>
												<li><a href="<?php echo home_url().'/detail-product?product='. $prod->GetID(); ?>"><img src="<?php _e( $url ); ?>?<?php echo millitime(); ?>"></a></li>
												<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>
									<hr>
								</div> <!-- END content-bottom -->
							</div>
						</div> <!-- END wrap-middle -->
						<div class="wrap-bottom"></div> <!-- END wrap-bottom -->
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