jQuery(document).ready( function ($) {

	window.retrievePagination = function RetrivePagination( target_data, limit, searchfor, kategori, target_element ) {
		var data = {
			action: 'RetrievePaginationTemplate',
			listfor: target_data,
			limit: limit,
			security: sltgtempscript.security
		};
		if( kategori != 0 ){
			data.category = kategori;
		}
		if( searchfor != "" ) {
			data.search = searchfor;
		}

		$.get(
			sltgtempscript.ajaxurl,
			data,
			function (response) {
				$( target_element ).html( response );
			}
		);
	}

	window.retrieveList = function RetrieveList( target_data, limit, page, searchfor, kategori, target_element) {
		//alert("TEST");
		var data = {
			action: 'RetrieveListTemplate',
			listfor: target_data,
			page: page,
			limit: limit,
			security: sltgtempscript.security
		};
		if( kategori != 0 ){
			data.category = kategori;
		}
		if( searchfor != "" ) {
			data.search = searchfor;
		}
		$.get(
			sltgtempscript.ajaxurl,
			data,
			function( response ) {
				$(target_element).html( response );
		});
	}
});