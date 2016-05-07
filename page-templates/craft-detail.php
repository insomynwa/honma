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
						<div class="sltg-filter">filter (remove)</div>
						<div id="sltg-content" class="sltg-content">
							<div><h1><?php _e( $craft->GetNama() ); ?></h1></div>
							<div><img src="<?php _e( $craft->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>"></div>
							<div>
								<?php foreach( $craft->GetGambars() as $gbr ): ?>
									<?php if( $gbr->GetGambarUtama() != 1 ): ?>
										<img src="<?php _e( $gbr->GetLinkGambar() ); ?>?<?php echo millitime(); ?>">
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
							<hr>
							<div><?php _e( $craft->GetDeskripsi() ); ?></div>
							<hr>
							<div><?php _e( $craft->GetOther() ); ?></div>
							<hr>
							<div>
								<?php $person = $craft->GetProducer(); _e( $person->GetNama() ); ?>
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