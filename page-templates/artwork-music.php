<?php
/**
*
*	Template Name: Music
*
*/

get_header( 'sltg' );
?>
<div id="content">
	<div class="container">
		<div class="shadow_block">
			<div class="page_section">
				<div class="gutter">
					<article class="single_post sltg-wrapper">
						<div class="sltg-filter">
							<?php $genres = get_genre_music(); ?>
							<?php if ( sizeof( $genres ) > 0 ): ?>
								<div class="filter-left">
									<span><?php /*$obj_salatiga_plugin->test2();*/ ?>Genre</span>
									<select id="data-filter-genre">
										<option value="0">all</option>
										<?php foreach( $genres as $genre ): ?>
											<option value="<?php _e( $genre->GetID() ); ?>"><?php _e( $genre->GetNama() ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							<?php endif; ?>
							<div class="input-group filter-center">
								<input type="text" id="txt-search" class="form-control" placeholder="(title)">
								<span class="input-group-btn">
									<button id="btn-search" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search">Cari</span></button>
								</span>
							</div>
							<div class="filter-right">
								<span>Jumlah List</span>
								<select id="data-limit">
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="20">20</option>
								</select>
							</div>
						</div>
						<div id="sltg-content" class="sltg-content">
						</div>
						<div class="sltg-pagination"></div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready( function($) {
	var limit = $( "#data-limit" ).val();
	var searchfor = $( "#txt-search").val();
	var isSearching = false;
	var genre = $( "#data-filter-genre" ).val();

	var data = {
			action: 'RetrievePaginationTemplate',
			listfor: "music",
			limit: limit
		};

	if( searchfor != "" ) {
		data.search = searchfor;
	}
	if( genre != 0 ) {
		data.genre = genre;
	}

	// retrievePagination( "music", limit, searchfor, genre, "div.sltg-pagination" );
	retrievePagination( data, "div.sltg-pagination" );

	$( "#data-limit" ).on( "change", function() {
		limit = this.value;
		data.limit = limit;

		// retrievePagination( "music", limit, searchfor, genre, "div.sltg-pagination" );
		retrievePagination( data, "div.sltg-pagination" );
	});	

	$( "#data-filter-genre").on( "change", function() {
		genre = this.value;
		data.genre = genre;
		// retrievePagination( "music", limit, searchfor, genre, "div.sltg-pagination" );
		retrievePagination( data, "div.sltg-pagination" );
	});

	$( "#btn-search" ).click( function(e) {
		if( ($( "#txt-search" ).val()).split(' ').join('') != '' ) {
			if( !isSearching ) {
				isSearching = true;
				$( this ).addClass('searching').html( "X" );
				$( "#txt-search").prop( "readonly" , true);
				searchfor = $( "#txt-search" ).val();

			}else {
				isSearching = false;
				$( this ).removeClass('searching').html( "Cari" );
				$( "#txt-search").prop( "readonly", false);
				searchfor = "";
				$( "#txt-search").val("");
			}

			data.limit = limit;
			data.search = searchfor;

			// retrievePagination( "music", limit, searchfor, genre, "div.sltg-pagination" );
			retrievePagination( data, "div.sltg-pagination" );
		}
	});

});
</script>
<?php
get_footer();