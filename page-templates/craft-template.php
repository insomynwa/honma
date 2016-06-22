<?php
/**
*
*	Template Name: Craft
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
						<div class="wrap-head">
							<div class="content-wrapper wrap-navi">
								<div class="content-holder">
									<div class="content-holder-body">
										<div class="chb-column column-3">
											<?php $kategoris = get_kategori_craft(); ?>
											<?php if ( sizeof( $kategoris ) > 0 ): ?>
												<div class="single-row filter-left0">
													<p class="column-5"><?php /*$obj_salatiga_plugin->test2();*/ ?>Kategori</p>
													<select class="column-5" id="data-filter-kategori">
														<option value="0">all</option>
														<?php foreach( $kategoris as $kategori ): ?>
															<option value="<?php _e( $kategori->GetID() ); ?>"><?php _e( $kategori->GetNama() ); ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											<?php endif; ?>
										</div>
										<div class="chb-column column-5">
											<div class="single-row input-group0 filter-center0">
												<input type="text" id="txt-search" class="form-control column-7" placeholder="(nama)">
												<span class="input-group-btn column-3">
													<button id="btn-search" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search">Cari</span></button>
												</span>
											</div>
										</div>
										<div class="chb-column column-2">
											<div class="single-row filter-right0">
												<p class="column-5">Jumlah List</p>
												<select id="data-limit" class="column-5">
													<option value="25">25</option>
													<option value="50">50</option>
													<option value="100">100</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="wrap-body">
							<div class="content-wrapper">
								<div class="content-holder main-content">
									<div class="content-holder-body">
										<div class="chb-column column-10">
											<div id="sltg-content" class="sltg-content">
											</div>
										</div>
									</div>
									<div class="content-holder-foot">
										<div class="chb-column column-10">
											<div class="sltg-pagination"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="wrap-foot"></div>
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

	var data = {
			action: 'RetrievePaginationTemplate',
			listfor: "craft",
			limit: limit
		};

	if( searchfor != "" ) {
		data.search = searchfor;
	}
	if( kategori != 0 ) {
		data.category = kategori;
	}

	// retrievePagination( "craft", limit, searchfor, kategori, "div.sltg-pagination" );
	retrievePagination( data, "div.sltg-pagination" );

	$( "#data-limit" ).on( "change", function() {
		limit = this.value;
		data.limit = limit;

		// retrievePagination( "craft", limit, searchfor, kategori, "div.sltg-pagination" );
		retrievePagination( data, "div.sltg-pagination" );
	});	

	$( "#data-filter-kategori").on( "change", function() {
		kategori = this.value;
		data.category = kategori;
		// retrievePagination( "craft", limit, searchfor, kategori, "div.sltg-pagination" );
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

			// retrievePagination( "craft", limit, searchfor, kategori, "div.sltg-pagination" );
			retrievePagination( data, "div.sltg-pagination" );
		}
	});

});
</script>
<?php
get_footer();
