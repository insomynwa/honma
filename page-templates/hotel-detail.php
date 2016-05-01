<?php
/**
*
*	Template Name: Hotel - Detail
*
*/

get_header( 'sltg' );
$hotel = get_detail_hotel();
?>
<div id="content">
	<div class="container">
		<div class="shadow_block">
			<div class="page_section">
				<div class="gutter">
					<article class="single_post sltg-wrapper">
						<div class="sltg-filter">filter (remove)</div>
						<div id="sltg-content" class="sltg-content">
							<div><h1><?php _e( $hotel->GetNama() ); ?></h1></div>
							<div><img src="<?php _e( $hotel->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>"></div>
							<div>
								<?php foreach( $hotel->GetGambars() as $gbr ): ?>
									<?php if( $gbr->GetGambarUtama() != 1 ): ?>
										<img src="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>">
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
							<hr>
							<div><?php _e( $hotel->GetDeskripsi() ); ?></div>
							<hr>
							<div><?php _e( $hotel->GetOther() ); ?></div>
							<hr>
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