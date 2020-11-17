<?php
session_start();
//suivant le nom de l'action la globale session prend la valeur envoyée en post par le formulaire search
//déclaré ici pour afficher la valeur recherchée dans l'input search
if (!isset($_SESSION['departement_ou_codepostal'])) { //pour la page ville, recherche par departement ou code postal
	$_SESSION['departement_ou_codepostal'] = "";
}
if(!isset($_SESSION['region'])) { //pour la page départements, recherche de département par une région sélectionnée
	$_SESSION['region'] = "";
}
if (!isset($_SESSION['type_annonce'])) { //pour la page annonce, recherche par type d'annonce
	$_SESSION['type_annonce'] = ""; 
}
if (!isset($_SESSION['role'])) { //pour la page annonce, recherche par role de créateur de l'annonce
	$_SESSION['role'] = "";
}
if (!isset($_SESSION['nom_client'])) {
	$_SESSION['nom_client'] = "";
}
if (!isset($_SESSION['mail_client'])) {
	$_SESSION['mail_client'] = "";
}
if (!isset($_SESSION['annonce_a_verifier'])) {
	$_SESSION['annonce_a_verifier'] = "";
}
if (isset($_REQUEST['action'])) {
	/***pour la page ville, recherche par code postal ou numéro de département */
	if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_VILLE) { 
		if (isset($_POST[Affuteo_Admin::SEARCH_VILLE])) {
			$_SESSION['departement_ou_codepostal'] = $_POST[Affuteo_Admin::SEARCH_VILLE];
		}
	}
	if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_VILLE) { //si le bouton reset est appuyé on vide la session
		$_SESSION['departement_ou_codepostal'] = "";
	}
	/***pour la page departement, recherche via le select des régions */
	if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_DEPARTEMENT) {
		if (isset($_POST[Affuteo_Admin::SEARCH_DEPARTEMENT])) {
			$_SESSION['region'] = $_POST[Affuteo_Admin::SEARCH_DEPARTEMENT];
		}
	}
	if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_DEPARTEMENT) {
		$_SESSION['region'] = "";
	}
	/**pour la page annonce, recherche par type d'annonce */
	if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_TYPE) {
		$_SESSION['type_annonce'] = $_POST[Affuteo_Admin::SEARCH_TYPE];
	}
	if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_TYPE) {
		$_SESSION['type_annonce'] = "";
	}
	if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_ROLE) {
		$_SESSION['role'] = $_POST['role'];
	}
	if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_ROLE) {
		$_SESSION['role'] = "";
	}
	if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_NOM_CLIENT) {
		$_SESSION['nom_client'] = $_POST['nom_client'];
	}
	if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_NOM_CLIENT ) {
		$_SESSION['nom_client'] = "";
	}
	if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_MAIL_CLIENT) {
		$_SESSION['mail_client'] = $_POST['mail_client'];
	}
	if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_MAIL_CLIENT) {
		$_SESSION['mail_client'] = "";
	}
	if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_ANNONCE_A_VERIFIER) {
		$_SESSION['annonce_a_verifier'] = $_POST['annonce_a_verifier'];
	}
	if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_ANNONCE_A_VERIFIER) {
		$_SESSION['annonce_a_verifier'] = "";
	}
	if ($_REQUEST['filtre'] === 'nom_client') {
		$_SESSION['nom_client'] = $_POST['nom_client'];
	}
	if ($_REQUEST['filtre'] === 'reset_nom_client') {
		$_SESSION['nom_client'] = "";
	}
	if ($_REQUEST['filtre'] === 'mail_client') {
		$_SESSION['mail_client'] = $_POST['mail_client'];
	}
	if ($_REQUEST['filtre'] === 'reset_mail_client') {
		$_SESSION['mail_client'] = "";
	}
	
}


/**
 * The admin-specific functionality of the plugin.
 *
 * @link       affuteo
 * @since      1.0.0
 *
 * @package    Affuteo
 * @subpackage Affuteo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Affuteo
 * @subpackage Affuteo/admin
 * @author     indexld <index@indexld.com>
 */
class Affuteo_Admin {

	
							/********************************************
							 * constantes des actions pour les requêtes *
							 *******************************************/
	
	//POUR LES ANNONCES
	const DELETE_ANNONCE = 'delete_annonce';
	const DELETE_VALID_ANNONCE = 'delete_valid_annonce';
	const AJOUTER_ANNONCE = 'ajouter_annonce';
	const AJOUT_VALID_ANNONCE = 'ajout_valid_annonce';
	const UPDATE_ANNONCE = 'update_annonce';
	const UPDATE_VALID_ANNONCE = 'update_valid_annonce';
	//POUR LES ATOUTS
	const DELETE_ATOUT = 'delete_atout';
	const DELETE_VALID_ATOUT = 'delete_valid_atout';
	const UPDATE_ATOUT = 'update_atout';
	const UPDATE_VALID_ATOUT = 'update_valid_atout';
	const AJOUT_ATOUT = 'ajout_atout';
	const AJOUT_VALID_ATOUT = 'ajout_valid_atout';
	//POUR LES TYPES D'ANNONCE
	const DELETE_TYPE = 'delete_type';
	const DELETE_VALID_TYPE = 'delete_valid_type';
	const UPDATE_TYPE = 'update_type';
	const UPDATE_VALID_TYPE = 'update_valid_type';
	const AJOUT_TYPE = 'ajout_type';
	const AJOUT_VALID_TYPE = 'ajout_valid_type';
	const SEARCH_TYPE = 'search_type';
	const RESET_SEARCH_TYPE = 'reset_search_type';
	//POUR LES VILLES
	const DELETE_VILLE = 'delete_ville';
	const VALIDATION_DELETE_VILLE = 'delete_valid_ville';
	const UPDATE_VILLE = 'update_ville';
	const UPDATE_VALID_VILLE = 'update_valid_ville';
	const AJOUTER_VILLE = 'ajouter_ville';
	const AJOUT_VALID_VILLE = 'ajout_valid_ville';
	const SEARCH_VILLE = 'search_ville';
	const RESET_SEARCH_VILLE = 'reset_search_ville';
	//POUR LES DEPARTEMENTS
	const DELETE_DEPARTEMENT = 'delete_departement';
	const DELETE_VALID_DEPARTEMENT = 'delete_valid_departement';
	const UPDATE_DEPARTEMENT = 'update_departement';
	const UPDATE_VALID_DEPARTEMENT = 'update_valid_departement';
	const AJOUTER_DEPARTEMENT = 'ajouter_departement';
	const AJOUT_VALID_DEPARTEMENT = 'ajout_valid_departement';
	const SEARCH_DEPARTEMENT = 'search_departement';
	const RESET_SEARCH_DEPARTEMENT = 'reset_search_departement';
	//POUR LES REGIONS
	const DELETE_REGION = 'delete_region';
	const DELETE_VALID_REGION = 'delete_valid_region';
	const UPDATE_REGION = 'update_region';
	const UPDATE_VALID_REGION = 'update_valid_region';
	const AJOUTER_REGION = 'ajouter_region';
	const AJOUT_VALID_REGION = 'ajout_valid_region';
	//POUR LES ROLES
	const SEARCH_ROLE = 'search_role';
	const RESET_SEARCH_ROLE = 'reset_search_role';
	//POUR LA RECHERCHE PAR NOM DE CLIENT
	const SEARCH_NOM_CLIENT = 'search_nom_client';
	const RESET_SEARCH_NOM_CLIENT = 'reset_search_nom_client';
	//POUR LA RECHERCHE PAR MAIL DE CLIENT
	const SEARCH_MAIL_CLIENT = 'search_mail_client';
	const RESET_SEARCH_MAIL_CLIENT = 'reset_search_mail_client';
	//POUR LA RECHERCHE DES ANNONCES A VERIFIER
	const SEARCH_ANNONCE_A_VERIFIER = 'search_annonce_a_verifier';
	const RESET_SEARCH_ANNONCE_A_VERIFIER = 'reset_search_annonce_a_verifier';
	
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() { //lien pour le CSS


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/affuteo-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() { //lien pour les fonctions javascript

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/affuteo-admin.js', array( 'jquery' ), $this->version, false );

	}

						/*************************************************
						 *  Affichage du menu annonce dans la page admin *
						 *************************************************/

	/**
	 * affiche ild_localisations dans la page wp-admin
	 *  et ses sous-menus : ild_ville, ild_departement et ild_region
	 * 
	 * fonction appelée lors des rechargements de page par le fichier class-affuteo.php
	 * on y déclare toutes les actions
	 */
	public function affichage_dashboard_ild_ville() {
		//pour le menu ild annonces
		add_menu_page( 'Annonces', 'Annonces', 'manage_options', 'annonces', array($this, 'retourner_affichage_page_annonce'), 'dashicons-list-view', 1);

		//affichage d'une séparation entre 2 parties
		add_submenu_page( 'annonces', '<div class="separator_annonces_submenu"', '<div class="separator_annonces_submenu"', 'manage_options', '', '',1 );

		//pour le menu ild gérer les annonces
		add_submenu_page( 'annonces', 'atouts', 'atouts', 'manage_options', 'annonces/atouts', array($this, 'retourner_affichage_liste_atout'), 2 );
		add_submenu_page( 'annonces', 'types', 'types', 'manage_options', 'annonces/liste_types', array($this, 'retourner_affichage_liste_type'), 3);
		add_submenu_page( 'annonces', 'photos', 'photos', 'manage_options', 'annonces/liste_photos', array($this, 'retourner_affichage_liste_photo'), 4);
		add_submenu_page( 'annonces', '', '', 'manage_options', 'annonces/liste_clients', array($this, 'retourner_affichage_liste_client'), 5);
		
		//affichage d'une séparation entre 2 parties
		add_submenu_page( 'annonces', '<div class="separator_annonces_submenu"', '<div class="separator_annonces_submenu"', 'manage_options', '', '',5 );
		
		//pour le menu gérer les localités
		add_submenu_page( 'annonces', 'villes', 'villes','manage_options', 'annonces/villes', array($this, 'retourne_affichage_page_ville'), 6 );
		add_submenu_page( 'annonces', 'départements', 'départements', 'manage_options', 'annonces/departement', array($this, 'retourne_affichage_page_departement'), 7 );
		add_submenu_page( 'annonces', 'régions', 'régions', 'manage_options', 'annonces/region', array($this, 'retourne_affichage_page_region'), 8 );
	
	}

	/**
	 * @return  lien d'affichage de la page du menu annonces
	 */
	public function retourner_affichage_page_annonce() {
		require_once 'partials/ild_affuteo_annonce_display.php';
	}

						/*** annonces *** */

	/**
	 * @return lien d'affichage du sous-menu liste des atouts
	 */
	public function retourner_affichage_liste_atout() {
		require_once 'partials/annonces/ild_affuteo_liste_atout_display.php';
	}

	/**
	 * @return lien d'affichage du sous-menu liste des types d'annonce
	 */
	public function retourner_affichage_liste_type() {
		require_once 'partials/annonces/ild_affuteo_liste_type_display.php';
	}

	/**
	 * @return lien d'affichage du sous-menu liste des photos
	 */
	public function retourner_affichage_liste_photo() {
		require_once 'partials/annonces/ild_affuteo_liste_photo_display.php';
	}

	/**
	 * @return lien d'affichage de la page des clients
	 */
	public function retourner_affichage_liste_client() {
		require_once 'partials/annonces/ild_affuteo_liste_client_display.php';
	}

						/*** localités *** */
	
	/**
	 * @return lien d'affichage de la page du sous-menu ville
	 */
	public function retourne_affichage_page_ville() {
		require_once 'partials/localites/ild_affuteo_ville_display.php';
	}

	/**
	 * @return lien d'affichage de la page du sous-menu departement
	 */
	public function retourne_affichage_page_departement() {
		require_once 'partials/localites/ild_affuteo_departement_display.php';
	}

	/**
	 * @return lien d'affichage de la page du sous-menu region
	 */
	public function retourne_affichage_page_region() {
		require_once 'partials/localites/ild_affuteo_region_display.php';
	}
								/*************************
								*      les actions       *
								*************************/

	/*
	* fonction appelée par le fichier class-affuteo.php 
	* comprend la liste des actions utilisées 
	*/
	public function liste_actions() {
		add_action( 'update_photo', array($this, 'update_photo'),10,3 );
		add_action( 'delete_photo', array($this, 'delete_photo'),10,2 );
		add_action( 'add_photo', array($this, 'add_photo'),10,2 );
	}

	/**
	 * @param [string] $id_annonce
	 * @param [string] $id_photo
	 * @param [string] $designation_photo
	 * @return void modifie la désignation d'une photo et la date de mise à jour de l'annonce
	 */
	function update_photo($id_annonce, $id_photo, $designation_photo) {

		global $wpdb; //connexion à la base de données du site
			$derror = true;
			$wpdb->query('START TRANSACTION');
			$requete_update_photo = "UPDATE ild_url_photo SET designation = '$designation_photo' WHERE ID = '$id_photo'";
			$update_photo = $wpdb->query($requete_update_photo);
			if (!$update_photo) {
				$derror = false;
			} 
			
			//changer la date de modification de l'annonce
			$date = $this->retourner_date_actuelle();
			$requete_update_annonce = "UPDATE ild_annonce SET date_modification = '$date' WHERE ID = '$id_annonce'";
			$update_annonce = $wpdb->query($requete_update_annonce);
			if (!$update_annonce) {
				$derror = false;
			} 
			
			//vérification de la transaction
			if($derror) {
				$wpdb->query('COMMIT');
			} else {
				$wpdb->query('ROLLBACK');
			}
	}

	/**
	 * Undocumented function
	 *
	 * @param [string] $id_annonce
	 * @param [string] $id_photo
	 * @return void supprime la photo sélectionnée dans la table relationnelle ild_annonce_url_photo, dans la table ild_url_photo,
	 * dans le dossier contenant les photos des annonces et modifie la date_modification de l'annonce
	 */
	function delete_photo($id_annonce, $id_photo) {
		$url_photo_delete = ''; //string de l'url de la photo à supprimer
		global $wpdb; //connexion à la base de données du site

		$derror = true; //booleen pour la transaction
		$wpdb->query('START TRANSACTION'); //si quelque chose se passe mal on annule les requêtes

		//récupérer l'url de la photo à supprimer
		$requete_recuperer_url_photo = "SELECT URL FROM ild_url_photo WHERE ID = '$id_photo'";
		$url_photo_delete = $wpdb->get_var($requete_recuperer_url_photo);
		if (!$url_photo_delete) {
			$derror = false;
		}

		//supprimer la photo dans la table de relation ild_url_photo_annonce
		$requete_supprimer_photo_dans_relation_table = "DELETE FROM ild_annonce_url_photo WHERE ID_ild_url_photo = '$id_photo' AND ID_ild_annonce = '$id_annonce'";
		$delete_photo_relation_table = $wpdb->query($requete_supprimer_photo_dans_relation_table);
		if (!$delete_photo_relation_table) {
			$derror = false;
		}

		//supprimer la photo dans la table ild_url_photo
		$requete_supprimer_photo_dans_url_photo = "DELETE FROM ild_url_photo WHERE ID = '$id_photo'";
		$delete_photo_url_photo = $wpdb->query($requete_supprimer_photo_dans_url_photo);
		if (!$delete_photo_url_photo) {
			$derror = false;
		}

		//supprimer la photo dans le dossier photos à la base du site
		unlink($url_photo_delete);

		//modifier la date_modification dans ild_annonce
		$date = $this->retourner_date_actuelle();
		$requete_modifier_annonce = "UPDATE ild_annonce SET date_modification = $date WHERE ID = '$id_annonce'";
		$modifier_annonce = $wpdb->query($requete_modifier_annonce);
		if(!$modifier_annonce) {
			$derror = false;
		}

		//vérification de la transaction
		if($derror) {
			$wpdb->query('COMMIT');
		} else {
			$wpdb->query('ROLLBACK');
		}
	}

	/**
	 * @param [string] $id_annonce
	 * @param [array] $file
	 * @return void enregistre les photos envoyés dans les tables ild_url_photo et ild_annonce_url_photo (relationnelle)
	 * ajoute les photos dans le dossier contenant les photos des annonces à la racine du site
	 */
	function add_photo($id_annonce, $file) {
		
		$derror = false; //booleen pour d'erreur pour la transaction
		$tableau_id_photos = []; //tableau contenant les ID des photos à insert

		foreach ($file['type'] as $type) { //accepte que les images de type jpeg, jpg ou png
			if ($type === 'image/jpeg' || 
				$type === 'image/jpg' ||
				$type === 'image/png') {
					$derror = true;
				}
		}

		global $wpdb; //connexion à base de données du site

		$wpdb->query('START TRANSACTION');
		//créer les ID en UUID pour chaque photo
		$compteur = count($file['name']); //compte le nombre de photos envoyées

		if ($compteur > 0) {
			for($i=0; $i < $compteur; $i++) {
				$id_photo_uuid = $this->generer_id_unique_en_uuid('ild_url_photo'); //génère un ID unique pour chaque photo
				array_push($tableau_id_photos, $id_photo_uuid);//pousse chaque ID dans le tableau contenant les ID des photos
			}
			//ajouter les photos dans la table ild_url_photo
			$requete_photo = $this->ajouter_photo_dans_url_photo($file, $tableau_id_photos);
			foreach($requete_photo as $req) {
				$action_requete_chaque_photo = $wpdb->query($req);
				if (!$action_requete_chaque_photo) {
					$derror = false;
				}
			}
			//pour la table de relation ild_annonce_url_photo
			$requete_annonce_photo = $this->ajouter_annonce_photo_table_relation($id_annonce, $tableau_id_photos);
			foreach($requete_annonce_photo as $req) {
				$action_requete_chaque_relation_annonce_photo = $wpdb->query($req);
				if (!$action_requete_chaque_relation_annonce_photo) {
					$derror = false;
				}
			}
	
			//vérification de la transaction
			if ($derror) {
				$wpdb->query('COMMIT');
			} else {
				$wpdb->query('ROLLBACK');
			}
		}		
	}

								/****************************************
								 * les fonctions de class Affuteo_Admin *
								 ***************************************/

	/**
	 * function qui génère un id unique en UUID
	 *
	 * @param [string] $table
	 * @return string ID via la fonction uniqid() de PHP 
	 */
	function generer_id_unique_en_uuid($table) {
		$id_unique= uniqid('', true); //ID unique en varchar(23)

		//récupère les ID de la table dans un tableau
		global $wpdb;
			$slocal_requete = "SELECT ID FROM $table";
			$liste_id = $wpdb->get_results($slocal_requete, ARRAY_A);
		
		while (in_array($id_unique, $liste_id)) { //[0] pour réupérer les ID
			$id_unique = uniqid('', true);
		}	
		return $id_unique;
	}

	/**
	 * retourne date actuelle au format AAAA-MM-JJ
	 *
	 * @return date
	 */
	function retourner_date_actuelle() {
		$date = new DateTime;
		$date = $date->format('Y-m-d');
		return $date;
	}

	/**
	 * @param [array] $file
	 * @param [array] $tableau_id_photos
	 * @return string la requête insert de la table ild_url_photo
	 */
	function ajouter_photo_dans_url_photo($file, $tableau_id_photos) {
		$requete_photos = []; //tableau contenant les requêtes pour les photos et leur ID

		//récupérer le nombre de photos
		//photos renvoyées sous forme de tableau associatif : 
			//rangés par nom, tmp_name,... non par photo
		$compteur = count($file['name']);
		for($i=0; $i < $compteur; $i++) {

			$id = $tableau_id_photos[$i];

			$name_photo = $file['name'][$i];
			
			//permet de donner un nom aléatoire afin d'éviter des fichiers de même nom
			$date = new Datetime();//récupère la date du moment
			$date_to_string =  strval((rand(1,99))*($date->getTimestamp())); //multiplie la timestamp par un nombre aléatoire compris entre 1 et 99
			
			//envoi de la photo dans le dossier photos, à la racine du site
			$tmp_name = $file['tmp_name'][$i];
			$nom = $date_to_string . $file['name'][$i];
			move_uploaded_file($tmp_name, "../photos/$nom");

			$url_photo = "../photos/".$nom; //récupère l'adresse de la photo
			
			$requete = "INSERT INTO ild_url_photo (ID, designation, URL) VALUES ( '$id' , '$name_photo', '$url_photo')";
			//mettre les varaiables entre simples quotes pour échapper les caractères spéciaux

			array_push($requete_photos, $requete); 
		}
		return $requete_photos;
	}

	/**
	 * @param [string] $id_annonce
	 * @param [array] $tableau_id_photos
	 * @return string requête insert pour la table de relation annonce photo
	 */
	function ajouter_annonce_photo_table_relation($id_annonce, $tableau_id_photos) {
		$requete_annonce_photo = [];

		foreach($tableau_id_photos as $id) {
			$requete = "INSERT INTO ild_annonce_url_photo (ID_ild_annonce, ID_ild_url_photo) VALUES ('$id_annonce', '$id')";
			array_push($requete_annonce_photo, $requete);
		} 
		return $requete_annonce_photo;
	}

	/**
	 * @param [string] $table
	 * @return array associatif du contenu d'une table
	 */
	function retourner_tout_de_la_table($table) {
		$contenu = []; //tableau associatif contenant tout le contenu d'une table
		global $wpdb; //connexion à la base de données du site
			$requete = "SELECT * FROM $table";
			$contenu = $wpdb->get_results($requete, ARRAY_A);
		return $contenu;
	}

	/**
	 * @param [string] $id_url_photo
	 * @return string ID de l'annonce recherchée
	 */
	function retourner_id_annonce($id_url_photo) {
		$id_annonce = ""; //ID de l'annonce recherchée

		global $wpdb; //connexion à la base de données du site
			$requete = "SELECT r.ID_ild_annonce FROM 
							ild_url_photo AS p 
							INNER JOIN ild_annonce_url_photo AS r ON p.ID = r.ID_ild_url_photo 
						WHERE p.ID = '$id_url_photo'";
			$id_annonce = $wpdb->get_var($requete);
		return $id_annonce;
	}
	

								/**************************
								*    les shortcodes       *
								**************************/

	/*
	* fonction appelée par le fichier class-affuteo.php 
	* comprend la liste des shortcodes utilisés 
	*/
	public function liste_shortcodes() {

		add_shortcode( 'affiche_la_table_annonce', array($this, 'affiche_la_table_annonce') );
		add_shortcode( 'affiche_la_table_ville', array($this, 'affiche_la_table_ville') );
		add_shortcode( 'affiche_la_table_departement', array($this, 'affiche_la_table_departement') );
		add_shortcode( 'affiche_la_table_region', array($this, 'affiche_la_table_region') );
		add_shortcode( 'affiche_la_table_atout', array($this, 'affiche_la_table_atout') );
		add_shortcode( 'affiche_la_table_type', array($this, 'affiche_la_table_type') );
		add_shortcode( 'affiche_la_table_photo', array($this, 'affiche_la_table_photo') );
		add_shortcode( 'affiche_la_table_client', array($this, 'affiche_la_table_client') );
		
		add_shortcode( 'afficher_roles', array($this, 'afficher_roles') );
		add_shortcode( 'afficher_nom_client', array($this, 'afficher_nom_client') );

		add_shortcode( 'compteur_total_annonces', array($this, 'compteur_total_annonces') );
		add_shortcode( 'compteur_annonces_a_verifier', array($this, 'compteur_annonces_a_verifier') );

		add_shortcode( 'affiche_valeur_champ', array($this, 'affiche_valeur_champ') );
		add_shortcode( 'retourne_valeur_champ', array($this, 'retourne_valeur_champ') );

		add_shortcode( 'afficher_checkbox_annonce_verifiee', array($this, 'afficher_checkbox_annonce_verifiee') );

		add_shortcode( 'affiche_select', array($this, 'affiche_select') );

		add_shortcode( 'affiche_atout_checkbox', array($this, 'affiche_atout_checkbox') );
		add_shortcode( 'affiche_atout_checkbox_checked', array($this, 'affiche_atout_checkbox_checked') );
		add_shortcode( 'affiche_visible_checkbox_checked', array($this, 'affiche_visible_checkbox_checked') );

		add_shortcode( 'affiche_radio', array($this, 'affiche_radio') );
		add_shortcode( 'affiche_radio_checked', array($this, 'affiche_radio_checked') );

		add_shortcode( 'affiche_designation_ville', array($this, 'affiche_designation_ville') );
		add_shortcode( 'affiche_designation_departement', array($this, 'affiche_designation_departement') );
		add_shortcode( 'afficher_designation_region', array($this, 'afficher_designation_region') );
		add_shortcode( 'affiche_designation_type_annonce', array($this, 'affiche_designation_type_annonce') );

		add_shortcode( 'afficher_session_search', array($this, 'afficher_session_search') );
		add_shortcode( 'afficher_session_designation_region', array($this, 'afficher_session_designation_region') );
		add_shortcode( 'afficher_designation_session_type_annonce', array($this, 'afficher_designation_session_type_annonce') );

		add_shortcode( 'afficher_photos_annonce', array($this,'afficher_photos_annonce') );

	}

	

	/************************ affichage de la table des annonces ***************************************** */
	/**
	 * @return void display() de la table ild_annonce
	 */
	public function affiche_la_table_annonce() {
		$clocal_list_annonce = new ild_annonce_class(); //nouvelle class wp_list_table
		$clocal_list_annonce->prepare_items(); //appelle les items à préparer

		//affiche la class
		$clocal_list_annonce->display();
	}

	/************************ affichage de la table des ville ********************************************/

	/**
	 * @return void display() de la table ild_ville
	 */
	public function affiche_la_table_ville() {
	    $clocal_list_ville = new ild_ville_class(); //nouvelle class wp_list_table
	    $clocal_list_ville->prepare_items(); //appelle les items à préparer

	    //affiche la class
	    $clocal_list_ville->display();
	}
	/************************ affichage de la table des départements ********************************************/

	/**
	 * @return void display() de la table ild_departement
	 */
	public function affiche_la_table_departement() {
	    $clocal_list_departement = new ild_departement_class(); //nouvelle class wp_list_table
	    $clocal_list_departement->prepare_items(); //appelle les items à préparer

	    //affiche la class
	    $clocal_list_departement->display();
	}
	/************************ affichage de la table des régions ********************************************/

	/**
	 * @return void display() de la table ild_region
	 */
	public function affiche_la_table_region() {
	    $clocal_list_region = new ild_region_class(); //nouvelle class wp_list_table
	    $clocal_list_region->prepare_items(); //appelle les items à préparer

	    //affiche la class
	    $clocal_list_region->display();
	}

	/************************ affichage de la table des atouts ********************************************/

	/**
	 * @return void display() de la table ild_atout
	 */
	public function affiche_la_table_atout() {
	    $clocal_list_atout = new ild_atout_class(); //nouvelle class wp_list_table
	    $clocal_list_atout->prepare_items(); //appelle les items à préparer

	    //affiche la class
	    $clocal_list_atout->display();
	}

	/************************ affichage de la table des types ********************************************/

	/**
	 * @return void display() de la table ild_type_annonce
	 */
	public function affiche_la_table_type() {
	    $clocal_list_type = new ild_type_class(); //nouvelle class wp_list_table
	    $clocal_list_type->prepare_items(); //appelle les items à préparer

	    //affiche la class
	    $clocal_list_type->display();
	}

	public function affiche_la_table_photo() {
		$list_photo = new ild_photo_class(); //nouvelle class wp_list_table
		$list_photo->prepare_items();

		//affiche le class
		$list_photo->display();
	}

	public function affiche_la_table_client() {
		$list_client = new ild_client_class(); //nouvelle class wp_list_table
		$list_client->prepare_items();

		//affiche le class
		$list_client->display();
	}

	/**
	 * @return string code HTML contenant la liste des rôles sous forme d'options
	 */
	public function afficher_roles() {

		$roles = []; //tableau contenant la liste des rôles en anglais
		$roles_traduits = []; //tableau contenant la liste des rôles traduits dans la langue du site
		$html = ''; //contient le code HTML des rôles en options

		$wp_roles = new WP_Roles(); //créé un nouveau rôle
		$tableau_associatif_roles = $wp_roles->get_names(); //le nouveau rôle récupère la liste des rôles
		$tableau_associatif_roles_traduits = array_map( 'translate_user_role', $tableau_associatif_roles ); //traduit les rôles dans la langue du site

		foreach($tableau_associatif_roles as $r) { //on récupère seulement les valeurs du tableau associatif 
			array_push($roles, $r);
		}
		foreach($tableau_associatif_roles_traduits as $rt) { //on récupère seulement les valeurs du tableau associatif
			array_push($roles_traduits, $rt);
		}

		for ($i=0; $i < count($roles); $i++) {
			$html .= '<option value="'.$roles[$i].'">'.$roles_traduits[$i].'</option>';
		}
		
		echo $html;
	}

	/**
	 * @param [string] $atts id (ID d'un client)
	 * @return string nom et prenom d'un client
	 */
	public function afficher_nom_client($atts) {
		$nom_client = '';

		extract(shortcode_atts( array('id' => ''), $atts ));
		
		global $wpdb; //connexion à la bae de données du site
			$requete = "SELECT display_name FROM wp_ild_af_users WHERE ID = '$id'";
			$nom_client = $wpdb->get_var($requete);
		
		echo $nom_client;
	}

	/**
	 * @return string int nombre total des annonces
	 */
	public function compteur_total_annonces() {
		$nombre_total_annonces = 0; //compteur du nombre d'annonces

		global $wpdb; //connexion à la base de données du site
			$requete = "SELECT COUNT(ID) FROM ild_annonce";
			$nombre_total_annonces = $wpdb->get_var($requete);
		echo $nombre_total_annonces;
	}

	/**
	 * @return string int nombre des annonces à vérifier
	 */
	public function compteur_annonces_a_verifier() {
		$nombre_annonces_a_verifier = 0; //compteur d'annonces à vérifier

		global $wpdb; //connexion à la base de données du site
			$requete = "SELECT COUNT(ID) FROM ild_annonce WHERE annonce_verifiee = '0'";
			$nombre_annonces_a_verifier = $wpdb->get_var($requete);
		echo $nombre_annonces_a_verifier;
	}

	/*********************** affichage des valeurs du champ envoyé en paramètres **************************/

	/**
	 * @param [string] $atts table id champ
	 * @return void echo la valeur demandée de la requête SQL
	 */
	public function affiche_valeur_champ($atts) {
		extract(shortcode_atts( array(
			'table' => '',
			'id' => '',
			'champ' => ''
		), $atts));

		global $wpdb;
			$slocal_requete = "SELECT $champ FROM $table WHERE ID='$id'";
			$resultat = $wpdb->get_var($slocal_requete);
		
		echo $resultat;
	}

	/**
	 * @param [string] $atts table id champ
	 * @return int la valeur demandée de la requête SQL
	 */
	public function retourne_valeur_champ($atts) {
		extract(shortcode_atts( array(
			'table' => '',
			'id' => '',
			'champ' => ''
		), $atts));

		global $wpdb;
			$slocal_requete = "SELECT $champ FROM $table WHERE ID='$id'";
			$resultat = $wpdb->get_var($slocal_requete);
		
		return $resultat;
	}

	/**
	 * @param [string] $atts id
	 * @return string code HTML checkbox checkée ou non de annonce_verifiee pour update annonce
	 */
	public function afficher_checkbox_annonce_verifiee($atts) {
		$html = ''; //code HTML du checkbox de 'annonce_verifiee' checkée ou non

		extract(shortcode_atts( array('id' => ''), $atts ));

		global $wpdb;
			$requete = "SELECT annonce_verifiee FROM ild_annonce WHERE ID = '$id'";
			$annonce_verifiee = $wpdb->get_var($requete);
		
		if ($annonce_verifiee === '1') {
			$html .= '<input type="checkbox" name="annonce_verifiee" checked>';
		} else {
			$html .= '<input type="checkbox" name="annonce_verifiee">';
		}
		
		echo $html;
	}

	/********************** affichage des select retournant la liste des champs demandés dans la table demandée en paramètres********************* */

	/**
	 * @param [string] $atts nom de table
	 * @return void echo les valeurs demandées de la requête SQL en option HTML
	 */
	public function affiche_select($atts) {
		extract(shortcode_atts( array(
			'table' => '',
		), $atts));
		global $wpdb;
			$html =''; //liste des options d'un select contenant les ID et designation de la table demandée
			$slocal_requete = "SELECT ID, designation FROM $table";
			$tlocal_resultats = $wpdb->get_results($slocal_requete, ARRAY_A);

			foreach($tlocal_resultats as $res) {
				$html .= '<option value='. $res["ID"] .'>'. $res["designation"].'</option>';
			}
		echo $html;
	}

	/********************* affichage des atouts en checkbox pour le formulaire d'ajout d'annonce ****************************************** */
	
	/**
	 * @return void echo les lignes de la table ild_atout sous forme de checkbox HTML
	 */
	public function affiche_atout_checkbox() {
		$html =''; //liste des lignes de la table atout en checkbox
		global $wpdb;
		$slocal_requete = "SELECT ID,designation FROM ild_atout";
		$resultat = $wpdb->get_results($slocal_requete, ARRAY_A);
		
		foreach($resultat as $res) {
			$html .= '<input type="checkbox" name="'. $res["designation"] .'" value="'. $res["ID"] . '"><label for="'. $res["designation"] .'">'. $res["designation"] .'   </label>';
		}
		echo $html;
	}
	
	/********************* affichage des atouts en checkbox et récupère les atouts de l'annonce sélectionnée pour le formulaire update annonce ** */

	/**
	 * @param [string] $atts id
	 * @return void echo les lignes de la table ild_atout sous forme de checkbox HTML checkées ou non
	 */
	public function affiche_atout_checkbox_checked($atts) {
		$html = ''; //renvoie l'affichage des atouts checkés selon les atouts de l'annonce envoyée
		$tableau_id_atout_de_annonce = []; //comme les id récupérés seront en tableau associatif, on ne récupère que les valeurs pour pouvoir checker
		extract(shortcode_atts(array('id' => 1), $atts)); //récupère l'ID de l'annonce envoyé en paramètres

		global $wpdb;
		//récupère les atouts de l'annonce demandée dans le formulaire update annonce
		$slocal_requete = "SELECT 
								ato.ID AS atoid
							FROM 
								ild_annonce AS an 
								INNER JOIN ild_annonce_atout AS aa ON an.ID=aa.ID_ild_annonce 
								INNER JOIN ild_atout AS ato ON ato.ID=aa.ID_ild_atout 
							WHERE 
								an.ID='$id'";
		$resultat_atout_annonce = $wpdb->get_results($slocal_requete, ARRAY_A); //les atouts sont placés dans un tableau

		//on ne récupère que les valeurs de $resultat_atout_annonce
		for ($i=0; $i < count($resultat_atout_annonce); $i++) {
			array_push($tableau_id_atout_de_annonce, $resultat_atout_annonce[$i]['atoid']);
		}
		
		//récupère la liste des atouts de la table ild_atout
		$slocal_requete_liste_atouts = "SELECT * FROM ild_atout";
		$resultat_liste_atouts = $wpdb->get_results($slocal_requete_liste_atouts, ARRAY_A); //la liste des atouts est placée dans un  tableau
		
		//si un atout est présent dans la liste des atouts de l'annonce 
		//renvoi une checkbox checkée de l'atout sinon non chéckée
		foreach($resultat_liste_atouts as $atout) {
			if (in_array($atout['ID'], $tableau_id_atout_de_annonce)) {
				$html .= '<input type="checkbox" value="'.$atout["ID"].'" name="'.$atout["designation"].'" checked><label for="'.$atout["designation"].'">'.$atout["designation"].'</label>';
			} else {
				$html .= '<input type="checkbox" value="'.$atout["ID"].'" name="'.$atout["designation"].'"><label for="'.$atout["designation"].'">'.$atout["designation"].'</label>';	
			}
		}
		echo $html;
	}

	/********************* affichage des checkboxes de visibilté de champ pour le formulaire update annonce ************************************************ */

	/**
	 * @param [string] $atts ID et champ 
	 * @return void echo les champs telephone ou mail ou hors_frais_notaire sous forme de checkbox HTML
	 */
	public function affiche_visible_checkbox_checked($atts) {
		$html = ''; //renvoie la checkbox checkée ou non
		extract(shortcode_atts( array('id' => '', 'champ' => ''), $atts ));
		//récupération du booléen du champ demandé de l'annonce demandée
		global $wpdb;
			$slocal_requete = "SELECT $champ FROM ild_annonce WHERE ID='$id'";
			$booleen = $wpdb->get_var($slocal_requete);
		$html .= '<td scope="row"><input type="checkbox" name="'.$champ.'"';
			if ($booleen === "1") {
				$html .= 'checked';
			} 
		$html .='></td>';

		echo $html;
	}

	/********************* affichage des boutons radio des classes energie et ges des annonces pour le formulaire ajout*********************************** */

	/**
	 * @param [string] $atts champ
	 * @return void echo la liste des champs classe_energie ou GES sous forme de radio HTML
	 */
	public function affiche_radio($atts) {
		extract(shortcode_atts(array('energie' => ''), $atts));
		$html =''; //renvoie la liste des boutons radio
		$html .= '<input type="radio" name="'.$energie.'" value="A"><label>A  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="B"><label>B  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="C"><label>C  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="D"><label>D  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="E"><label>E  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="F"><label>F  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="G"><label>G  </label>';
		echo $html;
	}

	/********************* affichage des boutons radio des classes energie et GES des annonces checkées ou non  pour le formulaire update annonce */

	/**
	 * @param [string] $atts energie et id 
	 * @return void echo les listes des champs classe_energie et GES sous forme de radio HTML checkées ou non
	 */
	public function affiche_radio_checked($atts) {
		extract(shortcode_atts(array('energie' => '', 'id' => ''), $atts)); //extraction des attributs du shortcode

		//récupération de la valeur de la classe de l'annonce demandée
		global $wpdb;
			$slocal_requete = "SELECT $energie FROM ild_annonce WHERE ID='$id'";
			$valeur = $wpdb->get_var($slocal_requete);

		$html =''; //renvoie la liste des boutons radio
		$html .= '<input type="radio" name="'.$energie.'" value="A"';
			if ($valeur === "A") {
				$html .= 'checked';
			}
			$html .= '><label>A  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="B"';
			if ($valeur === "B") {
				$html .= 'checked';
			}
			$html .= '><label>B  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="C"';
			if ($valeur === "C") {
				$html .= 'checked';
			}
			$html .= '><label>C  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="D"';
			if ($valeur === "D") {
				$html .= 'checked';
			}
			$html .= '><label>D  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="E"';
			if ($valeur === "E") {
				$html .= 'checked';
			}
			$html .= '><label>E  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="F"';
			if ($valeur === "F") {
				$html .= 'checked';
			}
			$html .= '><label>F  </label>';
		$html .= '<input type="radio" name="'.$energie.'" value="G"';
			if ($valeur === "G") {
				$html .= 'checked';
			}
			$html .= '><label>G  </label>';
		echo $html;
	}

	/********************* affichage du nom de la ville pour le formulaire update des annonces ******************** */

	/**
	 * @param [string] $atts id
	 * @return void echo designation de la ville dont l'ID est envoyée en attribut
	 */
	public function affiche_designation_ville($atts) {
		extract(shortcode_atts( array('id' => ''), $atts ));

		global $wpdb;
			$slocal_requete = "SELECT v.designation FROM ild_ville AS v INNER JOIN ild_annonce AS a ON a.ID_ild_ville=v.ID WHERE a.ID='$id'";
			$designation = $wpdb->get_var($slocal_requete);
		echo $designation;
	}

	/********************* affichage du nom du département pour le formulaire de modification d'une ville ******** */

	/**
	 * @param [string] $atts id
	 * @return void echo de la designation du departement dont l4ID est envoyé en attribut
	 */
	public function affiche_designation_departement($atts) {
		extract(shortcode_atts( array('id' => 1), $atts));

		global $wpdb;
			$slocal_requete = "SELECT d.designation FROM ild_ville AS v INNER JOIN ild_departement AS d WHERE v.ID='$id' AND d.ID=v.ID_departement";
			$designation_departement = $wpdb->get_var($slocal_requete);

			echo $designation_departement;
	}

	
	/********************* affichage du nom de la région pour le formulaire de modification de département ******** */

	/**
	 * @param [string] $atts id
	 * @return void echo la designation de la région dont l'ID est envoyé en attribut
	 */
	public function afficher_designation_region($atts) {
		extract(shortcode_atts(array('id' => 1), $atts));
		$id = intval($id); //les ID sont des int dans les tables
		
		global $wpdb;
		$slocal_requete = "SELECT r.designation FROM ild_departement AS d INNER JOIN ild_region AS r WHERE d.ID=$id AND r.ID=d.ID_region";
		$designation_region = $wpdb-> get_var($slocal_requete);
		echo $designation_region; 
	}
	

	/********************* affichage de la désignation du type d'annonce de l'annonce demandée dans le formaulaire update annonce **** */

	/**
	 * @param [string] $atts id
	 * @return void echo la designation du type d'annonce dont l'ID de l'annonce est envoyé en attribut
	 */
	public function affiche_designation_type_annonce($atts) {
		extract(shortcode_atts(array('id' => 1), $atts));

		global $wpdb;
			$slocal_requete = "SELECT 
								t.designation 
							FROM ild_annonce AS a 
							INNER JOIN ild_type_annonce AS t ON t.ID=a.ID_ild_type_annonce
							WHERE a.ID='$id'";

			$designation = $wpdb->get_var($slocal_requete);
			echo $designation;
	}

	/********************* affiche la valeur de la session en cours de recherche pour la page villes *************************** */

	/**
	 * @param [string] $atts nom_session
	 * @return void echo la valeur de la session dont son nom est envoyé en attribut 
	 */
	public function afficher_session_search($atts) {
		extract(shortcode_atts(array('nom_session' => ''), $atts));
		echo $_SESSION[$nom_session];
	}

	/******************* affichage du nom de la région correspondant à l'ID contenu dans la session region *************************** */

	/**
	 * @return void echo la designation de la région dont l'ID est enregistré dans la $_SESSION['region']
	 */
	public function afficher_session_designation_region() {
		if (isset($_SESSION['region'])) {
			$ID = intval($_SESSION['region']); //les ID sont des int dans les tables
	
			global $wpdb;
				$slocal_requete = "SELECT designation FROM ild_region WHERE ID=$ID";
				$designation_region = $wpdb-> get_var($slocal_requete);
			echo $designation_region; 
		} 
	}

	/******************* affichage de la désignation du type d'annonce en recherche dans la page annonce ************************************ */

	/**
	 * @return string echo la désignation du type d'annonce en recherche
	 */
	public function afficher_designation_session_type_annonce() {
		if(isset($_SESSION['type_annonce'])) {
			global $wpdb; //connexion à la base de données du site
				$id_type = intval($_SESSION['type_annonce']);

				$requete = "SELECT designation FROM ild_type_annonce WHERE ID = $id_type";
				$type_designation = $wpdb->get_var($requete);

				echo $type_designation;
		}
	}


	/******************* affichage des photos de l'annonce à modifier dans la page update annonce ************************************* */

	/**
	 * @param [string] $atts id
	 * @return void echo les div, form et images HTML de l'annonce dont l'ID est envoyé en paramètres
	 */
	public function afficher_photos_annonce($atts) {
		extract(shortcode_atts(array('id' => ''), $atts)); //récupère l'ID de l'annonce envoyé en attribut id
		$html = ''; //affichage du code html des photos et leur formulaire
		$photos = []; //tableau contenant les photos de l'annonce
		$nombre_de_photos = 0; //nombre de photos de l'annonce
		$nombre_photos_par_ligne = 5; //nombre de photos par ligne
		$nombre_lignes = 0; //int donnant le nombre de lignes du tableau
		$compteur_numero_index_photo = 0; // compteur de numéro de ligne

		global $wpdb;
			$requete_photos = "SELECT 
									p.ID,p.designation,p.URL 
								FROM ild_annonce AS a
								INNER JOIN ild_annonce_url_photo AS ap ON a.ID = ap.ID_ild_annonce 
								INNER JOIN ild_url_photo AS p ON p.ID = ap.ID_ild_url_photo 
								WHERE a.ID = '$id'";
			$photos = $wpdb->get_results($requete_photos, ARRAY_A);

		$nombre_de_photos = count($photos);
		$nombre_lignes = ceil($nombre_de_photos/$nombre_photos_par_ligne);

		//placer chaque photo dans une case du tableau
		for ($i=0; $i < $nombre_lignes; $i++) {
			$html .= '<tr class="form-field">';
			for ($j=0; $j < $nombre_photos_par_ligne; $j++) {
				if ($compteur_numero_index_photo < $nombre_de_photos) {
					$html .= '<td scope="row" >
									<div class="div_photo_update_annonce">
										<img src="'.$photos[$compteur_numero_index_photo]["URL"].'" alt="photo de l\'annonce" class="photo">
									</div>
									<div class="input_photo">
										<form action="?page='.$_REQUEST['page'].'&action='.Affuteo_Admin::UPDATE_ANNONCE.'&ID='.$_REQUEST['ID'].'&traitement=update_photo" method="POST">
											<input type="hidden" value="'.$photos[$compteur_numero_index_photo]['ID'].'" name="id_photo">
											<input type="text" value="'.$photos[$compteur_numero_index_photo]["designation"].'" name="designation_photo" class="designation_input">
											<label for="designation_photo"><input type="submit" value="Modifier" class="button button-primary"></label>
										</form>
										<form action="?page='.$_REQUEST['page'].'&action='.Affuteo_Admin::UPDATE_ANNONCE.'&ID='.$_REQUEST['ID'].'&traitement=delete_photo" method="POST" class="margin_top">
											<input type="hidden" value="delete_photo">
											<input type="hidden" value="'.$photos[$compteur_numero_index_photo]['ID'].'" name="id_photo">
											<input type="submit" value="Supprimer la photo" class="button button-primary">
										</form>

									</div>
							  </td>';
					$compteur_numero_index_photo++;
				}
			}
			$html .= '</tr>';
		}

		echo $html;
	}

}

								/**********************************************
 								*   javascript validations des suppressions   * 
								***********************************************/
/**
 * @param [string] $ID
 * @param [string] $table
 * @return void echo en javascript un confirm pour la suppression d'un élément et retourne les paramètres envoyés ou non selon le choix de l'utilisateur
 */
function js_demande_validation($ID, $table) {
	echo '<script>
			let confirm = window.confirm("Voulez-vous valider cette suppression ?");
			if(confirm) {
				window.location.replace("?page='. $_REQUEST['page'] . '&action=delete_valid_'. $table .'&ID='.$ID.'");
			} else {
				window.location.replace("?page='.$_REQUEST['page'].'");
			}
		  </script>';
}


								/****************************************** 
							 	* les tables WP_list_table des sous-menus *
								*******************************************/

//la class wp_list_table n'existe pas dans ce fichier, on la récupère
if(!class_exists('WP_List_Table')) require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

						/**************** table des villes ************************************ */

/**
 * affichage et gestion du tableau d'affichage des ville
 * wp_list_table est une class wordpress
 */
class ild_ville_class extends WP_List_Table {

    /**
     * fonction affichage des colonnes et lignes
     * fonction wordpress de wp_class_table
     */
    public function prepare_items() {
		
        /********* affichage des colonnes ******************** */
        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
	
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
	
		$this->process_action(); // vérifie si une action est en cours
		
        /********** mise en tableau des données de la table ild_ville ****** */
		$tlocal_data = $this->retourne_liste_ville_en_tableau(); //récupère la liste des ville dans la bdd
		
        /********** gestion de la pagination ******** */
        //affichage gérer par la class wp_list_table
        $ilocal_perPage = 25; //nombre de données par page
        $ilocal_currentPage = $this->get_pagenum(); //retourne la page sur laquelle on se trouve
        $ilocal_totalItems = count($tlocal_data); //compte le nombre de données dans la table ild_formation
        $this->set_pagination_args(array( //fonction wordpress qui renvoie les données des pages
            'total_items' => $ilocal_totalItems,
            'per_page' => $ilocal_perPage
        ));
        $tlocal_data = array_slice($tlocal_data, (($ilocal_currentPage-1)*$ilocal_perPage), $ilocal_perPage); //affiche les données voulues
		$this->items = $tlocal_data; //affiche les données
	}
	
    /**
     * récupère la liste des ville de la table ild_ville
     * la retourne dans un tableau
     *
     * @return array
     */
    public function retourne_liste_ville_en_tableau() {
        $slocal_requete = ""; //requête SQL récupère toute la table ild_ville
        $tlocal_liste_ville = []; //résultat de la requête 
        global $wpdb; //connexion à la base de données
            $slocal_requete = "SELECT 
									v.ID as vID,
									v.ID_departement,
									v.designation as vdesignation,
									v.slug,
									v.codepostal,
									v.codeinsee,
									v.latitude,
									v.longitude,
									d.ID as dID,
									d.id_region,
									d.designation as ddesignation,
									d.code_departement,
									r.ID as rID,
									r.designation as rdesignation 
								FROM 
									ild_region AS r 
									INNER JOIN ild_departement AS d 
									INNER JOIN ild_ville AS v 
								WHERE 
									r.ID = d.ID_region 
									AND 
									d.ID = v.ID_departement";
			
			//si la recherche par département ou code postal est activée
			if ($_SESSION['departement_ou_codepostal'] !== "") {
				$slocal_requete .= " AND v.codepostal LIKE '" . $_SESSION['departement_ou_codepostal'] ."%'";
			}
			
			//pour le tri des colonnes par order via la fonction get_sortable_columns()
			if (!empty($_REQUEST['orderby'])) {
				$slocal_requete .= " ORDER BY " . esc_sql( $_REQUEST['orderby'] );
			}
			if (!empty($_REQUEST['order'])) {
				if ($_REQUEST['order'] === "asc") {
					$slocal_requete .= " ASC";
                } else {
					$slocal_requete .= " DESC";
                }
			}
			
			$tlocal_liste_ville = $wpdb->get_results($slocal_requete, ARRAY_A); //résultats de la requête sous forme de tableau
        return $tlocal_liste_ville;
    }
    /**
     * retourne les colonnes à afficher par défaut
     * fonction wordpress de wp_list_table
     *
     * @return array
     */
    public function get_columns() {
        $tlocal_colonnes_defaut = array( 
			'vID' => 'ID',
            'vdesignation' => 'Nom de ville',
			'codepostal' => 'Code postal',
			'ddesignation' => 'Son département',
			'rdesignation' => 'Sa région',
            'codeinsee' => 'Code INSEE',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude'
        );  
        return $tlocal_colonnes_defaut; 
    }
    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return void
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
			'vID' => array('vID', false),
            'vdesignation' => array('vdesignation', false),
			'codepostal' => array('codepostal', false),
			'ddesignation' => array('ddesignation', false),
			'rdesignation' => array('rdesignation', false),
            'codeinsee' => array('codeinsee', false),
            'latitude' => array('latitude', false),
            'longitude' => array('longitude', false)
        );
        return $tlocal_sortable_columns;
    }
    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [array] $item
     * @param [string] $column_name
     * @return void
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'vID': 
            case 'ID_departement' : 
            case 'vdesignation' : 
            case 'slug' : 
			case 'codepostal' : 
			case 'ddesignation' : 
			case 'rdesignation' :
            case 'codeinsee' : 
            case 'latitude' : 
            case 'longitude' : 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        }
	}
	
	/**
	 * ajout des liens modifier et supprimer sur la colonne 'nom de ville'
	 * fonction wordpress wp_list_table
	 */
	public function column_vID($item) {
		$actions = array(
			'update' => sprintf('<a href="?page=%s&action=%s&ID=%s">Modifier</a>', $_REQUEST['page'], Affuteo_Admin::UPDATE_VILLE,  $item['vID']),
			'delete' => sprintf('<a href="?page=%s&action=%s&ID=%s">Supprimer</a>', $_REQUEST['page'], Affuteo_Admin::DELETE_VILLE,  $item['vID']),
		);
		return sprintf('%1$s %2$s', $item['vID'], $this->row_actions($actions));
	}

	/**
	 * @return void vérifie les actions en cours, selon l'action effectue delete ou update ou create
	 */
	function process_action() {
		//lorsque le lien 'supprimer' est cliqué : appelle le javascript confirm
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_VILLE) {
			$ID = $_REQUEST['ID'];
			$table = 'ville';
			js_demande_validation($ID, $table);
		}
		//si le confirm javascript est confirmé
		if ($_REQUEST['action'] === Affuteo_Admin::VALIDATION_DELETE_VILLE) {
			$ID = $_REQUEST['ID'];
			global $wpdb;
				$wpdb->delete( 'ild_ville', array('ID' => $ID));
		}
		//si le bouton 'modifier' du formulaire de modififcation de ville est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_VALID_VILLE) { //click sur modifier
			$ID = intval($_POST['ID']);
			$ID_departement = intval($_POST['ID_departement']);
			$designation = $_POST['designation'];
			$slug = $_POST['slug'];
			$codepostal = $_POST['codepostal'];
			$codeinsee = $_POST['codeinsee'];
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];

			global $wpdb;
				$update = $wpdb->update(
					'ild_ville',
					array(
						'ID_departement' => $ID_departement,
						'designation' => $designation,
						'slug' => $slug,
						'codepostal' => $codepostal,
						'codeinsee' => $codeinsee,
						'latitude' => $latitude,
						'longitude' => $longitude
					),
					array(
						'ID' => $ID
					)
				);
				$update;
		}
		//si le bouton 'ajouter'du formulaire d'ajout de ville est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::AJOUT_VALID_VILLE) { //click sur ajouter
			//récupère les valeurs des champs du formulaire
			$ID_departement = intval($_POST['ID_departement']);
			$designation = $_POST['designation'];
			$slug = $_POST['slug'];
			$codepostal = $_POST['codepostal'];
			$codeinsee = $_POST['codeinsee'];
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];

			global $wpdb;
				$insert = $wpdb->insert(
					'ild_ville',
					array(
						'ID_departement' => $ID_departement,
						'designation' => $designation,
						'slug' => $slug,
						'codepostal' => $codepostal,
						'codeinsee' => $codeinsee,
						'latitude' => $latitude,
						'longitude' => $longitude
					)
				);
				$insert;
		}
		//si le bouton 'rechercher' de la page ville de l'input search est cliqué
		//utilise la globale session pour que la pagination garde en mémoire la recherche
		if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_VILLE) {
			if (isset($_POST[Affuteo_Admin::SEARCH_VILLE])) {
				$search = $_POST[Affuteo_Admin::SEARCH_VILLE];
				if ($search !== "2A" && $search !== "2a" && $search !== "2B" && $search !=="2b") {				
					$_SESSION['departement_ou_codepostal'] = $search;
				}
				if ($search === "2A" || $search === "2a" || $search === "2B" || $search ==="2b") {
					$_SESSION['departement_ou_codepostal'] = "20";
				}
			}
		}
		//si le bouton 'reset' de la recherche par département ou code postal est cliqué
		//$_SESSION['departement_ou_codepostal'] est vidé
		if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_VILLE) {
			$_SESSION['departement_ou_codepostal'] = "";
		}
	}
}

						/**************** table des departements ************************************ */

/**
 * affichage et gestion du tableau d'affichage des departement
 * wp_list_table est une class wordpress
 */
class ild_departement_class extends WP_List_Table {
    /**
     * fonction affichage des colonnes et lignes
     * fonction wordpress de wp_class_table
     */
    public function prepare_items() {
		
        /********* affichage des colonnes ******************** */
        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
	
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
	
		$this->process_action(); // vérifie si une action est en cours
		
        /********** mise en tableau des données de la table ild_region ****** */
		$tlocal_data = $this->retourne_liste_departement_en_tableau(); //récupère la liste des régions dans la bdd
		
		/********** gestion de la pagination ******** */
		
        //affichage gérer par la class wp_list_table
        $ilocal_perPage = 25; //nombre de données par page
        $ilocal_currentPage = $this->get_pagenum(); //retourne la page sur laquelle on se trouve
        $ilocal_totalItems = count($tlocal_data); //compte le nombre de données dans la table ild_formation
        $this->set_pagination_args(array( //fonction wordpress qui renvoie les données des pages
            'total_items' => $ilocal_totalItems,
            'per_page' => $ilocal_perPage
        ));
        $tlocal_data = array_slice($tlocal_data, (($ilocal_currentPage-1)*$ilocal_perPage), $ilocal_perPage); //affiche les données voulues
        $this->items = $tlocal_data; //affiche les données
    }
    /**
     * récupère la liste des departement de la table ild_departement
     * la retourne dans un tableau
     *
     * @return array
     */
    public function retourne_liste_departement_en_tableau() {
        $slocal_requete = ""; //requête SQL récupère toute la table ild_departement
        $tlocal_liste_departement = []; //résultat de la requête 
        global $wpdb; //connexion à la base de données
			$slocal_requete = "SELECT
								d.ID as dID,
								d.ID_region as ID_region,
								d.designation as ddesignation,
								d.code_departement as code_departement,
								r.ID as rID,
								r.designation as rdesignation 
							FROM 
								ild_region AS r 
								INNER JOIN ild_departement AS d 
							WHERE 
								d.ID_region = r.ID";

			//si la recherche des départements par région est activée
			if ($_SESSION['region'] !== "") {
				$region = $_SESSION['region'];
				$slocal_requete .= " AND d.ID_region=$region";
			}

			//pour le tri des colonnes par order via la fonction get_sortable_columns()
			if (!empty($_REQUEST['orderby'])) {
				$slocal_requete .= " ORDER BY " . esc_sql( $_REQUEST['orderby'] );
			}
            if (!empty($_REQUEST['order'])) {
				if ($_REQUEST['order'] === "asc") {
					$slocal_requete .= " ASC";
                } else {
					$slocal_requete .= " DESC";
                }
			}
			
			$tlocal_liste_departement = $wpdb->get_results($slocal_requete, ARRAY_A); //résultats de la requête sous forme de tableau

        return $tlocal_liste_departement;
    }
    /**
     * retourne les colonnes à afficher par défaut
     * fonction wordpress de wp_list_table
     *
     * @return array
     */
    public function get_columns() {
        $tlocal_colonnes_defaut = array( 
			'dID' => 'ID',
            'ddesignation' => 'Nom du département',
            'rdesignation' => 'Sa région',
        );  
        return $tlocal_colonnes_defaut; 
    }
    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return void
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
			'dID' => array('dID', false),
			'ddesignation' => array('ddesignation', false),
			'rdesignation' => array('rdesignation', false),
        );
        return $tlocal_sortable_columns;
    }
    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [type] $item
     * @param [type] $column_name
     * @return void
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'dID': 
			case 'ddesignation' : 
			case 'rdesignation' : 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        }
	}
	
	/**
	 * ajout des liens modifier et supprimer sur la colonne 'nom de ville'
	 * fonction wordpress wp_list_table
	 */
	public function column_dID($item) {
		$actions = array(
			'update' => sprintf('<a href="?page=%s&action=%s&ID=%s">Modifier</a>', $_REQUEST['page'], Affuteo_Admin::UPDATE_DEPARTEMENT,  $item['dID']),
			'delete' => sprintf('<a href="?page=%s&action=%s&ID=%s">Supprimer</a>', $_REQUEST['page'], Affuteo_Admin::DELETE_DEPARTEMENT,  $item['dID']),
		);
		return sprintf('%1$s %2$s', $item['dID'], $this->row_actions($actions));
	}

	/**
	 * vérifie les actions en cours
	 */
	function process_action() {
		//suppression actionne le javascript confirm
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_DEPARTEMENT) {
			$ID = $_REQUEST['ID'];
			$table = 'departement';
			js_demande_validation($ID, $table);
		}
		//si le javscript confirm est confirmé : action de suppression
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_VALID_DEPARTEMENT) {
			$ID = $_REQUEST['ID'];
			global $wpdb;
				$wpdb->delete( 'ild_departement', array('ID' => $ID));
		}
		//si le bouton 'modifier' du formulaire de modification est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_VALID_DEPARTEMENT) { //click sur modifier
			$ID = intval($_POST['ID']);
			$ID_region = intval($_POST['ID_region']);
			$designation = $_POST['designation'];

			global $wpdb;
				$update = $wpdb->update(
					'ild_departement',
					array(
						'ID_region' => $ID_region,
						'designation' => $designation,
					),
					array(
						'ID' => $ID
					)
				);
				$update;
		}
		//si le bouton 'ajouter' du formulaire d'ajout est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::AJOUT_VALID_DEPARTEMENT) { //click sur ajouter
			//récupère les valeurs des champs du formulaire
			$ID_region = intval($_POST['ID_region']);
			$designation = $_POST['designation'];

			global $wpdb;
				$insert = $wpdb->insert(
					'ild_departement',
					array(
						'ID_region' => $ID_region,
						'designation' => $designation,
					)
				);
				$insert;
		}
	}
}

						/**************** table des regions ************************************ */

/**
 * affichage et gestion du tableau d'affichage des region
 * wp_list_table est une class wordpress
 */
class ild_region_class extends WP_List_Table {
    /**
     * fonction affichage des colonnes et lignes
     * fonction wordpress de wp_class_table
     */
    public function prepare_items() {
		
        /********* affichage des colonnes ******************** */
        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
	
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
	
		$this->process_action(); // vérifie si une action est en cours
		
        /********** mise en tableau des données de la table ild_régions ****** */
		$tlocal_data = $this->retourne_liste_region_en_tableau(); //récupère la liste des régions dans la bdd
		
        $this->items = $tlocal_data; //affiche les données
    }
    /**
     * récupère la liste des region de la table ild_region
     * la retourne dans un tableau
     *
     * @return array
     */
    public function retourne_liste_region_en_tableau() {
        $slocal_requete = ""; //requête SQL récupère toute la table ild_region
        $tlocal_liste_region = []; //résultat de la requête 
        global $wpdb; //connexion à la base de données
			$slocal_requete = "SELECT * FROM ild_region";
			//pour le tri des colonnes par order via la fonction get_sortable_columns()
			if (!empty($_REQUEST['orderby'])) {
				$slocal_requete .= " ORDER BY " . esc_sql( $_REQUEST['orderby'] );
			}
			if (!empty($_REQUEST['order'])) {
				if ($_REQUEST['order'] === "asc") {
					$slocal_requete .= " ASC";
                } else {
					$slocal_requete .= " DESC";
                }
			}
            $tlocal_liste_region = $wpdb->get_results($slocal_requete, ARRAY_A); //résultats de la requête sous forme de tableau
        return $tlocal_liste_region;
    }
    /**
     * retourne les colonnes à afficher par défaut
     * fonction wordpress de wp_list_table
     *
     * @return array
     */
    public function get_columns() {
        $tlocal_colonnes_defaut = array( 
			'ID' => 'ID',
            'designation' => 'Nom de la région',
        );  
        return $tlocal_colonnes_defaut; 
    }
    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return array
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
			'ID' => array('ID', false),
            'designation' => array('designation', false),
        );
        return $tlocal_sortable_columns;
    }
    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [type] $item
     * @param [type] $column_name
     * @return string
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'ID': 
            case 'designation' : 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        }
	}
	
	/**
	 * ajout des liens modifier et supprimer sur la colonne 'nom de ville'
	 * fonction wordpress wp_list_table
	 */
	public function column_ID($item) {
		$actions = array(
			'update' => sprintf('<a href="?page=%s&action=%s&ID=%s">Modifier</a>', $_REQUEST['page'], Affuteo_Admin::UPDATE_REGION,  $item['ID']),
			'delete' => sprintf('<a href="?page=%s&action=%s&ID=%s">Supprimer</a>', $_REQUEST['page'], Affuteo_Admin::DELETE_REGION,  $item['ID']),
		);
		return sprintf('%1$s %2$s', $item['ID'], $this->row_actions($actions));
	}

	/**
	 * vérifie les actions en cours
	 */
	function process_action() {
		//si le lien 'supprimer' est cliqué : affiche le confirm javacript
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_REGION) {
			$ID = $_REQUEST['ID'];
			$table = 'region';
			js_demande_validation($ID, $table);
		}
		//si le confirm javascript est confirmé : suppression
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_VALID_REGION) {
			$ID = $_REQUEST['ID'];
			global $wpdb;
				$wpdb->delete( 'ild_region', array('ID' => $ID));
		}
		//si le bouton 'modifier' du formulaire de modification est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_VALID_REGION) { //click sur modifier
			$ID = intval($_POST['ID']);
			$designation = $_POST['designation'];

			global $wpdb;
				$update = $wpdb->update(
					'ild_region',
					array(
						'designation' => $designation,
					),
					array(
						'ID' => $ID
					)
				);
				$update;
		}
		//si le bouton 'ajouter' du formulaire d'ajout est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::AJOUT_VALID_REGION) { //click sur ajouter
			//récupère les valeurs des champs du formulaire
			$designation = $_POST['designation'];

			global $wpdb;
				$insert = $wpdb->insert(
					'ild_region',
					array(
						'designation' => $designation,
					)
				);
				$insert;
		}
	}
}


						/***************** table des annonces ********************************** */

/**
 * affichage et gestion du tableau d'affichage des annonces
 * wp_list_table est une class wordpress
 */
class ild_annonce_class extends WP_List_Table {
    /**
     * fonction affichage des colonnes et lignes
     * fonction wordpress de wp_class_table
     */
    public function prepare_items() {
		
        /********* affichage des colonnes ******************** */
        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
	
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
	
		$this->process_action(); // vérifie si une action est en cours
        /********** mise en tableau des données de la table ild_régions ****** */
		$tlocal_data = $this->retourne_liste_annonces_en_tableau(); //récupère la liste des régions dans la bdd

		/********** gestion de la pagination ******** */
		
        //affichage gérer par la class wp_list_table
        $ilocal_perPage = 25; //nombre de données par page
        $ilocal_currentPage = $this->get_pagenum(); //retourne la page sur laquelle on se trouve
        $ilocal_totalItems = count($tlocal_data); //compte le nombre de données dans la table ild_formation
        $this->set_pagination_args(array( //fonction wordpress qui renvoie les données des pages
            'total_items' => $ilocal_totalItems,
            'per_page' => $ilocal_perPage
        ));
        $tlocal_data = array_slice($tlocal_data, (($ilocal_currentPage-1)*$ilocal_perPage), $ilocal_perPage); //affiche les données voulues
		
        $this->items = $tlocal_data; //affiche les données
    }
    /**
     * récupère la liste des annonces de la table ild_annonce
     * la retourne dans un tableau
     *
     * @return array
     */
    public function retourne_liste_annonces_en_tableau() {
        $slocal_requete = ""; //requête SQL récupère toute la table ild_annonce
        $tlocal_liste_annonces = []; //résultat de la requête 
        global $wpdb; //connexion à la base de données
			$slocal_requete = "SELECT 
				an.ID as anID,
				an.ID_client AS idclient,
				display_name,
				v.designation as vdesignation,
				t.designation AS td,
				an.designation as andesignation,
				an.designation_longue,
				an.budget,
				an.nombre_pieces,
				an.nombre_chambres,
				an.superficie_terrain,
				an.superficie_habitable,
				an.adresse_1,
				an.adresse_2,
				an.adresse_3,
				an.classe_energie,
				an.GES,
				an.telephone,
				an.telephone_visible,
				an.mail,
				an.mail_visible,
				an.hors_frais_notaire,
				an.annonce_externe_importee,
				an.date_creation,
				an.date_modification
			 FROM 
			 	ild_annonce AS an 
				INNER JOIN ild_type_annonce AS t ON an.ID_ild_type_annonce=t.ID  
				INNER JOIN ild_ville As v ON v.ID=an.ID_ild_ville
				INNER JOIN wp_ild_af_users AS u ON an.ID_client = u.ID 
				INNER JOIN wp_ild_af_usermeta AS um ON u.ID = um.user_id 
			WHERE meta_key = 'wp_ild_af_capabilities'";

			//si la recherche par rôle est activée
			if ($_SESSION['role'] !== "") {
				$slocal_requete .= " AND meta_value LIKE '%". $_SESSION['role'] ."%'";
			}

			//si la recherche par nom de client est activée
			if ($_SESSION['nom_client'] !== "") {
				$slocal_requete .= " AND user_nicename LIKE '%". $_SESSION['nom_client'] ."%'";
			}

			//si la recherche par adresses mail de client est activée
			if ($_SESSION['mail_client'] !== "") {
				$slocal_requete .= " AND user_email LIKE '". $_SESSION['mail_client'] ."%'";
			}

			//si la recherche par adresses mail de client est activée
			if ($_SESSION['annonce_a_verifier'] !== "") {
				$slocal_requete .= " AND annonce_verifiee = '0'";
			}

			//si la recherche par département ou code postal est activée
			if ($_SESSION['departement_ou_codepostal'] !== "") {
				$slocal_requete .= " AND v.codepostal LIKE '" . $_SESSION['departement_ou_codepostal'] ."%'";
			}

			//si la recherche per type d'anonce est activée
			if ($_SESSION['type_annonce'] !== "") {
				$slocal_requete .= " AND t.ID = " . $_SESSION['type_annonce'];
			}
				
			//pour le tri des colonnes par order via la fonction get_sortable_columns()
			if (!empty($_REQUEST['orderby'])) {
				$slocal_requete .= " ORDER BY " . esc_sql( $_REQUEST['orderby'] );
			}
			if (!empty($_REQUEST['order'])) {
				if ($_REQUEST['order'] === "asc") {
					$slocal_requete .= " ASC";
                } else {
					$slocal_requete .= " DESC";
                }
			}
			$tlocal_liste_annonces = $wpdb->get_results($slocal_requete, ARRAY_A); //résultats de la requête sous forme de tableau
        return $tlocal_liste_annonces;
    }
    /**
     * retourne les colonnes à afficher par défaut
     * fonction wordpress de wp_list_table
     *
     * @return array
     */
    public function get_columns() {
        $tlocal_colonnes_defaut = array( 
			'vdesignation' => 'Ville',
			'td' => 'Type annonce',
			'budget' => 'Budget',
			'display_name' => 'Client'
        );  
        return $tlocal_colonnes_defaut; 
    }
    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return array
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
			'vdesignation' => array('vdesignation', false),
			'td' => array('td', false),
			'budget' => array('budget', false),
			'display_name' => array('display_name', false)
        );
        return $tlocal_sortable_columns;
    }
    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [type] string
     * @param [type] string
     * @return array ou action print_r
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
			case 'vdesignation' : 
			case 'td' : 
			case 'budget' :
			case 'display_name' : 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        }
	}
	
	/**
	 * ajout des liens modifier et supprimer sur la colonne 'nom de ville'
	 * fonction wordpress wp_list_table
	 * @param [type] string
	 * @return liens 
	 */
	public function column_vdesignation($item) {
		$actions = array(
			'update' => sprintf('<a href="?page=%s&action=%s&ID=%s">Modifier</a>', $_REQUEST['page'], Affuteo_Admin::UPDATE_ANNONCE,  $item['anID']),
			'delete' => sprintf('<a href="?page=%s&action=%s&ID=%s">Supprimer</a>', $_REQUEST['page'], Affuteo_Admin::DELETE_ANNONCE,  $item['anID']),
		);
		return sprintf('%1$s %2$s', $item['vdesignation'], $this->row_actions($actions));
	}

	public function column_display_name($item) {
		$user = new WP_User( $item['idclient'] );
		$user_role = array_shift($user->roles);
		$user_role = translate_user_role(ucfirst($user_role));
		return sprintf('<p>%s</p><p>rôle : %s</p>', $item['display_name'], $user_role);
	}

	/**
	 * vérifie les actions en cours
	 * selon l'action enoyée dans l'url delete ou update ou create annonce
	 */
	function process_action() {
		//si le lien 'supprimer' est cliqué : affiche le confirm javacript
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_ANNONCE) {
			$ID = $_REQUEST['ID'];
			$table = 'annonce';
			js_demande_validation($ID, $table);
		}
		//si le confirm javascript est confirmé : suppression
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_VALID_ANNONCE) {
			$tableau_url_photos = []; //tableau contenant les url des photos de l'annonce à supprimer
			$tableau_id_photos = []; //tableau contenant les ID des photos à supprimer
			$tableau_id_relation_atout_de_annonce = []; //tableau contenant les ID des relations atouts de l'annonce
			$id = $_REQUEST['ID']; //ID de l'annonce à supprimer

			//on doit d'abord supprimer les éléments de l'annonce contenus dans les tables relationnelles avec atout et url_photo
			//à cause des clés de restriction
			//et récupérer les noms des photos afin de les supprimer du dossier photo
			global $wpdb; //connexion à la base de données du site

				$derror = true; //booléen pour les transactions
				$wpdb->query('START TRANSACTION');

				//pour la table relationnelle ild_annonce_url_photo
					//récupération des noms des photos
					$tableau_url_photos = $this->recuperer_url_des_photos($id);
					
					//récupération des ID des photos
					$tableau_id_photos = $this->recuperer_id_des_photos($id);
					
					//suppression des éléments de la table relationnelle de l'annonce
					if(!empty($tableau_url_photos)) {
						$delete_relation_photo_annonce = $wpdb->delete('ild_annonce_url_photo', array('ID_ild_annonce' => $id));
						if (!$delete_relation_photo_annonce) {
							$derror = false;
						}
					//suppression des photos de la table ild_url_photo
						foreach($tableau_id_photos as $id_photo) {
							$delete_photo_table = $wpdb->query("DELETE FROM ild_url_photo WHERE ID = '$id_photo'");
							if (!$delete_photo_table) {
								$derror = false;
							} 
						}
					}

					//pour la table relationnelle ild_annonce_atout
					//récupération des ID des relations annonce atouts 
					$tableau_id_relation_atout_de_annonce = $this->recuperer_id_table_relation_atout_annonce($id);
					//suppression des relations atouts annonce
					if (!empty($tableau_id_relation_atout_de_annonce)) {
						foreach($tableau_id_relation_atout_de_annonce as $id_relation) {
							$delete_relation = $wpdb->query("DELETE FROM ild_annonce_atout WHERE ID = $id_relation");
							if (!$delete_relation) {
								$derror = false;
							} 
						}
					}

					//suppression de l'annonce
					$delete_annonce = $wpdb->query("DELETE FROM ild_annonce WHERE ID = '$id'");
					if (!$delete_annonce) {
						$derror = false;
					} 

					if($derror) {
						$wpdb->query('COMMIT');
						//suppression des photos
						if(!empty($tableau_id_photos)) {
							foreach($tableau_url_photos as $url) {
								unlink($url);
							} 
						}
					} else {
						$wpdb->query('ROLLBACK');
					}



		}
		//si le bouton 'Ajouter' est cliqué dans le formulaire ajouter des annonces
		if ($_REQUEST['action'] === Affuteo_Admin::AJOUT_VALID_ANNONCE) {

			global $wpdb;

			$derror = true; //booleen pour la transaction
			$wpdb->query('START TRANSACTION');

			//génère un ID unique pour la table ild_annonce
			$id_annonce  = $this->generer_id_unique_en_uuid('ild_annonce');

			//récupère les ID des photos lors de l'enregistrement des photos
			$id_photo = [];

			//pour les annonces
			$requete_annonce = $this->gerer_insert_annonce($id_annonce);
			$action_requete_annonce = $wpdb->query($requete_annonce);
			if (!$action_requete_annonce) {
				$derror = false;
			} 
			
			//pour les photos 
			$id_photo = []; //tableau contenant les ID créées des photos envoyées
			if ($action_requete_annonce) {
				if (isset($_FILES['photo'])) { //si une ou plusieurs photos ont été envoyées

					$photos = $_FILES['photo'];
					$compteur = count($photos['name']); //compte le nombre de photos envoyées
					for($i=0; $i < $compteur; $i++) {
						$id_photo_uuid = $this->generer_id_unique_en_uuid('ild_url_photo'); //génère un ID unique pour chaque photo
						array_push($id_photo, $id_photo_uuid);//pousse chaque ID dans le tableau contenant les ID des photos
					}
					//ajoute les photos dans la table ild_url_photo
					$requete_photo = $this->ajouter_photo_dans_url_photo($photos, $id_photo);
					foreach($requete_photo as $req) {
						$action_requete_chaque_photo = $wpdb->query($req);
						if (!$action_requete_chaque_photo) {
							$derror = false;
						} 
					}
				}
				//pour la table de relation ild_annonce_url_photo
				if (count($id_photo) > 0) { //s'il y a au moins une photo envoyée
					$requete_annonce_photo = $this->ajouter_annonce_photo_table_relation($id_annonce, $id_photo);
					foreach($requete_annonce_photo as $req) {
						$action_requete_chaque_relation_annonce_photo = $wpdb->query($req);
						if (!$action_requete_chaque_relation_annonce_photo) {
							$derror = false;
						} 
					}
				}
				//pour les atouts
				//enregistre ID_annonce et ID_atout dans la table de relation ID_ild_annonce_atout
				$requete_atout = $this->gerer_atouts_de_annonce_enregistree($id_annonce);
				foreach($requete_atout as $atout) {
					$action_requete_atout = $wpdb->query($atout);
					if (!$action_requete_atout) {
						$derror = false;
					} 
				}
			}
			if ($derror) {
				$wpdb->query('COMMIT');
			} else {
				$wpdb->query('ROLLBACK');
			}
			
		}
		//si le bouton 'Modifier' est cliqué dans le formulaire de modification des annonces
		if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_VALID_ANNONCE) {
			$id_annonce = $_POST['id']; //récupère l'ID de l'annonce a modifier
			global $wpdb; //connexion à la base de données du site

			$derror = true; //booléen pour la transactions
			$wpdb->query('START TRANSACTION'); //début de la transaction au cas où quelque chose ne marche pas : annule l'update

			//modifier les champs de l'annonce à modifier
			$requete_annonce = $this->update_annonce($id_annonce);
			$action_requete_annonce = $wpdb->query($requete_annonce);
			//si la modification de l'annonce s'est bien déroulée
			if (!$action_requete_annonce) {
				$derror = false;
			} 
			//vérifier les atouts de l'annonce pour la table relationnelle annonce atout
			$requete_atout = $this->update_delete_atout($id_annonce);
			
			for ($i=0; $i < count($requete_atout); $i++) {
				$action_requete_atout = $wpdb->query($requete_atout[$i]);
				if(!$action_requete_atout) {
					$derror = false;
				} 
			}
			//vérification de la transaction
			if ($derror) {
				$wpdb->query('COMMIT');
			} else {
				$wpdb->query('ROLLBACK');
			}
			

		}
		//si le bouton 'rechercher' de la page ville de l'input search est cliqué
		//utilise la globale session pour que la pagination garde en mémoire la recherche
		if ($_REQUEST['action'] === Affuteo_Admin::SEARCH_VILLE) {
			if (isset($_POST[Affuteo_Admin::SEARCH_VILLE])) {
				$search = $_POST[Affuteo_Admin::SEARCH_VILLE];
				if ($search !== "2A" && $search !== "2a" && $search !== "2B" && $search !=="2b") {				
					$_SESSION['departement_ou_codepostal'] = $search;
				}
				if ($search === "2A" || $search === "2a" || $search === "2B" || $search ==="2b") {
					$_SESSION['departement_ou_codepostal'] = "20";
				}
			}
		}
		//si le bouton 'reset' de la recherche par département ou code postal est cliqué
		//$_SESSION['departement_ou_codepostal'] est vidé
		if ($_REQUEST['action'] === Affuteo_Admin::RESET_SEARCH_VILLE) {
			$_SESSION['departement_ou_codepostal'] = "";
		}
	}
	
	/**
	 * @param [string] $id_annonce
	 * @return array liste des url des photos de l'annonce
	 */
	function recuperer_url_des_photos($id_annonce) {
		$tableau_url_photos = [];

		global $wpdb; //connexion à la base de données du site
			$requete = "SELECT URL FROM 
							ild_annonce_url_photo AS ap 
							INNER JOIN ild_url_photo AS p ON p.ID = ap.ID_ild_url_photo 
						WHERE ap.ID_ild_annonce = '$id_annonce'";
			$resultat = $wpdb->get_results($requete, ARRAY_A);
		//on ne récupère que les valeurs car on reçoit un tableau associatif
		foreach($resultat as $url) {
			array_push($tableau_url_photos, $url['URL']);
		}
		return $tableau_url_photos;
	}

	/**
	 * @param [string] $id_annonce
	 * @return array liste des id des photos de l'annonce
	 */
	function recuperer_id_des_photos($id_annonce) {
		$tableau_id_photos = [];

		global $wpdb; //connexion à la base de données du site
			$requete = "SELECT p.ID as pid FROM 
							ild_annonce_url_photo AS ap 
							INNER JOIN ild_url_photo AS p ON p.ID = ap.ID_ild_url_photo 
						WHERE ap.ID_ild_annonce = '$id_annonce'";
			$resultat = $wpdb->get_results($requete, ARRAY_A);
		//on ne récupère que les valeurs car on reçoit un tableau associatif
		foreach($resultat as $url) {
			array_push($tableau_id_photos, $url['pid']);
		}
		return $tableau_id_photos;
	}

	/**
	 * @param [string] $id_annonce
	 * @return array contenant les ID des relations des atouts et de l'annonce
	 */
	function recuperer_id_table_relation_atout_annonce($id_annonce) {
		$tableau_id_relation = [];

		global $wpdb; //connexion à la base de données du site
			$requete = "SELECT r.ID AS rid FROM ild_annonce_atout AS r 
						INNER JOIN ild_annonce AS a ON a.ID = r.ID_ild_annonce 
						WHERE a.ID = '$id_annonce'";
			$resultat = $wpdb->get_results($requete, ARRAY_A);
		//on ne récupère que les valeurs car on reçoit un tableau associatif
		foreach($resultat as $id) {
			array_push($tableau_id_relation, $id['rid']);
		}
		return $tableau_id_relation;
	}

	/**
	 * @param [string] $table
	 * @return string ID via la fonction uniqid() de PHP 
	 */
	function generer_id_unique_en_uuid($table) {
		$id_unique= uniqid('', true); //ID unique en varchar(23)

		//récupère les ID de la table dans un tableau
		global $wpdb;
			$slocal_requete = "SELECT ID FROM $table";
			$liste_id = $wpdb->get_results($slocal_requete, ARRAY_A);
		
		while (in_array($id_unique, $liste_id)) { //[0] pour réupérer les ID
			$id_unique = uniqid('', true);
		}	
		return $id_unique;
	}

	/**
	 * @param [$_FILES] $photos
	 * @param [string] $id_photo
	 * @return string la requête insert de la table ild_url_photo
	 */
	function ajouter_photo_dans_url_photo($photos, $id_photo) {
		$requete_photos = []; //tableau contenant les requêtes pour les photos et leur ID

		//récupérer le nombre de photos
		//photos renvoyées sous forme de tableau associatif : 
			//rangés par nom, tmp_name,... non par photo
		$compteur = count($photos['name']);
		for($i=0; $i < $compteur; $i++) {

			$id = $id_photo[$i];

			$name_photo = $photos['name'][$i];
			
			//permet de donner un nom aléatoire afin d'éviter des fichiers de même nom
			$date = new Datetime();//récupère la date du moment
			$date_to_string =  strval((rand(1,99))*($date->getTimestamp())); //multiplie la timestamp par un nombre aléatoire compris entre 1 et 99
			
			//envoi de la photo dans le dossier photos, à la racine du site
			$tmp_name = $photos['tmp_name'][$i];
			$nom = $date_to_string . $photos['name'][$i];
			move_uploaded_file($tmp_name, "../photos/$nom");

			$url_photo = "../photos/".$nom; //récupère l'adresse de la photo
			
			$requete = "INSERT INTO ild_url_photo (ID, designation, URL) VALUES ( '$id' , '$name_photo', '$url_photo')";
			//mettre les varaiables entre simples quotes pour échapper les caractères spéciaux

			array_push($requete_photos, $requete); 
		}
		return $requete_photos;
	}

	/**
	 * récupère les désignations des atouts de la table ild_atout
	 * enregistre les atouts envoyés par le formulaire ajout d'annonce et l'ID de l'annonce dans 
	 * la table de relation ild_annonce_atout
	 *
	 * @param [string] $id_annonce
	 * @return string requête insert pour la table de relation annonce atout
	 */
	function gerer_atouts_de_annonce_enregistree($id_annonce) {
		$requete_atout = []; //partie de requête pour les atouts

		//récupérer les noms des atouts de la table ild_atout sous forme de tableau
		global $wpdb;
			$slocal_requete = "SELECT ID,designation FROM ild_atout";
			$atouts = $wpdb->get_results($slocal_requete, ARRAY_A);
			
		foreach($atouts as $atout) {
			if (isset($_POST[strval($atout['designation'])])) {
				$id_atout = intval($atout['ID']);
				array_push($requete_atout, "INSERT INTO ild_annonce_atout (ID_ild_annonce, ID_ild_atout) VALUES ('$id_annonce', $id_atout)");
				//simples quotes pour $id_annonce car il est de type varchar, $id_atout est en int
			}
		}
		return $requete_atout;
	}

	/**
	 * pour la table ild_annonce
	 *
	 * @param [string] $id_annonce
	 * @return string requête insert d'une annonce
	 */
	function gerer_insert_annonce($id_annonce) {
		//pour la requête d'insertion de l'annonce
		$requete_annonce = "";

		//déclarer tous les éléments envoyés du formulaire pour la table ild_annonce
		$type = intval($_POST['type']);
		$client_id = intval($_POST['client_id']);
		$ville = intval($_POST['adresse_3']);
		$superficie_habitable = null;
		$superficie_terrain = null;
		$nombre_pieces = null;
		$designation = null;
		$nombre_chambres = null;
		$budget = null;
		$designation_longue = null;
		$adresse_1 = null;
		$adresse_2 = null;
		$adresse_3 = null;
		$classe_energie = null;
		$ges = null;
		$telephone = null;
		$telephone_visible = 1;
		$mail = null;
		$mail_visible = 1;
		$hors_frais_notaire = 0;
		$annonce_externe_importee = 0;
		$date_creation = $this->retourner_date_actuelle();
		$date_modification = $this->retourner_date_actuelle();
		$annonce_verifiee = 0;
		
		//récupère tous les éléments envoyés du formulaire pour la table ild_annonce
		if (isset($_POST['superficie_habitable'])) {
			$superficie_habitable = intval($_POST['superficie_habitable']);
		}
		if (isset($_POST['superficie_terrain'])) {
			$superficie_terrain = intval($_POST['superficie_terrain']);
		}
		if (isset($_POST['nombre_pieces'])) {
			$nombre_pieces = intval($_POST['nombre_pieces']);
		}
		if (isset($_POST['designation'])) {
			$designation = $_POST['designation'];
		}
		if (isset($_POST['nombre_chambres'])) {
			$nombre_chambres = intval($_POST['nombre_chambres']);
		}
		if (isset($_POST['budget'])) {
			$budget = intval($_POST['budget']);
		}
		if (isset($_POST['designation_longue'])) {
			$designation_longue = $_POST['designation_longue'];
		}
		if (isset($_POST['adresse_1'])) {
			$adresse_1 = $_POST['adresse_1'];
		}
		if (isset($_POST['adresse_2'])) {
			$adresse_2 = $_POST['adresse_2'];
		}
		if (isset($_POST['adresse_3'])) {
			$adresse_3 = $_POST['adresse_3'];
		}
		if (isset($_POST['classe_energie'])) {
			$classe_energie = $_POST['classe_energie'];
		}
		if (isset($_POST['GES'])) {
			$ges = $_POST['GES'];
		}
		if (isset($_POST['telephone'])) {
			$telephone = $_POST['telephone'];
		}
		if (!isset($_POST['telephone_visible'])) {
			$telephone_visible = 0;
		}
		if (isset($_POST['mail'])) {
			$mail = $_POST['mail'];
		}
		if (!isset($_POST['mail_visible'])) {
			$mail_visible = 0;
		}
		if(isset($_POST['hors_frais_notaire'])) {
			$hors_frais_notaire = 1;
		}
		if (isset($_POST['annonce_verifiee'])) {
			$annonce_verifiee = 1;
		}

		$requete_annonce .= "INSERT INTO ild_annonce 
								(ID,ID_client, ID_ild_ville, ID_ild_type_annonce, superficie_habitable, superficie_terrain, nombre_pieces, designation, nombre_chambres, budget, 
								designation_longue, adresse_1, adresse_2, adresse_3, classe_energie, ges, telephone, telephone_visible, 
								mail, mail_visible, hors_frais_notaire, annonce_externe_importee, date_creation, date_modification, annonce_verifiee) 
							VALUES 
								('$id_annonce',$client_id, $ville, $type, $superficie_habitable, $superficie_terrain, $nombre_pieces, '$designation', $nombre_chambres, 
								$budget, '$designation_longue', '$adresse_1', '$adresse_2', '$adresse_3', '$classe_energie', '$ges', '$telephone', $telephone_visible,
								'$mail', $mail_visible, $hors_frais_notaire, $annonce_externe_importee, $date_creation, $date_modification, $annonce_verifiee) ;"; 
							//les champs de type varchar ou text sont entre simples quotes pour échapper les carctères spéciaux
		return $requete_annonce;
	}

	/**
	 * @param [string] $id_annonce
	 * @param [string] $id_photo
	 * @return string requête insert pour la table de relation annonce photo
	 */
	function ajouter_annonce_photo_table_relation($id_annonce, $id_photo) {
		$requete_annonce_photo = [];

		foreach($id_photo as $id) {
			$requete = "INSERT INTO ild_annonce_url_photo (ID_ild_annonce, ID_ild_url_photo) VALUES ('$id_annonce', '$id')";
			array_push($requete_annonce_photo, $requete);
		} 
		return $requete_annonce_photo;
	}

	/**
	 * retourne date actuelle au format AAAA-MM-JJ
	 *
	 * @return date
	 */
	function retourner_date_actuelle() {
		$date = new DateTime;
		$date = $date->format('Y-m-d');
		return $date;
	}

	/**
	 * @param [string] $id_annonce
	 * @return array contenant les requêtes delete et update de la table relationnelle annonce atout
	 */
	function update_delete_atout($id_annonce) {
		$requete_atout = []; //tableau contenant les requetes update ou delete pour la table relationnelle annonce atout
		$id_des_atouts_de_annonce_avant_update = []; //tableau contenant les atouts de l'annonce avant l'update
		$id_des_atouts_de_annonce_apres_update = []; //tableau contenant les atouts de l'annonce après l'update
		$liste_atouts = []; //tableau contenant la liste des atouts

		global $wpdb; //connexion à la base de données du site
			$requete_id_des_atouts_de_annonce_avant_update = "SELECT ID_ild_atout FROM ild_annonce_atout WHERE ID_ild_annonce = '$id_annonce'";
			$resultat_id_atouts = $wpdb->get_results($requete_id_des_atouts_de_annonce_avant_update, ARRAY_A);
			//comme c'est un tableau associatif, on ne récupère que les valeurs
			foreach($resultat_id_atouts as $id_atout) {
				array_push($id_des_atouts_de_annonce_avant_update, $id_atout['ID_ild_atout']);
			}

			$requete_liste_atouts = "SELECT ID, designation FROM ild_atout ";
			$liste_atouts = $wpdb->get_results($requete_liste_atouts, ARRAY_A);

			foreach($liste_atouts as $atout) {
				if(isset($_POST[$atout['designation']])) {
					array_push($id_des_atouts_de_annonce_apres_update, $atout['ID']);
				}
			}

			//si après l'update un atout de la liste d'atouts envoyés n'est pas présent dans la liste des atouts de l'annonce avant l'update
			//on rajoute cet atout
			for ($i=0; $i < count($id_des_atouts_de_annonce_apres_update); $i++) {
				if (!in_array($id_des_atouts_de_annonce_apres_update[$i], $id_des_atouts_de_annonce_avant_update)) {
					$id_atout_a_ajouter = intval($id_des_atouts_de_annonce_apres_update[$i]);
					if ($id_atout_a_ajouter !== 0) { //car s'il n'y en a pas $id_atout_a_ajouter=0; 
						$requete_add = "INSERT INTO ild_annonce_atout (ID_ild_annonce, ID_ild_atout) VALUES ('$id_annonce', $id_atout_a_ajouter)";
						array_push($requete_atout, $requete_add);
					}
				}
			}

			//si après l'update un atout de la liste d'atouts de l'annonce avant update n'est pas présent dans la liste des atouts envoyés
			//on le supprime
			for ($j=0; $j < count($id_des_atouts_de_annonce_avant_update); $j++) {
				if (!in_array($id_des_atouts_de_annonce_avant_update[$j], $id_des_atouts_de_annonce_apres_update)) {
					$id_atout_a_supprimer = intval($id_des_atouts_de_annonce_avant_update[$j]);
					if ($id_atout_a_supprimer !== 0) { //car s'il n'y en a pas $id_atout_a_ajouter=0;
						$requete_delete = "DELETE FROM ild_annonce_atout WHERE ID_ild_annonce = '$id_annonce' AND ID_ild_atout = $id_atout_a_supprimer";
						array_push($requete_atout, $requete_delete);
					}
				}
			}
			
			return $requete_atout;
	}

	/**
	 * @param [string] $id_annonce 
	 * @return string requête update pour la table ild_annonce
	 */
	function update_annonce($id_annonce) {
		$requete_annonce = ""; //requête update pour la table ild_annonce

		//déclarer tous les éléments envoyés du formulaire pour la table ild_annonce
		$type = intval($_POST['type']); //non nullable
		$client_id = intval($_POST['client_id']);
		$ville = intval($_POST['adresse_3']); //non nullable
		$superficie_habitable = null;
		if (isset($_POST['superficie_habitable'])) {
			$superficie_habitable = intval($_POST['superficie_habitable']);
		}
		$superficie_terrain = null;
		if (isset($_POST['superficie_terrain'])) {
			$superficie_terrain = intval($_POST['superficie_terrain']);
		}
		$nombre_pieces = null;
		if (isset($_POST['nombre_pieces'])) {
			$nombre_pieces = intval($_POST['nombre_pieces']);
		}
		$designation = null;
		if (isset($_POST['designation'])) {
			$designation = $_POST['designation'];
		}
		$nombre_chambres = null;
		if (isset($_POST['nombre_chambres'])) {
			$nombre_chambres = intval($_POST['nombre_chambres']);
		}
		$budget = null;
		if (isset($_POST['budget'])) {
			$budget = intval($_POST['budget']);
		}
		$designation_longue = null;
		if (isset($_POST['designation_longue'])) {
			$designation_longue = $_POST['designation_longue'];
		}
		$adresse_1 = null;
		if (isset($_POST['adresse_1'])) {
			$adresse_1 = $_POST['adresse_1'];
		}
		$adresse_2 = null;
		if (isset($_POST['adresse_2'])) {
			$adresse_2 = $_POST['adresse_2'];
		}
		$adresse_3 = null;
		if (isset($_POST['adresse_3'])) {
			$adresse_3 = $_POST['adresse_3'];
		}
		$classe_energie = null;
		if (isset($_POST['classe_energie'])) {
			$classe_energie = $_POST['classe_energie'];
		}
		$ges = null;
		if (isset($_POST['GES'])) {
			$ges = $_POST['GES'];
		}
		$telephone = null;
		if (isset($_POST['telephone'])) {
			$telephone = $_POST['telephone'];
		}
		$telephone_visible = 1;
		if (!isset($_POST['telephone_visible'])) {
			$telephone_visible = 0;
		}
		$mail = null;
		if (isset($_POST['mail'])) {
			$mail = $_POST['mail'];
		}
		$mail_visible = 1;
		if (!isset($_POST['mail_visible'])) {
			$mail_visible = 0;
		}
		$hors_frais_notaire = 0;
		if (isset($_POST['hors_frais_notaire'])) {
			$hors_frais_notaire = 1;
		}
		$annonce_externe_importee = 0;
		if (isset($_POST['annonce_externe_importee'])) {
			$annonce_externe_importee = 1;
		}
		$date_modification = $this->retourner_date_actuelle();
		$annonce_verifiee = 0;
		if(isset($_POST['annonce_verifiee'])) {
			$annonce_verifiee = 1;
		}

		$requete_annonce = "UPDATE ild_annonce SET 
						ID_ild_ville = $ville,ID_client = $client_id, ID_ild_type_annonce = $type, superficie_habitable = $superficie_habitable, 
						superficie_terrain = $superficie_terrain, nombre_pieces = $nombre_pieces, designation = '$designation', 
						nombre_chambres = $nombre_chambres, budget = $budget, designation_longue = '$designation_longue', adresse_1 = '$adresse_1', 
						adresse_2 = '$adresse_2', adresse_3 = '$adresse_3', classe_energie = '$classe_energie', GES = '$ges', telephone = '$telephone', 
						telephone_visible = $telephone_visible, mail = '$mail', mail_visible = $mail_visible, hors_frais_notaire = $hors_frais_notaire, 
						annonce_externe_importee = $annonce_externe_importee, date_modification = $date_modification, annonce_verifiee = $annonce_verifiee 
						WHERE ID = '$id_annonce'";
		return $requete_annonce;
	}
}


							/***************** table des atouts ************************************ */

/**
 * affichage et gestion du tableau d'affichage des atouts
 * wp_list_table est une class wordpress
 */
class ild_atout_class extends WP_List_Table {
    /**
     * fonction affichage des colonnes et lignes
     * fonction wordpress de wp_class_table
     */
    public function prepare_items() {
		
        /********* affichage des colonnes ******************** */
        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
	
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
	
		$this->process_action(); // vérifie si une action est en cours
		
        /********** mise en tableau des données de la table ild_régions ****** */
		$tlocal_data = $this->retourne_liste_atouts_en_tableau(); //récupère la liste des régions dans la bdd
		
        $this->items = $tlocal_data; //affiche les données
    }
    /**
     * récupère la liste des atouts de la table ild_atouts
     * la retourne dans un tableau
     *
     * @return array
     */
    public function retourne_liste_atouts_en_tableau() {
        $slocal_requete = ""; //requête SQL récupère toute la table ild_atout
        $tlocal_liste_atouts = []; //résultat de la requête 
        global $wpdb; //connexion à la base de données
			$slocal_requete = "SELECT * FROM ild_atout";
			//pour le tri des colonnes par order via la fonction get_sortable_columns()
			if (!empty($_REQUEST['orderby'])) {
				$slocal_requete .= " ORDER BY " . esc_sql( $_REQUEST['orderby'] );
			}
			if (!empty($_REQUEST['order'])) {
				if ($_REQUEST['order'] === "asc") {
					$slocal_requete .= " ASC";
                } else {
					$slocal_requete .= " DESC";
                }
			}
            $tlocal_liste_region = $wpdb->get_results($slocal_requete, ARRAY_A); //résultats de la requête sous forme de tableau
        return $tlocal_liste_region;
    }
    /**
     * retourne les colonnes à afficher par défaut
     * fonction wordpress de wp_list_table
     *
     * @return array
     */
    public function get_columns() {
        $tlocal_colonnes_defaut = array( 
			'ID' => 'ID',
            'designation' => 'Nom de l\'atout',
        );  
        return $tlocal_colonnes_defaut; 
    }
    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return void
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
			'ID' => array('ID', false),
            'designation' => array('designation', false),
        );
        return $tlocal_sortable_columns;
    }
    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [type] $item
     * @param [type] $column_name
     * @return void
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'ID': 
            case 'designation' : 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        }
	}
	
	/**
	 * ajout des liens modifier et supprimer sur la colonne 'nom de ville'
	 * fonction wordpress wp_list_table
	 */
	public function column_ID($item) {
		$actions = array(
			'update' => sprintf('<a href="?page=%s&action=%s&ID=%s">Modifier</a>', $_REQUEST['page'], Affuteo_Admin::UPDATE_ATOUT,  $item['ID']),
			'delete' => sprintf('<a href="?page=%s&action=%s&ID=%s">Supprimer</a>', $_REQUEST['page'], Affuteo_Admin::DELETE_ATOUT,  $item['ID']),
		);
		return sprintf('%1$s %2$s', $item['ID'], $this->row_actions($actions));
	}

	/**
	 * vérifie les actions en cours
	 */
	function process_action() {
		//si le lien 'supprimer' est cliqué : affiche le confirm javacript
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_ATOUT) {
			$id = $_REQUEST['ID'];
			$table = 'atout';
			js_demande_validation($id, $table);
		}
		//si le confirm javascript est confirmé : suppression
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_VALID_ATOUT) {
			$id = $_REQUEST['ID'];
			global $wpdb;
				$wpdb->delete( 'ild_atout', array('ID' => $id));
		}
		//si le bouton 'modifier' du formulaire de modification est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_VALID_ATOUT) { //click sur modifier
			$id = intval($_POST['ID']);
			$designation = $_POST['designation'];

			global $wpdb;
				$update = $wpdb->update(
					'ild_atout',
					array(
						'designation' => $designation,
					),
					array(
						'ID' => $id
					)
				);
				$update;
		}
		//si le bouton 'ajouter' du formulaire d'ajout est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::AJOUT_VALID_ATOUT) {
			$designation = $_POST['designation'];

			global $wpdb;
				$insert = $wpdb->insert(
					'ild_atout',
					array( 
						'designation' => $designation
					)
				);
				$insert;
		}
	}
}

							/***************** table des types d'annonces ************************** */

/**
 * affichage et gestion du tableau d'affichage des types d'annonce
 * wp_list_table est une class wordpress
 */
class ild_type_class extends WP_List_Table {
    /**
     * fonction affichage des colonnes et lignes
     * fonction wordpress de wp_class_table
     */
    public function prepare_items() {
		
        /********* affichage des colonnes ******************** */
        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
	
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
	
		$this->process_action(); // vérifie si une action est en cours
		
        /********** mise en tableau des données de la table ild_régions ****** */
		$tlocal_data = $this->retourne_liste_types_en_tableau(); //récupère la liste des régions dans la bdd
		
        $this->items = $tlocal_data; //affiche les données
    }
    /**
     * récupère la liste des atouts de la table ild_atouts
     * la retourne dans un tableau
     *
     * @return array
     */
    public function retourne_liste_types_en_tableau() {
        $slocal_requete = ""; //requête SQL récupère toute la table ild_type_annonce
        $tlocal_liste_types = []; //résultat de la requête 
        global $wpdb; //connexion à la base de données
			$slocal_requete = "SELECT * FROM ild_type_annonce";
			//pour le tri des colonnes par order via la fonction get_sortable_columns()
			if (!empty($_REQUEST['orderby'])) {
				$slocal_requete .= " ORDER BY " . esc_sql( $_REQUEST['orderby'] );
			}
			if (!empty($_REQUEST['order'])) {
				if ($_REQUEST['order'] === "asc") {
					$slocal_requete .= " ASC";
                } else {
					$slocal_requete .= " DESC";
                }
			}
            $tlocal_liste_region = $wpdb->get_results($slocal_requete, ARRAY_A); //résultats de la requête sous forme de tableau
        return $tlocal_liste_region;
    }
    /**
     * retourne les colonnes à afficher par défaut
     * fonction wordpress de wp_list_table
     *
     * @return array
     */
    public function get_columns() {
        $tlocal_colonnes_defaut = array( 
			'ID' => 'ID',
            'designation' => 'Type d\'annonce',
        );  
        return $tlocal_colonnes_defaut; 
    }
    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return void
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
			'ID' => array('ID', false),
            'designation' => array('designation', false),
        );
        return $tlocal_sortable_columns;
    }
    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [type] $item
     * @param [type] $column_name
     * @return void
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'ID': 
            case 'designation' : 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        }
	}
	
	/**
	 * ajout des liens modifier et supprimer sur la colonne 'nom de ville'
	 * fonction wordpress wp_list_table
	 */
	public function column_ID($item) {
		$actions = array(
			'update' => sprintf('<a href="?page=%s&action=%s&ID=%s">Modifier</a>', $_REQUEST['page'], Affuteo_Admin::UPDATE_TYPE,  $item['ID']),
			'delete' => sprintf('<a href="?page=%s&action=%s&ID=%s">Supprimer</a>', $_REQUEST['page'], Affuteo_Admin::DELETE_TYPE,  $item['ID']),
		);
		return sprintf('%1$s %2$s', $item['ID'], $this->row_actions($actions));
	}

	/**
	 * vérifie les actions en cours
	 */
	function process_action() {
		//si le lien 'supprimer' est cliqué : affiche le confirm javacript
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_TYPE) {
			$ID = $_REQUEST['ID'];
			$table = 'type';
			js_demande_validation($ID, $table);
		}
		//si le confirm javascript est confirmé : suppression
		if ($_REQUEST['action'] === Affuteo_Admin::DELETE_VALID_TYPE) {
			$ID = $_REQUEST['ID'];
			global $wpdb;
				$wpdb->delete( 'ild_type_annonce', array('ID' => $ID));
		}
		//si le bouton 'modifier' du formulaire de modification est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_VALID_TYPE) { //click sur modifier
			$ID = intval($_POST['ID']);
			$designation = $_POST['designation'];

			global $wpdb;
				$update = $wpdb->update(
					'ild_type_annonce',
					array(
						'designation' => $designation,
					),
					array(
						'ID' => $ID
					)
				);
				$update;
		}
		//si le bouton 'ajouter' du formulaire d'ajout est cliqué
		if ($_REQUEST['action'] === Affuteo_Admin::AJOUT_VALID_TYPE) {
			$designation = $_POST['designation'];

			global $wpdb;
				$insert = $wpdb->insert(
					'ild_type_annonce',
					array( 
						'designation' => $designation
					)
				);
				$insert;
		}
	}
}

							/***************** page des photos *************** */

/**
 * affichage et gestion du tableau d'affichage des photos
 * wp_list_table est une class wordpress
 */
class ild_photo_class extends WP_List_Table {
    /**
     * fonction affichage des colonnes et lignes
     * fonction wordpress de wp_class_table
     */
    public function prepare_items() {
		
        /********* affichage des colonnes ******************** */
        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
	
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
	
		$this->process_action(); // vérifie si une action est en cours
		
        /********** mise en tableau des données de la table ild_régions ****** */
		$tlocal_data = $this->retourne_liste_photos_en_tableau(); //récupère la liste des régions dans la bdd

		/********** gestion de la pagination ******** */
		
        //affichage gérer par la class wp_list_table
        $ilocal_perPage = 25; //nombre de données par page
        $ilocal_currentPage = $this->get_pagenum(); //retourne la page sur laquelle on se trouve
        $ilocal_totalItems = count($tlocal_data); //compte le nombre de données dans la table ild_formation
        $this->set_pagination_args(array( //fonction wordpress qui renvoie les données des pages
            'total_items' => $ilocal_totalItems,
            'per_page' => $ilocal_perPage
        ));
        $tlocal_data = array_slice($tlocal_data, (($ilocal_currentPage-1)*$ilocal_perPage), $ilocal_perPage); //affiche les données voulues
		
        $this->items = $tlocal_data; //affiche les données
    }
    /**
     * récupère la liste des atouts de la table ild_atouts
     * la retourne dans un tableau
     *
     * @return array
     */
    public function retourne_liste_photos_en_tableau() {
        $slocal_requete = ""; //requête SQL récupère toute la table ild_type_annonce
        $tlocal_liste_photos = []; //résultat de la requête 
        global $wpdb; //connexion à la base de données
			$slocal_requete = "SELECT 
									an.ID AS aid, 
									URL AS url,
									p.designation as pdesignation  
								FROM ild_annonce AS an
								INNER JOIN ild_annonce_url_photo AS anp ON an.ID = anp.ID_ild_annonce 
								INNER JOIN ild_url_photo AS p ON p.ID = anp.ID_ild_url_photo ";
			//pour le tri des colonnes par order via la fonction get_sortable_columns()
			if (!empty($_REQUEST['orderby'])) {
				$slocal_requete .= " ORDER BY " . esc_sql( $_REQUEST['orderby'] );
			}
			if (!empty($_REQUEST['order'])) {
				if ($_REQUEST['order'] === "asc") {
					$slocal_requete .= " ASC";
                } else {
					$slocal_requete .= " DESC";
                }
			}
            $tlocal_liste_photos = $wpdb->get_results($slocal_requete, ARRAY_A); //résultats de la requête sous forme de tableau
        return $tlocal_liste_photos;
    }
    /**
     * retourne les colonnes à afficher par défaut
     * fonction wordpress de wp_list_table
     *
     * @return array
     */
    public function get_columns() {
        $tlocal_colonnes_defaut = array( 
			'url' => 'Liste des photos',
			'pdesignation' => 'Designation',
			'aid' => 'ID de l\'annonce'
        );  
        return $tlocal_colonnes_defaut; 
    }
    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return void
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
			'url' => array('url', false),
			'pdesignation' => array('pdesignation', false),
			'aid' => array('aid', false)
        );
        return $tlocal_sortable_columns;
    }
    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [type] $item
     * @param [type] $column_name
     * @return void
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'url': 
            case 'pdesignation' : 
            case 'aid' : 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        }
	}
	
	/**
	 * ajout des liens modifier et supprimer sur la colonne 'nom de ville'
	 * fonction wordpress wp_list_table
	 */
	public function column_url($item) {
		$actions = array(
			'voir l\'annonce' => sprintf('<a href="?page=annonces&action='.Affuteo_Admin::UPDATE_ANNONCE.'&ID='.$item['aid'].'" target="_blank">
			Voir l\'annonce
			</a>')
		);
		return sprintf('%1$s %2$s',
						'<div class="div_photo_list_photos">
							<img src="'.$item['url'].'" alt="image d\'annonce" class="photo">
						</div>' ,
						  $this->row_actions($actions));
	}

	/**
	 * vérifie les actions en cours
	 */
	function process_action() {
		
	}
}

							/**************** page des clients ****************** */

/**
 * affichage et gestion du tableau d'affichage des photos
 * wp_list_table est une class wordpress
 */
class ild_client_class extends WP_List_Table {
    /**
     * fonction affichage des colonnes et lignes
     * fonction wordpress de wp_class_table
     */
    public function prepare_items() {
		
        /********* affichage des colonnes ******************** */
        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
	
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
	
		$this->process_action(); // vérifie si une action est en cours
		
        /********** mise en tableau des données de la table ild_régions ****** */
		$tlocal_data = $this->retourne_liste_clients_en_tableau(); //récupère la liste des régions dans la bdd

		/********** gestion de la pagination ******** */
		
        //affichage gérer par la class wp_list_table
        $ilocal_perPage = 25; //nombre de données par page
        $ilocal_currentPage = $this->get_pagenum(); //retourne la page sur laquelle on se trouve
        $ilocal_totalItems = count($tlocal_data); //compte le nombre de données dans la table ild_formation
        $this->set_pagination_args(array( //fonction wordpress qui renvoie les données des pages
            'total_items' => $ilocal_totalItems,
            'per_page' => $ilocal_perPage
        ));
        $tlocal_data = array_slice($tlocal_data, (($ilocal_currentPage-1)*$ilocal_perPage), $ilocal_perPage); //affiche les données voulues
		
        $this->items = $tlocal_data; //affiche les données
    }
    /**
     * récupère la liste des atouts de la table ild_atouts
     * la retourne dans un tableau
     *
     * @return array
     */
    public function retourne_liste_clients_en_tableau() {
        $slocal_requete = ""; //requête SQL récupère toute la table ild_type_annonce
        $tlocal_liste_clients = []; //résultat de la requête 
        global $wpdb; //connexion à la base de données
			$slocal_requete = "SELECT * FROM wp_ild_af_users";

			//si le filtre par le nom de client est activé
			if ($_SESSION['nom_client'] !== "") {
				$slocal_requete .= " WHERE user_nicename LIKE '%". $_SESSION['nom_client'] ."%'";
			}
			//si le filtre par le nom de client est activé
			if ($_SESSION['mail_client'] !== "") {
				$slocal_requete .= " WHERE user_email LIKE '". $_SESSION['mail_client'] ."%'";
			}
								
			//pour le tri des colonnes par order via la fonction get_sortable_columns()
			if (!empty($_REQUEST['orderby'])) {
				$slocal_requete .= " ORDER BY " . esc_sql( $_REQUEST['orderby'] );
			}
			if (!empty($_REQUEST['order'])) {
				if ($_REQUEST['order'] === "asc") {
					$slocal_requete .= " ASC";
                } else {
					$slocal_requete .= " DESC";
                }
			}
			$tlocal_liste_clients = $wpdb->get_results($slocal_requete, ARRAY_A); //résultats de la requête sous forme de tableau
			
        return $tlocal_liste_clients;
    }
    /**
     * retourne les colonnes à afficher par défaut
     * fonction wordpress de wp_list_table
     *
     * @return array
     */
    public function get_columns() {
        $tlocal_colonnes_defaut = array( 
			'user_login' => 'Utilisateur',
			'user_email' => 'Mail',
			'display_name' => 'Prénom Nom',
			'ID' => ''
        );  
        return $tlocal_colonnes_defaut; 
    }
    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return void
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
			'user_login' => array('user_login', false),
			'user_email' => array('user_email', false),
			'display_name' => array('display_name', false),
			'ID' => array('ID', false)
        );
        return $tlocal_sortable_columns;
    }
    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [type] $item
     * @param [type] $column_name
     * @return void
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'user_login': 
            case 'user_email' : 
            case 'display_name' : 
            case 'ID' : 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        }
	}
	
	/**
	 * ajout des liens modifier et supprimer sur la colonne 'nom de ville'
	 * fonction wordpress wp_list_table
	 */
	public function column_ID($item) {
		//on récupère les éléments envoyés par le form en méthod POST
		//soit de la page add annonce soit update annonce
		$page = $_POST['page'];
    	$depart = $_POST['depart']; 
    	$id_annonce = "";
    	if (isset($_POST['id_annonce'])) {
    	    $id_annonce = $_POST['id_annonce']; 
    	}

		return sprintf('%1$s',
						'<form action="?page='.$page.'&action='.$depart.'&ID='.$id_annonce.'" method="POST">
							<input type="submit" value="Sélectionner" class="button">
							<input type="hidden" name="client_id" value="'.$item["ID"].'">
						</form>' ,
						  );
	}

	/**
	 * vérifie les actions en cours
	 */
	function process_action() {
		
	}
}