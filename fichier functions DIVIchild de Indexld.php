<?php

function ILD_theme_js(){

$js_directory = get_template_directory_uri() . '/../Divichild/js/'; 

wp_register_script( 'app', $js_directory . 'app.js' );
wp_register_script( 'app', $js_directory . 'ild_spritely.js');
wp_register_script( 'jquerymin', $js_directory . 'jquery-2.1.4.min.js' );

wp_enqueue_script( 'jquerymin', $js_directory . 'jquery-2.1.4.min.js' );
wp_enqueue_script( 'app', $js_directory . 'app.js', false );
wp_enqueue_script( 'spritely', $js_directory . 'ild_spritely.js', false);

}
 
add_action( 'wp_enqueue_scripts', 'ILD_theme_js', 101 );


/**
* FONCTION DE CALCUL DES DISTANCES
**/

function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
    // Calcul de la distance en degrés
    $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
    // Conversion de la distance en degrés à l'unité choisie (kilomètres, milles ou milles nautiques)
    switch($unit) {
        case 'km':
            $distance = $degrees * 111.13384; // 1 degré = 111,13384 km, sur base du diamètre moyen de la Terre (12735 km)
            break;
        case 'mi':
            $distance = $degrees * 69.05482; // 1 degré = 69,05482 milles, sur base du diamètre moyen de la Terre (7913,1 milles)
            break;
        case 'nmi':
            $distance =  $degrees * 59.97662; // 1 degré = 59.97662 milles nautiques, sur base du diamètre moyen de la Terre (6,876.3 milles nautiques)
    }
    return round($distance, $decimals);
}

/**
* API GUIDIZZ
*/

function ILD_getCustomer(WP_REST_Request $request) {
    global $wpdb;
        $table        = $wpdb->prefix . 'gui_customers';
        $latitude     = $request['latitude'];
        $longitude    = $request['longitude'];
        $re_query     = "SELECT *,
                        get_distance_metres($latitude, $longitude, locationlat, locationlong)
                        AS distance
        				FROM $table
        				ORDER BY  distance
        				LIMIT 10";
        $pre_results  = $wpdb->get_results($re_query,ARRAY_A);      
    return $pre_results;
}

/* hook permettant de rajouter ces données à l'api json */
add_action( 'rest_api_init', function () {
    register_rest_route( 'guidix/v1', '/customer/latitude/(?P<latitude>[a-z0-9 .\-]+)/longitude/(?P<longitude>[a-z0-9 .\-]+)', array(          
        'methods' => 'GET',
        'callback' => 'ILD_getCustomer'
    ) );
} );

/* 15/09/2020 Début d'ajout de code Frédéric Prévot */

/***
 * Frédéric
 * retourne la moyenne des notes générales sur 5 
 * Les notes sont sur 10 
 */
function retourne_taux_de_satisfaction() {
    $slocal_requete = ""; //requête pour récupérer la moyenne des notes générales
    $flocal_moyenne = null; //moyenne des notes générales
    global $wpdb; //on se connecte à la bdd du site

    //calcul de la moyenne des notes générales de satisfaction de l'ensemble des formations
    $slocal_requete = "SELECT AVG(note_generale) FROM ild_formation"; 
    //la moyenne est stockée dans une variable
    $flocal_moyenne = $wpdb->get_var($wpdb->prepare($slocal_requete));

    return round($flocal_moyenne/2, 2); //on ramène la note sur 5 arrondie au centième
}
add_shortcode('ild_taux_de_satisfaction', 'retourne_taux_de_satisfaction');

/**
 * Frédéric
 * retourne la somme des valeurs du champ envoyé en paramètres
 */
function retourne_somme_valeurs_champ($champ) {
    $slocal_requeteSommeValeurs = ""; //requête pour récupérer la somme des valeurs demandées du champ
    $ilocal_sommeValeurs = null; //résultat de la requête
    global $wpdb; //on se connecte à la bdd du site

        $slocal_requeteSommeValeurs = "SELECT SUM($champ) FROM ild_formation";
        $ilocal_sommeValeurs = $wpdb->get_var($wpdb->prepare($slocal_requeteSommeValeurs));

        return $ilocal_sommeValeurs;
}

/**
 * Frédéric
 * Retourne les taux des abandons, réponses aux questionnaires ou d'interruption
 * Insérer un attribut (nom du champ) dans les shortcodes utilisants cette fonction 
 * 
 * Cet attribut a pour nom libelle
 */
function retourne_taux_suivant_nombre_stagiaires( $atts ) {
    $ilocal_totalChamp = null; //somme des valeurs du champ visé
    $ilocal_totalSragiaires = null; //total du nombre de stagiaires
    $ilocal_taux = null; //taux du nombre de stagiaires du champ visé suivant le nombre total de stagiaires

    //on récupère le nom du champ envoyé en attribut
    extract(shortcode_atts(array( //on extrait l'attribut
        'attribut' => 'test'
    ), $atts)); //$atts est le tableau associatif des attributs envoyés
    //l'attribut sera récupéré sous la variable $attribut
    
    global $wpdb; //on se connecte à la bdd du site

    $ilocal_totalChamp = retourne_somme_valeurs_champ($attribut);
    $ilocal_totalSragiaires = retourne_somme_valeurs_champ('nombre_stagiaires');

    $ilocal_taux =$ilocal_totalChamp*100/$ilocal_totalSragiaires; //calcul du taux
    
    return round($ilocal_taux); //on arrondi le taux à l'entier
}
add_shortcode('ild_taux_suivant_nombre_stagiaires', 'retourne_taux_suivant_nombre_stagiaires');

/**
 * Frédéric
 * nombre total de réponses au questionnaire de satisfaction
 */
function nombre_total_de_reponses_au_questionnaire() {
    return retourne_somme_valeurs_champ('nombre_reponse_questionnaire'); 
}
add_shortcode('ild_nombre_total_de_reponses_au_questionnaire', 'nombre_total_de_reponses_au_questionnaire');

/***
 * nombre total de stagiaires
 */
function nombre_total_de_stagiaires() {
    return retourne_somme_valeurs_champ('nombre_stagiaires');
}
add_shortcode( 'ild_nombre_total_de_stagiaires', 'nombre_total_de_stagiaires' );



/**
 * Frédéric
 * calculs du nombre de stagiaires par catégorie de formation et si hors convention
 * les shortcodes ont 2 attributs : 
 *    - l'id de la catégorie (categorie)
 *    - un int (convention) 1:convention, 2: hors convention
 * 
 */
function retourne_nombre_stagiaires_par_categorie_convention($atts) {
    $slocal_requete = ""; //requête pour récupérer le nombre de stagiaires dans le champ voulu
    $ilocal_nombreStagiaires = null; //nombre de stagiaires du résultat de la requête

    //on récupère les noms des champs envoyés en attribut
    extract(shortcode_atts(array( //on extrait les attributs
        'categorie' => '1',
        'convention' => '1'
    ), $atts)); //$atts est le tableau associatif des attributs envoyés
    //les attributs sont récupérés en varibles $categorie et $convention

    global $wpdb; //on se connecte à le bdd
        $slocal_requete = "SELECT SUM(nombre_stagiaires) FROM ild_formation WHERE categorie_id=$categorie AND convention=$convention";
        $ilocal_nombreStagiaires = $wpdb->get_var($wpdb->prepare($slocal_requete));

        return $ilocal_nombreStagiaires;
}
add_shortcode( 'ild_retourne_nombre_stagiaires_par_categorie_convention', 'retourne_nombre_stagiaires_par_categorie_convention' );

 /**
  * Frédéric
 * création du formulaire d'ajout d'une colonne dans la table ild_formation
 * on y ajoute une formation
 */
function affiche_formulaire_pour_ajouter_une_formation() {
    $olocal_categories = null; //récupère la liste des catégories 
    $slocal_html = ""; //le code HTML du formulaire
    
    $olocal_categories = retourne_la_liste_d_un_champ('ild_categorie'); //on récupère la liste des catégories de formation 
    //on insère le formulaire dans une variable qu'on concatène au fur et à mesure
   $slocal_html ='<form action="#" method="POST">
        ' . wp_nonce_field('formulaire_formation', 'verification'); // wp_nonce_field() permet de vérifier que le contenu d’une requête d’un formulaire provient bien du site actuel, et non d’un autre site. 
        //le select des catégories avec son id en retour de valeur
        $slocal_html.= '<p>
                <label for="categorie">Sélectionnez la catégorie de la formation : </label>
                <select name="categorie" id="categorie"> ';
                    foreach ($olocal_categories as $cat) { 
                        $slocal_html .='<option value= ' . $cat->id; $slocal_html.= '>' . $cat->nom; $slocal_html .= '</option> ';
                    } $slocal_html .= '
                </select>
                </p>
                <p> 
                    <label for="client">Entrez le nom du client : </label>
                    <input id="client" name="client" type="text">
                </p>
                <p> 
                    <label for="annee">Sélectionnez la date : </label>
                    <input id="annee" name="annee" type="date">
                </p>
                <p> 
                    <label for="remarque">Entrez une remarque : </label>
                    <textarea id="remarque" name="remarque"></textarea>
                </p>
                <p>
                    <label for="nombre_stagiaires">Entrez le nombre de stagiaires : </label>
                    <input type="number" id="nombre_stagiaires" name="nombre_stagiaires">
                </p>
                <p>
                    <label for="nombre_reponse_questionnaire">Entrez le nombre de réponses au questionnaire : </label>
                    <input type="number" id="nombre_reponse_questionnaire" name="nombre_reponse_questionnaire">
                </p>
                <p>
                    <label for="note_generale">Entrez la note générale (int) : </label>
                    <input type="number" id="note_generale" name="note_generale">
                </p>
                <p>
                    <label for="note_contenu_formation">Entrez la note sur le contenu de la formation (int) : </label>
                    <input type="number" id="note_contenu_formation" name="note_contenu_formation">
                </p>
                <p>
                    <label for="note_formateur_comprehensible">Entrez la note sur la compréhensibilté du formateur (int) : </label>
                    <input type="number" id="note_formateur_comprehensible" name="note_formateur_comprehensible">
                </p>
                <p>
                    <label for="note_formateur_questions">Entrez la note sur les réponses du formateur aux questions posées (int) : </label>
                    <input type="number" id="note_formateur_questions" name="note_formateur_questions">
                </p>
                <p>
                    <label for="note_formateur_adaptation">Entrez la note sur l\'adaptation du formateur aux stagiaires (int) : </label>
                    <input type="number" id="note_formateur_adaptation" name="note_formateur_adaptation">
                </p>
                <p>
                    <label for="note_lieu_adapte">Entrez la note sur l\'adaptation du lieu (int) : </label>
                    <input type="number" id="note_lieu_adapte" name="note_lieu_adapte">
                </p>
                <p>
                    <label for="note_materiel">Entrez la note sur le matériel (int) : </label>
                    <input type="number" id="note_materiel" name="note_materiel">
                </p>
                <p>
                    <label for="remarque_et_suggestion">Entrez les remarques et les suggestions de la formation : </label>
                    <textarea name="remarque_et_suggestion" id="remarque_et_suggestion" ></textarea>
                </p>
                <p>
                    <label for="nombre_abandon">Entrez le nombre d\'abandon : </label>
                    <input type="number" id="nombre_abandon" name="nombre_abandon">
                </p>
                <p>
                    <label for="cause_abandon">Entrez la cause de(s) l\'abandon(s) : </label>
                    <textarea name="cause_abandon" id="cause_abandon"></textarea>
                </p>
                <p>
                    <label for="nombre_interruption">Entrez le nombre d\'interruption : </label>
                    <input type="number" id="nombre_interruption" name="nombre_interruption">
                </p>
                <p>
                    <label for="convention">Statut de la formation : </label>
                    <select name="convention" id="convention">
                        <option value="1">en convention</option>
                        <option value="0">hors convention</option>
                    </select>
                </p>
                <p>
                    <input type="submit" name="submit" value="ajouter">
                </p>
    </form> ';
	return $slocal_html; //on renvoi le formulaire
}
add_shortcode( 'ild_affiche_formulaire_pour_ajouter_une_formation', 'affiche_formulaire_pour_ajouter_une_formation' );

/**
 * fonction qui récupère la liste des catégories de formation dans un tableau associatif
 * afin d'approvisionner le select du formulaire d'ajout de formation
 * le nom de la table visée est donnée en paramètres
 */
function retourne_la_liste_d_un_champ($table) {
    $slocal_requete = ""; //requête pour récupérer tout de la table donnée en paramètres
    $olocal_resultat = null; //résultat de la requête

    global $wpdb; //on se connecte à la bdd
        $slocal_requete = 'SELECT * FROM '. $table; //récupère toutes les catégories

        $olocal_resultat = $wpdb->get_results($wpdb->prepare($slocal_requete,ARRAY_A));//on récupère toutes les catégories qu'on place dans un tableau associatif
        return $olocal_resultat;
}

/**
 * Récupération des données envoyées par le formulaire d'ajout de formation
 * ajoute les données dans le champ ild_formation de la base de données 
 */
function ajoute_la_formation_a_la_bdd() {
	
    //si on a cliquer sur le bouton envoyer et s'il y a presence du nonce (vérification que le formulaire soit du même site)
    if (isset($_POST['submit']) && isset($_POST['verification'])) {
        //vérification du nonce (le nom du nonce et ce que ce qui est envoyé)
        if (wp_verify_nonce( $_POST['verification'], 'formulaire_formation' )) {
            //on récupère les toutes les données envoyées
            $categorie = $_POST['categorie'];
			if ($_POST['client' !== '']) {
				$client = $_POST['client'];
			} else {
				return '<p style="color:red">erreur : formation non enregistrée</p><br/>';
			}
            
            $annee = $_POST['annee'];
            $remarque = $_POST['remarque'];
            $nombre_stagiaires = $_POST['nombre_stagiaires'];
            $nombre_reponse_questionnaire = $_POST['nombre_reponse_questionnaire'];
            $note_generale = $_POST['note_generale'];
            $note_contenu_formation = $_POST['note_contenu_formation'];
            $note_formateur_comprehensible = $_POST['note_formateur_comprehensible'];
            $note_formateur_questions = $_POST['note_formateur_questions'];
            $note_formateur_adaptation = $_POST['note_formateur_adaptation'];
            $note_lieu_adapte = $_POST['note_lieu_adapte'];
            $note_materiel = $_POST['note_materiel'];
            $remarque_et_suggestion = $_POST['remarque_et_suggestion'];
            $nombre_abandon = $_POST['nombre_abandon'];
            $cause_abandon = $_POST['cause_abandon'];
            $nombre_interruption = $_POST['nombre_interruption'];
            $convention = $_POST['convention'];
            
            //on se connecte à la base de données
            global $wpdb;
                $table = 'ild_formation';

                $insert = $wpdb->insert($table, 
                    array(
                        'categorie_id' => $categorie,
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
                        'convention' => $convention
                    ));
            //affiche un message lors de l'envoi du formulaire
            if (!insert) { //si la requête est erronée elle retourne false
                return '<p style="color:red">erreur : formation non enregistrée</p><br/>';
            } else {
                return '<p style="color:green">formation enregistrée</p><br/>';
            }         
            //return $insert;
        }
    }
	
}
add_action( 'template_redirect', 'ajoute_la_formation_a_la_bdd' );
add_shortcode('ild_affiche_message_pour_insert_formation', 'ajoute_la_formation_a_la_bdd'); 

/**
 * récupère le nom de la catégorie par son id
 * que l'on place dans une variable
 */
function recupere_categorie_par_id($id) {
    global $wpdb;

    $requete = "SELECT nom FROM ild_categorie WHERE id=" .$id;
    //on met le résultat dans une variable
    $nomCategorie = $wpdb->get_var($wpdb->prepare($requete));

    return $nomCategorie;
}
function affiche_les_formations_avec_delete_et_update() {
    global $wpdb; //on se connecte à la base de données

    //on récupère la liste des formations
    $tableFormation = 'ild_formation';
    $listeFormations = retourne_la_liste_d_un_champ($tableFormation);

    $html = '<div style="overflow:scroll"><table>
                    <tr>
                        <th>nom de la formation</th>
                        <th>client</th>
                        <th>date</th>
                        <th>remarque</th>
                        <th>nombre de stagiaires</th>
                        <th>nombre de réponses au questionnaire</th>
                        <th>note générale</th>
                        <th>note sur le contenu de la formation</th>
                        <th>note sur la compréhensibilité du fromateur</th>
                        <th>note des réponses du formateur aux questions</th>
                        <th>note de l\'adaptation du formateur</th>
                        <th>note sur l\'adaptabilité du lieu</th>
                        <th>note du matériel</th>
                        <th>remarque et suggestion</th>
                        <th>nombre d\'abandon</th>
                        <th>cause de l\'abandon</th>
                        <th>nombre d\'interruption</th>
                        <th>formation conventionnée</th>
                        <th>modifier</th>
                        <th>supprimer</th>
                    </tr>
                </thead>
             <tbody>';
                    foreach($listeFormations as $formation) {
    $html .= '       <tr>
                        <td>' . recupere_categorie_par_id($formation->categorie_id) . '</td>
						<td>' . $formation->client .'</td>
                        <td>' . $formation->annee .'</td>
                        <td>' . $formation->remarque .'</td>
                        <td>' . $formation->nombre_stagiaires .'</td>
                        <td>' . $formation->nombre_reponse_questionnaire .'</td>
                        <td>' . $formation->note_generale .'</td>
                        <td>' . $formation->note_contenu_formation .'</td>
                        <td>' . $formation->note_formateur_comprehensible .'</td>
                        <td>' . $formation->note_formateur_questions .'</td>
                        <td>' . $formation->note_formateur_adaptation .'</td>
						<td>' . $formation->note_lieu_adapte .'</td>
                        <td>' . $formation->note_materiel .'</td>
                        <td>' . $formation->remarque_et_suggestion .'</td>
						<td>' . $formation->nombre_abandon .'</td>                        
                        <td>' . $formation->cause_abandon .'</td>                        
                        <td>' . $formation->nombre_interruption .'</td> ';                       
                        if (intval($formation->convention) === 1) {
                            $html .= '<td>convention</td>';
                        } else if (intval($formation->convention) === 2) {
                            $html .= '<td>hors convention</td>';
                        }          
    $html .= '    </tr>';
                    }
    $html .= '  </tbody>
            </table><br/></div><br/>';
	return $html;
}
add_shortcode('ild_affiche_la_liste_des_formations', 'affiche_les_formations_avec_delete_et_update');
/* 15/09/2020 Fin d'ajout de code Frédéric Prévot */