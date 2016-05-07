<?php 
	$data = $attributes[ 'craft' ];
?>
<?php if( sizeof( $data ) > 0 ): ?>
	<?php foreach( $data as $crf ): ?>
		<?php $w = 1 + 3 * rand_num() << 0;?>
		<div class="brick" style="width:<?php _e( $w * 150 ); ?>px;">
			<a href="<?php echo home_url().'/detail-craft?craft='. $crf->GetID(); ?>">
				<h3 style="width:100%"><?php _e( strtoupper( $crf->GetNama() ) ); ?></h3>
				<img src="<?php _e( $crf->GetGambarUtama()->GetLinkGambar() ); ?>?<?php echo millitime(); ?>" width="100%" alt="<?php _e( $crf->GetNama() ); ?>">
			</a>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<script type="text/javascript">
jQuery(document).ready( function($) {
	var w = 1, h = 1, html = '', limitItem = 9;

	var wall = new Freewall("#sltg-content");
	wall.reset({
		selector: '.brick',
		animate: true,
		cellW: 150,
		cellH: 'auto',
		onResize: function() {
			wall.fitWidth();
		}
	});
	var images = wall.container.find('.brick');
	images.find('img').load(function() {
		wall.fitWidth();
	});
} );
</script>