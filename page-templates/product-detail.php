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
						<div class="sltg-filter">f</div>
						<div id="sltg-content" class="sltg-content">
							<div><h1><?php _e( $product->GetNama() ); ?></h1></div>
							<div><img src="<?php _e( $product->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>"></div>
							<div>
								<?php foreach( $product->GetGambars() as $gbr ): ?>
									<?php if( $gbr->GetGambarUtama() != 1 ): ?>
										<img src="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>">
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
							<hr>
							<div><?php _e( $product->GetDeskripsi() ); ?></div>
							<hr>
							<div><?php _e( $product->GetOther() ); ?></div>
							<hr>
							<div>
								<?php $ukm = $product->GetUKM(); _e( $ukm->GetNama() ); ?>
							</div>
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