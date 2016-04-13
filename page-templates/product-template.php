<?php
/**
*
*	Template Name: Product
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
							<?php $kategoris = get_kategori_product(); ?>
							<?php if ( sizeof( $kategoris ) > 0 ): ?>
								<div>
									<label><?php /*$obj_salatiga_plugin->test2();*/ ?>Kategori</label>
									<select id="data-filter-kategori">
										<option value="0">all</option>
										<?php foreach( $kategoris as $kategori ): ?>
											<option value="<?php _e( $kategori->GetID() ); ?>"><?php _e( $kategori->GetNama() ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							<?php endif; ?>
							<div class="input-group">
								<input type="text" id="txt-search" class="form-control" placeholder="(nama)">
								<span class="input-group-btn">
									<button id="btn-search" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search">Cari</span></button>
								</span>
							</div>
							<div>
								<label>Jumlah List</label>
								<select id="data-limit">
									<option value="10">10</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>
							</div>
						</div>
						<!-- <div>pagination</div> -->
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
	var kategori = $( "#data-filter-kategori" ).val();

	//doRetrievePagination( "product", 1, "", "div.sltg-pagination" );
	retrievePagination( "product", limit, searchfor, kategori, "div.sltg-pagination" );

	$( "#data-limit" ).on( "change", function() {
		//selected_page = 1;
		limit = this.value;
		//searchfor = "";//$( "#txt-search" ).val();
		//if( isSearching ) searchfor = $( "#txt-search" ).val();

		// $( ".pagination a.page-" + current_page).parent().removeClass("active");
		// $( ".pagination a.page-" + selected_page ).parent().addClass("active");
		//current_page = selected_page;

		retrievePagination( "product", limit, searchfor, kategori, "div.sltg-pagination" );
		//retrieveList( "#plugin-data-list" );
	});	

	$( "#data-filter-kategori").on( "change", function() {
		kategori = this.value;
		retrievePagination( "product", limit, searchfor, kategori, "div.sltg-pagination" );
	});

	$( "#btn-search" ).click( function(e) {
		if( ($( "#txt-search" ).val()).split(' ').join('') != '' ) {
			if( !isSearching ) {
				isSearching = true;
				$( this ).addClass('searching').html( "<span class='glyphicon glyphicon-remove-circle'></span>" );
				$( "#txt-search").prop( "readonly" , true);
				searchfor = $( "#txt-search" ).val();

			}else {
				isSearching = false;
				$( this ).removeClass('searching').html( "<span class='glyphicon glyphicon-search'></span>" );
				$( "#txt-search").prop( "readonly", false);
				searchfor = "";
				$( "#txt-search").val("");
			}
			//limit = $( "#data-limit" ).val();

			/*searchfor = ( $( "#txt-search").val() ).split(' ').join('');;
			if( searchfor != "" ) {
				isSearching = true;
			}*/
			retrievePagination( "product", limit, searchfor, kategori, "div.sltg-pagination" );
		}
		//current_page = 1;
		//selected_page = current_page;
		//searchFor( searchfor, "#plugin-data-list" );
	});

});
</script>
<?php
get_footer();
