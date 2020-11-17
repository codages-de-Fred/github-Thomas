(function( $ ) {
	'use strict';
	document.addEventListener('DOMContentLoaded', () => { //lorsque la page est affichée

		/**** pour la page ville***** */

		let search_ville = document.getElementById('search_ville');
		let button = document.getElementById('button_search');
		search_ville.addEventListener('focus', () => {
			search_ville.addEventListener('keyup', (e) => {
				if (e.key === 'Enter') {
					button.click();
				}
			});
		});
	});
})( jQuery );
