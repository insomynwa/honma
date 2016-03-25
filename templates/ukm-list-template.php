<?php 
	$data = $attributes[ 'product' ];
	//var_dump($attributes);
?>
<?php if( sizeof( $data ) > 0 ): ?>
	<style type="text/css">
		.sltg-content {
			margin: 15px;
		}
		.brick img {
			margin: 0;
			display: block;
		}
	</style>
	<?php foreach( $data as $pl ): ?>
		<div class="brick" style="width:{width}px;">
			<h3 style="width:100%"><?php _e( $pl->GetNama() ); ?></h3>
			<img src="<?php _e( $pl->GetGambarUtama()->GetLinkGambar() ); ?>" width="100%">
			<p><?php _e( $pl->GetDeskripsi() ); ?></p>
		</div>
	<?php endforeach; ?>
	
<!-- <div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php //foreach( $data as $pl ): ?>
			<tr>
				<td><?php// _e( $pl->GetNama() ) ?></td>
				<td>Edit | Delete</td>
			</tr>
			<?php //endforeach; ?>
		</tbody>
	</table>
</div> -->
<?php endif; ?>
<script type="text/javascript">
jQuery(document).ready( function($) {
	//var temp = "<div class='brick' style='width:{width}px;'><img src='i/photo/{index}.jpg' width='100%'></div>";
	var w = 1, h = 1, html = '', limitItem = 9;
	/*for (var i = 0; i < limitItem; ++i) {
		w = 1 + 3 * Math.random() << 0;
		html += temp.replace(/\{width\}/g, w*150).replace("{index}", i + 1);
	}*/
	$(".brick").each( function() {
		w = 1 + 3 * Math.random() << 0;
		$( this ).prop("style", "width:"+ w*150 + "px" );
	} );
	//$("#sltg-content").html(html);

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