<?php 
	$data = $attributes[ 'music' ];
?>
<?php if( sizeof( $data ) > 0 ): ?>
	<!-- <div class="content-middle"> -->
		<!-- <ul> -->
		<?php foreach( $data as $m ): ?>
			<!-- <li> -->
				<div class="music-list">
					<h4><?php _e( $m->GetCreator()->GetNama()); ?> - <?php _e( $m->GetTitle()); ?></h4>
					<?php echo do_shortcode( '[soundcloud url="https://api.soundcloud.com/tracks/'. $m->GetSource() . '" params="auto_play=false&hide_related=true&color=f11d1d&show_comments=false&show_user=true&show_reposts=false&visual=false&sharing=false&download=false&liking=false&buying=false" width="100%" height="120" iframe="true" /]' ); ?>
				</div>
			<!-- </li> -->
		<?php endforeach; ?>
		<!-- </ul> -->
	<!-- </div> -->
<?php endif; ?>