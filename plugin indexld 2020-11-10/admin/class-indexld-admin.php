<?php
session_start();
if (!isset($_SESSION['ild_formation_filtre'])) {
	$_SESSION['ild_formation_filtre'] = "";
}
if (!isset($_SESSION['ild_formation_checkboxes'])) {
	$_SESSION['ild_formation_checkboxes'] = "";
}
//les sessions se déclarent ici sinon affichage d'erreur
/*************************** conserver les filtres en mémoire ****************************************** */

/**
 * si le formulaire de gestion des filtres a été activé
 * ajout des valeurs des post du formulaire filtre dans la session ild_formation_filtre
 */
if (isset($_POST['filtre'])) {
    $_SESSION['ild_formation_filtre'] = []; //vide le tableau ou le transforme en tableau vide
    if ($_POST['categorie_id'] != "null") {
        $_SESSION['ild_formation_filtre'] += ['categorie_id' => $_POST['categorie_id']];
    }
    if ($_POST['convention'] != "null") {
        $_SESSION['ild_formation_filtre'] += ['convention' =>  $_POST['convention']];
    }
    if ($_POST['client'] != "null") {
        $_SESSION['ild_formation_filtre'] += ['client' => $_POST['client']];
    }
    if ($_POST['annee_min'] != "null") {
        $_SESSION['ild_formation_filtre'] += ['annee_min' => $_POST['annee_min']];
    }
    if ($_POST['annee_max'] != "null") {
        $_SESSION['ild_formation_filtre'] += ['annee_max' => $_POST['annee_max']];
    }
}

/************************** conserver les checkboxes en mémoire ********************************************************************* */

/**
 * si le formulaire de gestion des checkboxes a été activé
 * ajout des valeurs des post du formulaire checkboxes dans la session ild_formation_checkboxes
 */
if (isset($_POST['checkboxes'])) {
    $_SESSION['ild_formation_checkboxes'] = []; //vide le tableau ou le transforme en tableau vide
    if (isset($_POST['remarque'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'remarque');
    }
    if (isset($_POST['nombre_stagiaires'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'nombre_stagiaires');
    }
    if (isset($_POST['note_contenu_formation'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'note_contenu_formation');
    }
    if (isset($_POST['note_formateur_comprehensible'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'note_formateur_comprehensible');
    }
    if (isset($_POST['note_formateur_questions'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'note_formateur_questions');
    }
    if (isset($_POST['note_formateur_adaptation'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'note_formateur_adaptation');
    }
    if (isset($_POST['note_lieu_adapte'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'note_lieu_adapte');
    }
    if (isset($_POST['note_materiel'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'note_materiel');
    }
    if (isset($_POST['remarque_et_suggestion'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'remarque_et_suggestion');
    }
    if (isset($_POST['nombre_abandon'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'nombre_abandon');
    }
    if (isset($_POST['cause_abandon'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'cause_abandon');
    }
    if (isset($_POST['nombre_interruption'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'nombre_interruption');
    }
    if (isset($_POST['date_de_mise_a_jour'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'date_de_mise_a_jour');
    }
    if (isset($_POST['date_de_creation'])) {
        array_push($_SESSION['ild_formation_checkboxes'], 'date_de_creation');
    }
}

/************************* vide les filtres et les checkboxes ************************************************************************ */
/**
 * pour les filtres
 * lors du clique sur le bouton reset des filtres
 * vide la globale $_SESSION['ild_formation_filtre]
 */
if (isset($_POST['reset_filtre'])) {
    $_SESSION['ild_formation_filtre'] = [];
}
/**
 * pour les checkboxes
 * lors du clique sur le bouton reset des checkboxes
 * vide la globale $_SESSION['ild_formation_checkboxes]
 */
if (isset($_POST['reset_checkboxes'])) {
    $_SESSION['ild_formation_checkboxes'] = [];
}

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.indexld.com
 * @since      1.0.0
 *
 * @package    Indexld
 * @subpackage Indexld/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Indexld
 * @subpackage Indexld/admin
 * @author     indexld <index@indexld.com>
 */
class Indexld_Admin {

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
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/indexld-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/indexld-admin.js', array( 'jquery' ), $this->version, false );

	}

				/*************************************
				 * affichage des menus et sous-menus *
				 ************************************/

	/**
	 * affiche le plugin dans la barre de wp-admin
	 * 
	 * @since    1.0.0
	 */
	public function affiche_plugin_dashboard() {
		add_menu_page( 'ILD formation', 'ILD formation', 'manage_options', 'ild_formation', array($this, 'retourne_dans_page_ild_formation'),'dashicons-media-document',56 );
			/**
			 * paramètres de add_menu_page()
			 *   Le texte à afficher dans les balises de titre de la page lorsque le menu est sélectionné.
			 *   Le texte à utiliser pour le menu.
			 *   La capacité requise pour que ce menu soit affiché à l'utilisateur.
			 *   Le nom du slug à faire référence à ce menu
			 *   Fonction à appeler pour afficher le contenu de cette page
			 *   url de l'icône à afficher (sur https://developer.wordpress.org/resource/)
			 *   position dans la page
			 */
		add_submenu_page( 'ild_formation', 'categorie', 'categorie', 'manage_options', 'ild_formation/categorie', array($this, 'retourne_categorie'),1 );
			/**
			 * paramètres de sub_menu_page()
			 *   slug du parent
			 *   Le texte à afficher dans les balises de titre de la page lorsque le menu est sélectionné
			 *   Le texte à utiliser pour le menu.
			 *   La capacité requise pour que ce menu soit affiché à l'utilisateur.
			 *   Le nom du slug à faire référence à ce menu
			 *   La fonction à appeler pour générer le contenu de cette page.
			 *   sa position
			 */
		add_submenu_page( 'ild_formation', 'formation', 'formation', 'manage_options', 'ild_formation/formation', array($this, 'retourne_formation'),2 );
	}

	//fonction appelée dans le add_menu_page (dans le array)
	public function retourne_dans_page_ild_formation() {
		//retourne la vue dans la page ild_formation
		require_once 'partials/indexld-admin-display.php'; //les vues HTML sont gérées dans le dossier partials
	}

	//fonction de retour d'affichage sous menu categorie
	public function retourne_categorie() {
		//reourne la vue du sous-menu
		require_once 'partials/indexld-categorie-display.php';
	}

	//fonction de retour d'affichage sous menu formation
	public function retourne_formation() {
		//reourne la vue du sous-menu
		require_once 'partials/indexld-formation-display.php';
	}

								/*************
								 * shortcodes*
								 ************/
	/**
	 * liste les shortcodes
	 *
	 * @return void
	 */
	public function affiche_la_liste_des_shortcodes() {
		add_shortcode('afficher_la_table_formation', array($this, 'afficher_la_table_formation')); 
		add_shortcode('afficher_la_table_categorie', array($this, 'afficher_la_table_categorie'));

		add_shortcode('afficher_nom_categorie', array($this, 'afficher_nom_categorie'));

		add_shortcode('afficher_la_premiere_option_update_formation_select_categorie', array($this, 'afficher_la_premiere_option_update_formation_select_categorie'));
		add_shortcode('afficher_option_select_liste_categories', array($this, 'afficher_option_select_liste_categories'));
		add_shortcode('afficher_les_valeurs_input_update_formation', array($this, 'afficher_les_valeurs_input_update_formation'));
		add_shortcode('afficher_la_premiere_option_update_formation_convention', array($this, 'afficher_la_premiere_option_update_formation_convention'));
		
		add_shortcode('afficher_les_checkboxes_filtres', array($this, 'afficher_les_checkboxes_filtres')); 
		add_shortcode('afficher_les_options_filtre_par_categorie', array($this, 'afficher_les_options_filtre_par_categorie')); 
		add_shortcode('afficher_la_premiere_option_filtre_par_convention', array($this, 'afficher_la_premiere_option_filtre_par_convention')); 
		add_shortcode('afficher_les_options_filtre_client', array($this, 'afficher_les_options_filtre_client')); 
		add_shortcode('afficher_les_options_filtre_annee_min', array($this, 'afficher_les_options_filtre_annee_min')); 
		add_shortcode('afficher_les_options_filtre_annee_max', array($this, 'afficher_les_options_filtre_annee_max')); 

	}

	/**
	 * affiche la table formation
	 * 
	 * @return void
	 */
	public function afficher_la_table_formation() {
		$clocal_formation_list_table = null; //class d'un nouvel wp_list_table
    	//créé un nouvel wp_list_table
    	$clocal_formation_list_table = new ild_formationTableClass();
    	//appelle les items préparés
		$clocal_formation_list_table->prepare_items();
		$clocal_formation_list_table->display(); //affiche la table   
	}

	/**
	 * affiche la table categories
	 *
	 * @return void
	 */
	public function afficher_la_table_categorie() {
		$clocal_categorie_list_table = null; //class d'un nouvel wp_list_table
    	//créé un nouvel wp_list_table
    	$clocal_categorie_list_table = new ild_CategorieTableClass();
    	//appelle les items préparés
    	$clocal_categorie_list_table->prepare_items();
		$clocal_categorie_list_table->display(); 
	}

	public function afficher_nom_categorie($atts) {
		$nom_categorie = ''; //nom de la categorie

		extract(shortcode_atts( array('id' => ''), $atts ));

		global $wpdb; //connexion à la base se données
            $slocal_requete = "SELECT nom FROM ild_categorie WHERE id='$id'";
            $nom_categorie = $wpdb->get_var($slocal_requete);

		echo $nom_categorie;
	}

	/**
	 * @param [string] $id
	 * @return string code HTML option de select categories dans update formation
	 */
	public function afficher_la_premiere_option_update_formation_select_categorie($atts) {
		$html = ''; //code HTML de la premiere option du select update formation categorie
		echo 'ok';
		extract(shortcode_atts( array('id' => ''), $atts ));
		$id = intval($id);

		global $wpdb; //connexion à la base de données
			$requete = "SELECT c.id AS cid,c.nom AS cnom FROM ild_categorie AS c INNER JOIN ild_formation AS f ON f.categorie_id = c.id WHERE f.id = $id";
			$categorie = $wpdb->get_results($requete, ARRAY_A);
		
		$html .= '<option value="'.$categorie[0]['cid'].'">'.$categorie[0]['cnom'].'</option>';
		
		echo $html;
	}

	/**
	 * @return string code HTML option de select categories dans update formation
	 */
	public function afficher_option_select_liste_categories() {
		$html = ''; //code HTML des options du select update categorie

		global $wpdb;
			$slocal_requete_categories = "SELECT * FROM ild_categorie"; //pour afficher la liste des catégories dans le select
			$olocal_categories = $wpdb->get_results($slocal_requete_categories); //récupération de la liste dans un objet

		foreach($olocal_categories as $cat) {
			$html .= '<option value=' . $cat->id; $html .= '>'. $cat->nom ; $html .= '</option>';
		}
		
		echo $html;
	}

	/**
	 * @param [string] $atts id champ
	 * @return string valeurs des champs envoyés en attribut
	 */
	public function afficher_les_valeurs_input_update_formation($atts) {
		$valeur = ''; //valeur du champ envoyé en attribut
		
		extract(shortcode_atts( array('champ' => '', 'id' => ''), $atts ));
		$id = intval($id);
		
		global $wpdb; //connexion à la base de données
            $slocal_requete_formation_a_modidier = "SELECT * FROM ild_formation WHERE id='$id'"; //pour récupérer les valeurs de la formation à modifier
            $tlocal_formation = $wpdb->get_results($slocal_requete_formation_a_modidier, ARRAY_A); //récupération de la ligne dans un tableau

		$valeur = $tlocal_formation[0][$champ];
		
		echo $valeur;
	}

	/**
	 * @param [string] $atts id
	 * @return string code HTML option du select convention dans update formation
	 */
	public function afficher_la_premiere_option_update_formation_convention($atts) {
		$html = ''; //code HTML de la première option du select du form update formation

		extract(shortcode_atts( array('id' => ''), $atts));
		
		global $wpdb;
			$requete = "SELECT convention FROM ild_formation WHERE id = '$id'";
			$convention = $wpdb->get_var($requete);
		
		if ($convention === '1') {
			$html = '<option value='.$convention.'>conventionné</option>';
		} else {
			$html = '<option value='.$convention.'>non conventionné</option>';
		}

		echo $html;
	}

	/**
	 * @param [string] $atts name
	 * @return string code HTML checkbox pour les filtres des colonnes à afficher de la class formation, le nom du checkbox envoyé en attribut
	 */
	public function afficher_les_checkboxes_filtres($atts) {
		$html = ''; //code HTML du checkbox à envoyé
		extract(shortcode_atts(array('name' => ''), $atts));

		if (is_array($_SESSION['ild_formation_checkboxes'])) {
			if (in_array($name, $_SESSION['ild_formation_checkboxes'])) {
				$html .= '<input type="checkbox" name="'.$name.'" checked>';
			} else {
				$html .= '<input type="checkbox" name="'.$name.'">';
			}
		} else {
			$html .= '<input type="checkbox" name="'.$name.'">';
		}

		echo $html;
	}

	/**
	 * @return string code HTML options du select du filtre par catégorie pour la class formation
	 */
	public function afficher_les_options_filtre_par_categorie() {
		$html = ''; //code HTML des options du select du filtre par catégorie

		global $wpdb; //connexion à la bdd
		//récupération du nom de la catégorie lorsque le filtre 'par catégorie est actif'
        //permet l'affichage du nom de la catégotie en cours de filtre
        if (isset($_SESSION['ild_formation_filtre']['categorie_id'])) {
            $slocal_requete_nom_categorie = "SELECT nom FROM ild_categorie WHERE id=" . intval($_SESSION['ild_formation_filtre']['categorie_id']);
            $slocal_nom_categorie = $wpdb->get_var($slocal_requete_nom_categorie);
		}
		
        	$slocal_requete_categorie = "SELECT * FROM ild_categorie"; //requête pour la liste des catégories
			$olocal_categories = $wpdb->get_results($slocal_requete_categorie); //récupère les catégories sous forme d'objet
		
		//affichage de la première option
		if (isset($_SESSION['ild_formation_filtre']['categorie_id'])) { //si le filtre par categorie_id est actif
			$html .= '<option value=' . $_SESSION["ild_formation_filtre"]["categorie_id"] . '>' . $slocal_nom_categorie . '</option>
					  <option value="null">Retirer ce filtre</option>';
		} else {
			$html .= '<option value="null">Par catégorie</option>';
		}

		//affichage des autres options (la liste des catégories)
	  	foreach($olocal_categories as $cat) { 
			$html .= '<option value="'. $cat->id; $html .= '">'. $cat->id;  $html .= '- '. $cat->nom; $html .= '</option>';
		} 

		echo $html;
	}

	/**
	 * @return string code HTML pour la première option du filtre convention de la class formation
	 */
	public function afficher_la_premiere_option_filtre_par_convention() {
		$html = ''; //code HTML de la première option du select du filtre convention

		if (isset($_SESSION["ild_formation_filtre"]["convention"])) { //si le filtre par convention est actif
			$html .= '<option value=' . $_SESSION["ild_formation_filtre"]["convention"] . '>';
				//affichage de la première option
			if ($_SESSION['ild_formation_filtre']['convention'] == 1) { 
				$html .= 'conventionné</option>
						  <option value="null">Retirer ce filtre</option>';
			} else {
				$html .= 'non conventionné</option>
						  <option value="null">Retirer ce filtre</option>';
			}
		} else {
			$html .= '<option value="null">Par convention</option>';
		}

		echo $html;
	}

	/**
	 * @return string code HTML des options du filtre client de la class formation
	 */
	public function afficher_les_options_filtre_client() {
		$html = ''; //code HTML de l'affichage des options du filtre clients

		global $wpdb; //connexion à la bdd
        	$slocal_requete_clients = "SELECT client FROM ild_formation GROUP BY client"; //requête pour la liste des clients
			$olocal_client = $wpdb->get_results($slocal_requete_clients);
		
		//affichage de la première option
		if (isset($_SESSION['ild_formation_filtre']['client'])) { //si filtre client actif
			$html .= '<option value=' . $_SESSION['ild_formation_filtre']['client'] .'>' . $_SESSION['ild_formation_filtre']['client'] .'</option>
					  <option value="null">Retirer ce filtre</option>';
		} else {
			$html .= '<option value="null">Par client</option>';
		}
		//affichage du reste des options (liste des clients)
		foreach($olocal_client  as $client) {
			$html .= '<option value="'. $client->client; $html.= '">' . $client->client; $html .= '</option>';
		}

		echo $html;
	}

	/**
	 * @return string code HTML du filtre annee_min de la class formation
	 */
	public function afficher_les_options_filtre_annee_min() {
		$html = ''; //code HTML des options du select de année minimum

		global $wpdb; //connexion à la bdd
        	$slocal_requete_annees = "SELECT annee FROM ild_formation GROUP BY annee"; //requête pour la liste des années 
			$olocal_annee = $wpdb->get_results($slocal_requete_annees); //récupère la liste des années sous forme d'objet
		
		//affichage de la première option
		if (isset($_SESSION['ild_formation_filtre']['annee_min'])) { //si filtre année_min actif
			$html .= '<option value'. $_SESSION['ild_formation_filtre']['annee_min'] .'>' . $_SESSION['ild_formation_filtre']['annee_min'] .'</option>
					  <option value="null">Retirer ce filtre</option>';
		} else {
			$html .= '<option value="null">Année minimum</option>';
		}
		//affichage du reste des options (liste des années)
		foreach($olocal_annee as $annee) { 
			$html .= '<option value="' . $annee->annee; $html .= '"> ' . $annee->annee; $html .= '</option>';
		}

		echo $html;
	}

	/**
	 * @return string code HTML du filtre annee_max de la class formation
	 */
	public function afficher_les_options_filtre_annee_max() {
		$html = ''; //code HTML de l'affichage des options du filtre annee_max

		global $wpdb; //connexion à la bdd
        	$slocal_requete_annees = "SELECT annee FROM ild_formation GROUP BY annee"; //requête pour la liste des années 
			$olocal_annee = $wpdb->get_results($slocal_requete_annees); //objet contenant la liste des années
		
		//affichage de la première option
		if (isset($_SESSION['ild_formation_filtre']['annee_max'])) { //si filtre annee_max actif
			$html .= '<option value'. $_SESSION['ild_formation_filtre']['annee_max'] .'>' . $_SESSION['ild_formation_filtre']['annee_max'] .'</option>
					  <option value="null">Retirer ce filtre</option>';
		} else {
			$html .= '<option value="null">Année maximum</option>';
		}
		//affichage du reste des options (liste des années)
		foreach($olocal_annee as $annee) {
			$html .= '<option value="' . $annee->annee; $html .= '"> ' . $annee->annee; $html .= '</option>';
		}

		echo $html;
	}

	

								/*************
								 * fonctions *
								 ************/

	/************************** récupère la date d'aujourd'hui et la retourne en format SQL ********************************************* */

	/**
	 * @return date actuelle au format AAAA-MM-JJ
	 */
	function retourne_date_actuelle() {
	    return date('Y-m-d');
	}
	
									/**********************************************
									 *   javascript validations des suppressions   * 
									***********************************************/
	/**
	 * @param [string] $ID
	 * @param [string] $table
	 * @return void echo en javascript un confirm pour la suppression d'un élément et retourne les paramètres envoyés ou non selon le choix de l'utilisateur
	 */
	function js_demande_validation($id, $table) {
		echo '<script>
				let confirm = window.confirm("Voulez-vous valider cette suppression ?");
				if(confirm) {
					window.location.replace("?page='. $_REQUEST['page'] . '&action=delete_valid_'. $table .'&id='.$id.'");
				} else {
					window.location.replace("?page='.$_REQUEST['page'].'");
				}
			  </script>';
	}
}

								/************************
								 * affichage des tables *
								 ***********************/

/************************ wp_list_table des catégories ******************************************/

//la class wp_list_table n'existe pas dans ce fichier, on la récupère
if(!class_exists('WP_List_Table')) require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

/**
 * affichage de la table ild_categorie via wp_list_table
 */
class ild_CategorieTableClass extends WP_List_Table { 

    function __construct() { //si besoin d'exécuter plusieurs actions en même temps
        global $status, $page;
        parent::__construct(array(
            'singular' => 'categorie',
            'plurial' => 'categories'
        ));
    }

    /**
     * affichage des items
     * prépare les items
     *
     * @return void
     */
    public function prepare_items() {

        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $tlocal_hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des catégories (tri)
        
        $this->_column_headers = array($tlocal_columns, $tlocal_hidden, $tlocal_sortable); //affiche les titres des colonnes
        
        $this->process_action(); // vérifie si une action est en cours

        $tlocal_data = $this->retourne_liste_categories(); //récupère la liste des catégories dans la bdd

        $ilocal_perPage = 10; //nombre de données par page
        $ilocal_currentPage = $this->get_pagenum(); //retourne la page sur laquelle on se trouve
        $ilocal_totalItems = count($tlocal_data); //compte le nombre de données dans la table categorie

        $this->set_pagination_args(array( //fonction wordpress qui rencvoie les données des pages
            'total_items' => $ilocal_totalItems,
            'per_page' => $ilocal_perPage
        ));

        $tlocal_data = array_slice($tlocal_data, (($ilocal_currentPage-1)*$ilocal_perPage), $ilocal_perPage); //affiche les données voulues

        $this->items = $tlocal_data; //affiche les données
    }
    /**
     *affiche les titres des colonnes
     *fonction wordpress
     * @return array
     */
    public function get_columns() {
        $tlocal_columns = array(
            'id' => 'ID',
            'nom' => 'Nom'
        );
        return $tlocal_columns;
    }

    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des catégories
     * sous forme de REQUEST
     * fonction wordpress
     * @return array
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
            'id' => array('id', false),
            'nom' => array('nom', false)
        );
        return $tlocal_sortable_columns;
    }

    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [string] $item
     * @param [string] $column_name
     * @return string
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'id': 
            case 'nom': 
                return $item[$column_name];
            default: 
               return print_r($item, true);
        } 
    }

    /**
     * récupère la liste des catégories dans la base de donnnées
     *
     * @return array
     */
    public function retourne_liste_categories() {
        $slocal_requete = ""; //requête pour récupérer toutes les catégories
        $tlocal_resultat = null; //tableau contenant le résultat de lma requête

        global $wpdb;//connecte à la base de données
            $slocal_requete = "SELECT * FROM ild_categorie";
            //gestion de l'ordre d'affichage des données
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
            
            $tlocal_resultat = $wpdb->get_results($slocal_requete, ARRAY_A);
            return $tlocal_resultat;
    }

    /**
     * function wordpress si on utlise "column" dans une fonction
     * le terme suivant donne le nom de la colonne sur laquelle on exxécute la fonction
     * @param [string] $item
     * @return string code HTML liens 'modifier' et 'supprimer'
     */
    public function column_id($item) {
        $actions = array(
            'update' => sprintf('<a href="?page=%s&action=%s&id=%s">Modifier</a>', $_REQUEST['page'], 'update_categorie',  $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Supprimer</a>', $_REQUEST['page'], 'delete_categorie', $item['id']),
        );
        return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions));
    }

    /**
     * vérifie les actions présentes
     * présence de $_REQUEST['action']
     *
     * @return void
     */
    public function process_action() {
		if ($_REQUEST['action'] === 'delete_categorie') {
			$id = $_REQUEST['id'];
			Indexld_Admin::js_demande_validation($id, 'categorie');
		}
        if ($_REQUEST['action'] === 'delete_valid_categorie') {
			$ilocal_id = $_REQUEST['id'];
			$ilocal_id = intval($ilocal_id);
            global $wpdb;

                $delete = $wpdb->delete(
                    'ild_categorie',
					array('id' => $ilocal_id)
                );

            if ($delete) {
                $delete;
                $_REQUEST['action'] = null; //on nettoie les actions
                return $this->prepare_items(); //on raffraichi la page pour afficher les changements
            }
		}
		if ($_REQUEST['action'] === 'update_categorie_valid') {
			$ilocal_id = intval($_POST['id']);
    		$slocal_nom = $_POST['nom'];

    		global $wpdb;
    		    $wpdb->update( 'ild_categorie',
    		        array('nom' => $slocal_nom),
    		        array('id' => $ilocal_id)
    		    );
		}
		if ($_REQUEST['action'] === 'add_categorie_valid') {
			$nom = $_POST['nom'];
			if ($nom !== "") {
				global $wpdb;
					$wpdb->insert(
						'ild_categorie',
						array( 
							'nom' => $nom
						)
					);
			}
		}
    }
}

/************************** wp_list_table des formations **************************************************************** */
/**
 * tableau d'administration des formations
 * WP_List_Table est une class wordpress
 * Défini une nouvelle class du modèle wp_list_table de wordpress
 * liste les formations 
 * ajout, suppression et modification
 */
class ild_FormationTableClass extends WP_List_Table { 

    function __construct() { //si besoin d'exécuter plusieurs actions en même temps
        global $status, $page;
        parent::__construct(array(
            'singular' => 'formation',
            'plurial' => 'formations'
        ));
    }

    /**
     * affichage des items
     * prépare les items
     * fonction de gestion de l'affichage
     * @return void
     */
    public function prepare_items() {

        $tlocal_columns = $this->get_columns(); //récupère les noms des colonnes
        $hidden = array(); //défini les colonnes cachées
        $tlocal_sortable = $this->get_sortable_columns(); //défini si l'ordre d'apparition des formations (tri)
        
        $this->_column_headers = array($tlocal_columns, $hidden, $tlocal_sortable); //affiche les titres des colonnes
        
        $this->process_action(); // vérifie si une action est en cours

        $tlocal_data = $this->retourne_liste_formations(); //récupère la liste des formations dans la bdd

        /********** gestion de la pagination ******** */
        //affichage gérer par la class wp_list_table
        $ilocal_perPage = 8; //nombre de données par page
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
     *affiche les titres des colonnes
     *fonction wordpress
     * @return array
     */
    public function get_columns() {
        $tlocal_columns = array(
            'id' => 'ID',
            'categorie_id' => 'ID catégorie',
            'nom' => 'Nom de la catégorie',
            'client' => 'Client',
            'annee' => 'Année de la formation',
            'note_generale' => 'Note générale',
            'convention' => 'Convention',
            'date_de_creation' => 'Date de création'
        );
        
        if (isset($_SESSION['ild_formation_checkboxes'])) {
            if (is_array($_SESSION['ild_formation_checkboxes'])) {
                    //si élément matcher, ajout de l'élément et de sa valeur au tableau d'affichage des colonnes
                if (in_array('remarque', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['remarque' => 'Remarque']; 
                } 
                if (in_array('nombre_stagiaires', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['nombre_stagiaires' => 'Nombre de stagiaires']; 
                } 
                if (in_array('note_contenu_formation', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['note_contenu_formation' => 'Note sur le contenu de la formation']; 
                } 
                if (in_array('note_formateur_comprehensible', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['note_formateur_comprehensible' => 'Note sur la compréhensibilité du formateur']; 
                } 
                if (in_array('note_formateur_questions', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['note_formateur_questions' => 'Note sur les réponses aux questions']; 
                } 
                if (in_array('note_formateur_adaptation', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['note_formateur_adaptation' => 'Note sur l\'adaptation du formateur']; 
                } 
                if (in_array('note_lieu_adapte', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['note_lieu_adapte' => 'Note sur le lieu']; 
                } 
                if (in_array('note_materiel', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['note_materiel' => 'Note sur le matériel']; 
                } 
                if (in_array('remarque_et_suggestion', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['remarque_et_suggestion' => 'Remarques et suggestions']; 
                } 
                if (in_array('nombre_abandon', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['nombre_abandon' => 'Nombre d\'abandon']; 
                } 
                if (in_array('cause_abandon', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['cause_abandon' => 'Cause abandon']; 
                } 
                if (in_array('nombre_interruption', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['nombre_interruption' => 'Nombre d\'interruption']; 
                } 
                if (in_array('date_de_mise_a_jour', $_SESSION['ild_formation_checkboxes'])) {
                    $tlocal_columns += ['date_de_mise_a_jour' => 'Mise à jour le']; 
                } 
            }
        }
        return $tlocal_columns;
    }

    /**
     * permet de transformer les titres en lien pour trier l'ordre d'affichage des colonnes
     * sous forme de REQUEST
     * fonction wordpress
     * @return array
     */
    public function get_sortable_columns() {
        $tlocal_sortable_columns = array(
            'id' => array('id', false),
            'categorie_id' => array('categorie_id',false),
            'nom' => array('nom', false),
            'client' => array('client',false),
            'annee' => array('annee',false),
            'remarque' => array('remarque',false),
            'nombre_stagiaires' => array('nombre_stagiaires',false),
            'nombre_reponse_questionnaire' => array('nombre_reponse_questionnaire',false),
            'note_generale' => array('note_generale',false),
            'note_contenu_formation' => array('note_contenu_formation',false),
            'note_formateur_comprehensible' => array('note_formateur_comprehensible',false),
            'note_formateur_questions' => array('note_formateur_question',false),
            'note_formateur_adaptation' => array('note_formateur_adaptation',false),
            'note_lieu_adapte' => array('note_lieu_adapte',false),
            'note_materiel' => array('note_materiel',false),
            'remarque_et_suggestion' => array('remarque_et_suggestion',false),
            'nombre_abandon' => array('nombre_abandon',false),
            'cause_abandon' => array('cause_abandon',false),
            'nombre_interruption' => array('nombre_interruption',false),
            'convention' => array('convention',false),
            'date_de_mise_a_jour' => array('date_de_mise_a_jour',false),
            'date_de_creation' => array('date_de_creation',false),
        );
        return $tlocal_sortable_columns;
    }

    /**
     * retourne les lignes du tableau si cachées
     * fonction wordpress
     * @param [string] $item
     * @param [string] $column_name
     * @return string
     */
    public function column_default($item, $column_name) {
        switch($column_name) {
            case 'id': 
            case 'categorie_id': 
            case 'nom' : 
            case 'client' :
            case 'annee' : 
            case 'remarque' : 
            case 'nombre_stagiaires' : 
            case 'nombre_reponse_questionnaire' : 
            case 'note_generale' : 
            case 'note_contenu_formation' : 
            case 'note_formateur_comprehensible' : 
            case 'note_formateur_questions' : 
            case 'note_formateur_adaptation' : 
            case 'note_lieu_adapte' : 
            case 'note_materiel' : 
            case 'remarque_et_suggestion' : 
            case 'nombre_abandon' : 
            case 'cause_abandon' :
            case 'nombre_interruption' : 
            case 'convention' : 
            case 'date_de_mise_a_jour' :
            case 'date_de_creation' :
                return $item[$column_name];
            default: 
               return print_r($item, true);
        } 
    }

    /**
     * récupère la liste des formations dans la base de donnnées
     * fonction gérant les requêtes SQL
     * 
     * retourne une liste en fonction des filtres
     * @return array
     */
    public function retourne_liste_formations() {
        $slocal_requete = ""; //requête pour récupérer toutes les formations
        $tlocal_resultat = null; //tableau contenant le résultat de la requête

        global $wpdb;//connecte à la base de données
            $slocal_requete = "SELECT * FROM ild_categorie AS c INNER JOIN ild_formation AS f WHERE f.categorie_id = c.id";

            //compteurs de présence des filtres annee_min et annee_max
            $ilocal_compteur_filtre_annee_min = 0;
            $ilocal_compteur_filtre_annee_max = 0;

            if (is_array($_SESSION['ild_formation_filtre'])) { //si $_SESSION['ild_formation_filtre'] est bien un tableau
                
                if (array_key_exists('categorie_id', $_SESSION['ild_formation_filtre'])) { //catégorie_id
                    $slocal_requete .= " AND f.categorie_id=" . intval($_SESSION['ild_formation_filtre']['categorie_id']);
                }
                if (array_key_exists('convention', $_SESSION['ild_formation_filtre'])) { //convention
                    $slocal_requete .= " AND f.convention=" . intval($_SESSION['ild_formation_filtre']['convention']); 
                }
                if (array_key_exists('client', $_SESSION['ild_formation_filtre'])) { //client
                    $slocal_requete .= " AND f.client LIKE '" . strval($_SESSION['ild_formation_filtre']['client']) . "'";
                }
                if (array_key_exists('annee_min', $_SESSION['ild_formation_filtre'])) {
                    $ilocal_compteur_filtre_annee_min++;
                }
                if (array_key_exists('annee_max', $_SESSION['ild_formation_filtre'])) {
                    $ilocal_compteur_filtre_annee_max++; 
                }
                if ($ilocal_compteur_filtre_annee_min > 0 && $ilocal_compteur_filtre_annee_max > 0) {
                    $slocal_requete .= " AND f.annee BETWEEN " . intval($_SESSION['ild_formation_filtre']['annee_min']) . " AND " . intval($_SESSION['ild_formation_filtre'][0]['annee_max']); 
                }
                if ($ilocal_compteur_filtre_annee_min > 0 && $ilocal_compteur_filtre_annee_max === 0) {
                    $slocal_requete .= " AND f.annee >= " . intval($_SESSION['ild_formation_filtre']['annee_min']);
                }
                if ($ilocal_compteur_filtre_annee_min === 0 && $ilocal_compteur_filtre_annee_max > 0) {
                    $slocal_requete .= " AND f.annee <= " . intval($_SESSION['ild_formation_filtre']['annee_max']);
                }
            }
            
            //gestion de l'ordre d'affichage des données
            if (!empty($_REQUEST['orderby'])) {
                if ($_REQUEST['orderby'] === "id") {
                    $slocal_requete .= " ORDER BY f.id";
                }
            }
            if (!empty($_REQUEST['order'])) {
                if ($_REQUEST['order'] === "asc") {
                    $slocal_requete .= " ASC";
                } else {
                        $slocal_requete .= " DESC";
                }
            }
            
            $tlocal_resultat = $wpdb->get_results($slocal_requete, ARRAY_A); //variable contenant les résultat de la requête dans un tableau
            return $tlocal_resultat;
    }

    /**
     * function wordpress si on utlise "column" dans une fonction
     * le terme suivant donne le nom de la colonne sur laquelle on exécute la fonction
     * @param [type] $item
     * @return string code HTML liens 'modifier' et 'supprimer'
     */
    public function column_id($item) {
        $actions = array(
            'update' => sprintf('<a href="?page=%s&action=%s&id=%s">Modifier</a>', $_REQUEST['page'], 'update_formation',  $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Supprimer</a>', $_REQUEST['page'], 'delete_formation', $item['id']),
        );
        return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions));
    }

    /**
     * vérifie les actions présentes
     * présence de $_REQUEST['action']
     * @return void
     */
    public function process_action() {
		if ($_REQUEST['action'] === 'delete_formation') {
			$id = $_REQUEST['id'];
			Indexld_Admin::js_demande_validation($id, 'formation');
		}
        if ($_REQUEST['action'] === 'delete_valid_formation') {
            $ilocal_id = $_REQUEST['id'];
            global $wpdb;

                $delete = $wpdb->delete(
                    'ild_formation',
                    array('id' => $ilocal_id)
                );

            if ($delete) {
                $delete;
                $_REQUEST['action'] = null; //on nettoie les actions
                return $this->prepare_items(); //on raffraichi la page pour afficher les changements
            }
            
		}
		if ($_REQUEST['action'] === 'add_formation_valid') {
			$this->insert_formation();
		}
		if ($_REQUEST['action'] === 'update_formation_valid') {
			$this->update_formation();
		}
		if ($_REQUEST['action'] === 'export_fichier_csv') {
			$this->export_fichier_csv();
		}
		if ($_REQUEST['action'] === 'import_fichier_csv') {
			if ($_FILES['fichier']['type'] == "application/vnd.ms-excel") { //si le fichier est au format .csv
				$this->traite_les_donnees_du_fichier(); 
			} else {
				echo '<p style="color:red;">Le fichier doit être au format csv</p>';
			}
		}
	}
	
	/**
	 * insert une formation dans la table ild_formation de la base de données
	 *
	 * @return void
	 */
	public function insert_formation() {
		if (isset($_POST['submit_add'])) {
			//récupération de tous les champs du formulaire
			$categorie_id = intval($_POST['categorie_id']);
			$annee = intval($_POST['annee']);
			$client = $_POST['client'];
			$remarque = $_POST['remarque'];
			$nombre_stagiaires = intval($_POST['nombre_stagiaires']);
			$nombre_reponse_questionnaire = intval($_POST['nombre_reponse_questionnaire']);
			$note_generale = $this->retourne_null_ou_valeur($_POST['note_generale']);
			$note_contenu_formation = $this->retourne_null_ou_valeur($_POST['note_contenu_formation']);
			$note_formateur_comprehensible = $this->retourne_null_ou_valeur($_POST['note_formateur_comprehensible']);
			$note_formateur_questions = $this->retourne_null_ou_valeur($_POST['note_formateur_questions']);
			$note_formateur_adaptation = $this->retourne_null_ou_valeur($_POST['note_formateur_adaptation']);
			$note_lieu_adapte = $this->retourne_null_ou_valeur($_POST['note_lieu_adapte']);
			$note_materiel = $this->retourne_null_ou_valeur($_POST['note_materiel']);
			$remarque_et_suggestion = $_POST['remarque_et_suggestion'];
			$nombre_abandon = intval($_POST['nombre_abandon']);
			$cause_abandon = $_POST['cause_abandon'];
			$nombre_interruption = intval($_POST['nombre_interruption']);
			$convention = $_POST['convention'];
			$date_de_mise_a_jour = Indexld_Admin::retourne_date_actuelle();
			$date_de_creation = Indexld_Admin::retourne_date_actuelle();
		
			
			global $wpdb; //connexion à la bdd
				$insert = $wpdb->insert('ild_formation', array( 
					'categorie_id' => $categorie_id,
					'client' => $client,
					'annee' => $annee,
					'remarque' => $remarque,
					'nombre_stagiaires' => $nombre_stagiaires,
					'nombre_reponse_questionnaire' => $nombre_reponse_questionnaire,
					'note_generale' => $note_generale,
					'note_contenu_formation' => $note_contenu_formation,
					'note_formateur_comprehensible' => $note_formateur_comprehensible,
					'note_formateur_questions' => $note_formateur_questions,
					'note_formateur_adaptation' => $note_formateur_adaptation,
					'note_lieu_adapte' => $note_lieu_adapte,
					'note_materiel' => $note_materiel,
					'remarque_et_suggestion' => $remarque_et_suggestion,
					'nombre_abandon' => $nombre_abandon,
					'cause_abandon' => $cause_abandon,
					'nombre_interruption' => $nombre_interruption,
					'convention' => $convention,
					'date_de_mise_a_jour' => $date_de_mise_a_jour,
					'date_de_creation' => $date_de_creation
				));   
		}
		
	}

	/**
	 * transforme une string en float ou null si vide
	 *
	 * @param [string] $val
	 * @return null ou float
	 */
	public function retourne_null_ou_valeur($val) {
		if ($val == "") {
			return null;
		} else {
			return floatval($val);
		}
	}

	/**
	 * update une formation de la table ild_formtion dans la base de données
	 *
	 * @return void
	 */
	public function update_formation() {
		$id = $_POST['id'];
    	$categorie_id = intval($_POST['categorie_id']);
    	$client = $_POST['client'];
    	$annee = intval($_POST['annee']);
    	$remarque = $_POST['remarque'];
    	$nombre_stagiaires = intval($_POST['nombre_stagiaires']);
    	$nombre_reponse_questionnaire = intval($_POST['nombre_reponse_questionnaire']);
    	$note_generale = $this->retourne_null_ou_valeur($_POST['note_generale']);
    	$note_contenu_formation = $this->retourne_null_ou_valeur($_POST['note_contenu_formation']);
    	$note_formateur_comprehensible = $this->retourne_null_ou_valeur($_POST['note_formateur_comprehensible']);
    	$note_formateur_questions = $this->retourne_null_ou_valeur($_POST['note_formateur_questions']);
    	$note_formateur_adaptation = $this->retourne_null_ou_valeur($_POST['note_formateur_adaptation']);
    	$note_lieu_adapte = $this->retourne_null_ou_valeur($_POST['note_lieu_adapte']);
    	$note_materiel = $this->retourne_null_ou_valeur($_POST['note_materiel']);
    	$remarque_et_suggestion = $_POST['remarque_et_suggestion'];
    	$nombre_abandon = intval($_POST['nombre_abandon']);
    	$cause_abandon = $_POST['cause_abandon'];
    	$nombre_interruption = intval($_POST['nombre_interruption']);
    	$convention = intval($_POST['convention']);
    	$date_de_mise_a_jour = Affuteo_Indexld::retourne_date_actuelle();

    	global $wpdb; //connexion à la bdd
    	    $update = $wpdb->update('ild_formation', array( 
    	        'categorie_id' => $categorie_id,
    	        'client' => $client,
    	        'annee' => $annee,
    	        'remarque' => $remarque,
    	        'nombre_stagiaires' => $nombre_stagiaires,
    	        'nombre_reponse_questionnaire' => $nombre_reponse_questionnaire,
    	        'note_generale' => $note_generale,
    	        'note_contenu_formation' => $note_contenu_formation,
    	        'note_formateur_comprehensible' => $note_formateur_comprehensible,
    	        'note_formateur_questions' => $note_formateur_questions,
    	        'note_formateur_adaptation' => $note_formateur_adaptation,
    	        'note_lieu_adapte' => $note_lieu_adapte,
    	        'note_materiel' => $note_materiel,
    	        'remarque_et_suggestion' => $remarque_et_suggestion,
    	        'nombre_abandon' => $nombre_abandon,
    	        'cause_abandon' => $cause_abandon,
    	        'nombre_interruption' => $nombre_interruption,
    	        'convention' => $convention,
    	        'date_de_mise_a_jour' => $date_de_mise_a_jour
    	    ),
    	    array( 'id' => $id)
    	    );
	}

	/**
	 * transforme la table ild_formation en un fichier csv
	 *
	 * @return string bouton 'télécharger' dans la page du tableau formation
	 */
	public function export_fichier_csv() {
		$file = null; //fichier csv contenant la table ild_formation
		$slocal_requete = ""; //requête SQL récupérant le contenu de la table ild_formation
		$tlocal_resultat = []; //tableau contenant le résultat de la requête
		
		global $wpdb; //connexion à la base de données
		
		$file = fopen('../file.csv', "w"); //ouvre un fichier à la racine du site
										   //"../ pour wordpress signifie à la racine
	
		fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF) ); //format excel
		
		//première ligne qui renvoie les titres des colonnes de la table ild_formation
		fputcsv($file, array('ID','Categorie_id','Nom de la catégorie','Client','Année','Remarque','Nombre de stagiaires','Nombre de réponses au questionnaire','Note générale','Note sur le contenu de la formation','Note compréhensibilité du formateur','Note réponses aux questions au formateur','Note adaptabilité du formateur','Note lieu adapté','Note sur le matériel','Remarques et suggestions','Nombre d\'abandon','Cause des abandons','Nombre d\'interruption','Formation conventionnée 1:oui 2:non', 'Date de mise à jour', 'Date de création'), ";");
			//détail les colonnes pour donner l'ordre d'affichage et séparer l'id de la table ild_formation de la table ild_categorie
			$slocal_requete = "SELECT f.id,categorie_id,nom,client,annee,remarque,nombre_stagiaires,nombre_reponse_questionnaire,note_generale,note_contenu_formation,note_formateur_comprehensible,note_formateur_questions,note_formateur_adaptation,note_lieu_adapte,note_materiel,remarque_et_suggestion,nombre_abandon,cause_abandon,nombre_interruption,convention,date_de_mise_a_jour,date_de_creation FROM ild_categorie AS c INNER JOIN ild_formation AS f WHERE f.categorie_id=c.id ORDER BY categorie_id,annee,date_de_creation ASC"; //requête récupérant tout le contenu de la table
			$tlocal_resultat = $wpdb->get_results($slocal_requete, ARRAY_A); 
	
		//ajoute au fichier les lignes de la table avec un ";" comme séparateur pour excel
		foreach($tlocal_resultat as $res) {
			fputcsv($file, $res, ";");
		}
		fclose($file);//fin du fichier
		
		//Apparition du bouton télécharger qui récupère l'adresse du fichier
		echo '<button class="button button-primary"><a href="https://www.indexld.com/file.csv" style="color:white; text-decoration:none;" >télécharger le fichier CSV</a></button>';
	}

	/**
	 * utilise une transaction pour :
	 * 	effacer les données de la table ild_formation
	 * 	insérer les valeurs reçues d'un fichier csv
	 *
	 * @return void
	 */
	public function traite_les_donnees_du_fichier() {
		$flocal_fichier = ""; //variable contenant le fichier téléchargé contenant son nom temporaire
		$ilocal_numero_ligne = 1; //numéro de la ligne du fichier csv
		$ilocal_nombre_champs = 0; //nombre de champs par ligne
		$tlocal_data_ligne = []; //tableau récupérant les données d'une ligne du fichier csv
		
		$tlocal_all_datas = []; //tableau récupérant tous les champs de toutes les lignes du fichier csv
	
		//place le fichier dans une variable
		$flocal_fichier = fopen($_FILES['fichier']['tmp_name'], "r");  
	
		/**
		 * dans le fichier csv, leschamps sont délimitées par une ","
		 * place chaque donnée de chaque ligne dans un tableau
		 * 1000 correspond au nombre de caractère maximal par champ
		 */
		while(($tlocal_data_ligne = fgetcsv($flocal_fichier, 1000, ",")) != false) {
	
			$tlocal_data_ligne = array_map("utf8_encode", $tlocal_data_ligne); //met au format UTF8 pour les caractères spéciaux
			$ilocal_nombre_champs = count($tlocal_data_ligne);
			
			/**
			 * quand le tableau data de la ligne a récuoéré tous les champs de la ligne (19)
			 * et qu'il a passé la première ligne (titres des colonnes du fichier csv)
			 * ajoute chaque ligne dans le tableau $tlocal_all_datas
			 */
			if ($ilocal_nombre_champs === 22 && $ilocal_numero_ligne > 1) {
				array_push($tlocal_all_datas, $tlocal_data_ligne);
			}
			$ilocal_numero_ligne++;
		}
		fclose($flocal_fichier); //fin du fichier
	
		global $wpdb; //connexion à la base de données
		/**
		 * transaction sql
		 * s'il y a un problème dans une insertion 
		 * toute requête est annulée sans perdre les données de la table
		 */
		$derror = true; //booleen pour la transaction
		$wpdb->query('START TRANSACTION');
			$delete = $wpdb->query('DELETE FROM ild_formation'); //vide la table ild_formation
			if (!$delete) {
				$derror = false;
			}
			foreach($tlocal_all_datas as $ligne) {
				$insert = $wpdb->insert(
					'ild_formation',
					array( 
						'categorie_id' => intval($ligne[1]),
						'client' => $ligne[3],
						'annee' => intval($ligne[4]),
						'remarque' => $ligne[5],
						'nombre_stagiaires' => intval($ligne[6]),
						'nombre_reponse_questionnaire' => intval($ligne[7]),
						'note_generale' => $this->retourne_null_ou_valeur($ligne[8]),
						'note_contenu_formation' => $this->retourne_null_ou_valeur($ligne[9]),
						'note_formateur_comprehensible' => $this->retourne_null_ou_valeur($ligne[10]),
						'note_formateur_questions' => $this->retourne_null_ou_valeur($ligne[11]),
						'note_formateur_adaptation' => $this->retourne_null_ou_valeur($ligne[12]),
						'note_lieu_adapte' => $this->retourne_null_ou_valeur($ligne[13]),
						'note_materiel' => $this->retourne_null_ou_valeur($ligne[14]),
						'remarque_et_suggestion' => $ligne[15],
						'nombre_abandon' => intval($ligne[16]),
						'cause_abandon' => $ligne[17],
						'nombre_interruption' => intval($ligne[18]),
						'convention' => intval($ligne[19]),
						'date_de_mise_a_jour' => Affuteo_Indexld::retourne_date_actuelle(),
						'date_de_creation' => Affuteo_Indexld::retourne_date_actuelle()
					)
				);
				if (!$insert) {
					$derror = false;
				}
			}
		if ($derror) {
			$wpdb->query('COMMIT');
		} else {
			$wpdb->query('ROLLBACK');
			echo '<p style="color:red;">Echec de transfert de données</p>';
		}
	}
	
}



	
