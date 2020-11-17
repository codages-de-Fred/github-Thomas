(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	document.addEventListener('DOMContentLoaded', () => { //lorsque tous les éléments de la page sont chargés
	
		//toutes les cases de la colonne note_generale sont rangés dans un tableau 
		let class_note_generale = Array.from(document.querySelectorAll('.column-note_generale'));
		//toutes les cases de la colonne convention sont rangées dans un tableau 
		let class_convention = Array.from(document.querySelectorAll('.column-convention'));

		//modification de l'apparence du bouton de l'input de type file
		let file = document.getElementById('input_file'); //récupère l'input de type file caché
		let choose = document.getElementById('faux_bouton_file'); //récupère le faux bouton file
		let label = document.getElementById('label_faux_bouton_file'); //récu^ère le label du faux bouton file

		//changement des couleur des chiffres de la colonne note générale selon sa valeur
		for (let i=1; i < class_note_generale.length; i++) {
			if (parseInt(class_note_generale[i].outerText) === 10) {
				class_note_generale[i].style.color = "#01D156";
			} else if (parseInt(class_note_generale[i].outerText) < 10 && parseInt(class_note_generale[i].outerText) >= 7) {
				class_note_generale[i].style.color = "#D14300";
			} else {
				class_note_generale[i].style.color = "red";
			}
		}

		//changement d'apparence des valeurs des cases de la colonne convention
		for (let i=1; i < class_convention.length-1; i++) {
			if (class_convention[i].outerText === "1") {
				class_convention[i].outerText = "oui";
			} else {
				class_convention[i].outerText = "non";
			}
		}

		//lorsque le faux bouton file est cliqué on active l'input de type file
		choose.addEventListener('click', () => {
			file.click();
		});
		//affiche le nom du fichier télécharger
		file.addEventListener('change', (e) => {
			let nom_du_fichier = e.target.files[0].name;
			label.outerText = nom_du_fichier;
		})
		
	});
})( jQuery );

