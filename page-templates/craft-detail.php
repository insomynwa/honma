<?php
/**
*
*	Template Name: Craft - Detail
*
*/

get_header( 'sltg' );

$craft = get_detail_craft();
?>
<div id="content">
	<div class="container">
		<div class="shadow_block">
			<div class="page_section">
				<div class="gutter">
					<article class="single_post sltg-wrapper">
						<div class="wrap-top">
							<div class="wrap-navi">
								<a href="<?php _e( home_url()); ?>">Home</a> / <a href="<?php _e( home_url() .'/artwork/visual/craft'); ?>">Craft</a> / <a href="#" class="active">Detail</a>
							</div>
						</div>
						<div class="wrap-middle">
							<div id="sltg-content" class="sltg-content">
								<div class="content-top">
									<h1><?php _e( $craft->GetNama() ); ?></h1>
									<?php $numImg = sizeof( $craft->GetGambars() ); ?>
								</div> <!-- END content-top -->
								<hr>
								<article class="content-middle ctn-mid-dual">
									<div class="ctn-md-small">
										<img src="<?php _e( $craft->GetGambarUtama()->GetLinkGambar() ); ?>" />
									</div>
									<div class="ctn-md-large">
										<div><p class="ctn-article"><?php _e( $craft->GetDeskripsi() ); ?></p></div>
										<hr>
										<div><p class="ctn-article"><?php _e( $craft->GetOther() ); ?></p></div>
										<hr>
										<div class="">
											<h2>Gallery</h2>
											<div class="ctn-pictgrid">
												<?php foreach( $craft->GetGambars() as $gbr ): ?>
												<a class="fancybox" rel="gallery1" href="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>"><img class="pictgrid" src="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>"></a>
												<!-- <div class="pictgrid" style="background-image:url()"></div> -->
												<?php endforeach; ?>
											</div>
										</div>
										<hr class="last-separator">
									</div>
								</article> <!-- END content-middle -->
								<div class="content-bottom">
									<div class="">
										<h2>Creator</h2>
										<div>
											<?php $ukm = $craft->GetProducer(); _e( $ukm->GetNama() ); ?>
										</div>
									</div>
									<hr>
								</div> <!-- END content-bottom -->
							</div>
							<div class="sltg-pagination"></div>
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