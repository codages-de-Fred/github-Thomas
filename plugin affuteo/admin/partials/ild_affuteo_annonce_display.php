<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       affuteo
 * @since      1.0.0
 *
 * @package    Affuteo
 * @subpackage Affuteo/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP -->

<?php
if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_ANNONCE) { 
    //séparation de la gestion de l'annonce en 3 formulaires : 1 pour le corps de l'annonce
                                                            // 1 pour ses photos
                                                            // 1 pour ajouter des photos
    $id = $_REQUEST['ID']; 
    $client_id = do_shortcode( '[retourne_valeur_champ table="ild_annonce" champ="ID_client" id='.$id.']' );
    $page = $_REQUEST['page'];
    $depart = $_REQUEST['action'];

    if ($_REQUEST['traitement'] === 'update_photo') { //si on a demandé de modifier la désignation d'une photo
        $id_annonce = $id;
        $id_photo = $_POST['id_photo'];
        $designation_photo = $_POST['designation_photo'];
        do_action( 'update_photo', $id_annonce, $id_photo, $designation_photo );
    }
    if ($_REQUEST['traitement'] === 'delete_photo') { //si on a demandé de supprimer une photo
        $id_annonce = $id;
        $id_photo = $_POST['id_photo'];
        do_action( 'delete_photo', $id_annonce, $id_photo );
    } 
    if ($_REQUEST['traitement'] === 'add_photo') { //si on a demandé d'ajouter une ou des photos
        $id_annonce = $id;
        $file = $_FILES['photo'];
        do_action( 'add_photo', $id_annonce, $file );
    }
    //pour l'ID_client
    if ($_POST['client_id']) {
        $client_id = $_POST['client_id'];
    }
    ?>
    
    <div class="wrap">
        <h1 class="wp-heading-inline">Modifier une annonce</h1>

        <!-- formulaire du corps de l'annonce -->
        <h2>Modifier l'annonce </h2>

        <table class="form-table" role="presentation">
            <tbody>

                <form action="?page=annonces%2Fliste_clients" method="POST">
                    <tr class="form-field">
                        <td class="row">
                            <label for="nom_client">Quel est le nom du client ?</label>
                        </td>
                        <td>
                            <input type="text" value="<?php do_shortcode( '[afficher_nom_client id='.$client_id.']' ); ?>" name="nom_client" readonly>
                            <input type="hidden" value="<?php echo $page; ?>" name="page">
                            <input type="hidden" value="<?php echo $depart; ?>" name="depart">
                            <input type="hidden" value="<?php echo $id; ?>" name="id_annonce">
                            <input type="submit" value="Modifier le client" class="button">
                        </td>
                    </tr>
                </form>

                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::UPDATE_VALID_ANNONCE; ?>" method="POST" class="validate">

                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">

                    <tr class="form-field">
                        <td scope="row">
                            <label for="annonce_verifiee">Annonce vérifiée</label>
                        </td>
                        <td>
                            <?php do_shortcode( '[afficher_checkbox_annonce_verifiee id='.$id.']' ); ?>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="id">ID de l'annonce</label></td>
                        <td><input type="text" name="id" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_annonce" champ="ID" id='.$id.']' ); ?> " readonly></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="type">Quel type de bien ? </label></td>
                        <td><select name="type">
                                <option value="<?php do_shortcode( '[affiche_valeur_champ table="ild_annonce" id='.$id.' champ="ID_ild_type_annonce"]' ); ?>"><?php do_shortcode( '[affiche_designation_type_annonce  id='.$id.']' ); ?></option>
                                <?php do_shortcode( '[affiche_select table="ild_type_annonce"]' ); ?>
                            </select>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="checkbox_atouts">Quels sont les atouts du bien ? </label></td>
                        <td>
                            <?php do_shortcode( '[affiche_atout_checkbox_checked id='.$id.']' ); ?>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="superficie_habitable">Superficie habitable</label></td>
                        <td><input type="number" placeholder="(facultatif)" name="superficie_habitable" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="superficie_habitable" table="ild_annonce"]' ); ?>"></td>
                        <td scope="row"><label for="superficie_terrain">Superficie du terrain</label></td>
                        <td><input type="number" placeholder="(facultatif)" name="superficie_terrain" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="superficie_terrain" table="ild_annonce"]' ); ?>"></td>
                    </tr>
                    <tr class="form-field">
                        <td scope="row"><label for="nombre_pieces">Nombres de pièces</label></td>
                        <td><input type="number" name="nombre_pieces" placeholder="(facultatif)" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="nombre_pieces" table="ild_annonce"]' ); ?>"></td>
                        <td scope="row"><label for="designation">Désignation </label></td>
                        <td><textarea name="designation" maxlength="250" placeholder="250 caractères maximum"><?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="designation" table="ild_annonce"]' ); ?></textarea></td>
                    </tr> 

                    <tr class="form-field">
                        <td scope="row"><label for="nombre_chambres" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="nombre_chambres" table="ild_annonce"]' ); ?>">Nombre de chambres</label></td>
                        <td><input type="number" placeholder="(facultatif)" name="nombre_chambres"></td>
                        <td scope="row"><label for="budget" >Budget</label></td>
                        <td><input type="number" name="budget" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="budget" table="ild_annonce"]' ); ?>"></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="designation_longue">Description de l'annonce</label></td>
                        <td><textarea name="designation_longue" placeholder="Entrez la description de l'annonce"><?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="designation_longue" table="ild_annonce"]' ); ?></textarea></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="adresse_1">Adresse 1</label></td>
                        <td><input type="text" name="adresse_1" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="adresse_1" table="ild_annonce"]' ); ?>"></td>
                        <td scope="row"><label for="adresse_2">Adresse 2</label></td>
                        <td><input type="text" name="adresse_2" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="adresse_2" table="ild_annonce"]' ); ?>"></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="adresse_3">Ville</label></td>
                        <td>
                            <select name="adresse_3">
                                <option value="<?php do_shortcode( '[affiche_valeur_champ table="ild_annonce" id='.$id.' champ="ID_ild_ville"]'); ?>"><?php do_shortcode( '[affiche_designation_ville id='.$id.']' ); ?></option>
                                <?php do_shortcode( '[affiche_select table="ild_ville"]' ); ?>
                            </select>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="hors_frais_notaire">Hors frais de notaire</label></td>
                        <td><?php do_shortcode( '[affiche_visible_checkbox_checked id='.$id.' champ="hors_frais_notaire"]' ); ?></td>
                    </td>

                    <tr class="form-field">
                        <td scope="row"><label for="classe_energie">Classe énergie</label></td>
                        <td>
                            <?php do_shortcode('[affiche_radio_checked energie="classe_energie" id='.$id.']'); ?>
                        </td>
                        <td scope="row"><label for="GES">GES</label></td>
                        <td>
                            <?php do_shortcode('[affiche_radio_checked energie="GES" id='.$id.']'); ?>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="telephone">Numéro de téléphone</label></td>
                        <td><input type="tel" name="telephone" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="telephone" table="ild_annonce"]' ); ?>"></td>
                        <?php do_shortcode( '[affiche_visible_checkbox_checked id='.$id.' champ="telephone_visible"]' ); ?>
                        <td><label for="telephone_visible">Numéro de téléphone visible</label></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="mail">Adresse mail</label></td>
                        <td><input type="email" name="mail" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' champ="mail" table="ild_annonce"]' ); ?>"></td>
                        <?php do_shortcode( '[affiche_visible_checkbox_checked id='.$id.' champ="mail_visible"]' ); ?>
                        <td><label for="mail_visible">Adresse mail visible</label></td>
                    </tr>
        </tbody>
    </table>

            <div class="inline">
                <input type="submit" value="Modifier" class="button button-primary">
        <!--formulaire du bouton annuler qui renvoi le tableau des annonces -->
            </form>
                <div class="marge">
                    <form action="?page=<?php echo $_REQUEST['page']; ?>" method="POST">
                        <input type="submit" value="Annuler" class="button button-primary">
                    </form>
                </div>
            </div>
        <!--formulaire de gestion des photos de l'annonce -->
        <h2>Modifier les photos de l'annonce</h2>
        <div class="wrap">
            <table class="form-table" role="presentation">
                <?php do_shortcode( '[afficher_photos_annonce id='.$id.']' ); ?>
            </table>
        </div>

        <!-- ajouter des photos -->
        <div class="ajout_photo_update">
            <h2>Ajouter des photos</h2>
            <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::UPDATE_ANNONCE; ?>&ID=<?php echo $_REQUEST['ID']; ?>&traitement=add_photo" method="POST" class="validate" enctype="multipart/form-data">
                <label for="photo[]">Sélectionner les photos à ajouter </label>
                <input type="file" name="photo[]" multiple>
                <input type="submit" value="Ajouter" class="button button-primary">
            </form>
        </div>
    </div>

        <!----------------- ajouter une annonce -------------------------------------------------->

<?php } else if ($_REQUEST['action'] === Affuteo_Admin::AJOUTER_ANNONCE) {
    //récupère les globales request pour les envoyer en paramètres pour le choix du client
    $page = $_REQUEST['page'];
    $depart = $_REQUEST['action']; //$depart car action est un mot clef
    $client_id = ""; //ID du client 
    if (isset($_POST['client_id'] )) {
        $client_id = $_POST['client_id'];
    } ?>
    
    <div class="wrap">
        <h1 class="wp-heading-inline">Ajouter une annonce</h1>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr class="form-field">
                    <td class="row">
                        <label for="nom_client">Quel est le nom du client ?</label>
                    </td>
                    <td>
                        <form action="?page=annonces%2Fliste_clients" method="POST">
                            <input type="text" value="<?php do_shortcode( '[afficher_nom_client id='.$client_id.']' ); ?>" name="nom_client" readonly>
                            <input type="hidden" value="<?php echo $page; ?>" name="page">
                            <input type="hidden" value="<?php echo $depart; ?>" name="depart">
                            <input type="submit" value="Recherche du client" class="button">
                        </form>
                        </td>
                    </tr>
        
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::AJOUT_VALID_ANNONCE; ?>" method="POST" class="validate" enctype="multipart/form-data">                

                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">

                    <tr class="form-field">
                        <td scope="row">
                            <label for="annonce_verifiee">Annonce vérifiée</label>
                        </td>
                        <td>
                            <input type="checkbox" name="annonce_verifiee">
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="type">Quel type de bien ? </label></td>
                        <td><select name="type">
                                <?php do_shortcode( '[affiche_select table="ild_type_annonce"]' ); ?>
                            </select>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="checkbox_atouts">Quels sont les atouts du bien ? </label></td>
                        <td>
                            <?php do_shortcode( '[affiche_atout_checkbox]' ); ?>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="superficie_habitable">Superficie habitable</label></td>
                        <td><input type="number" placeholder="(facultatif)" name="superficie_habitable"></td>
                        <td scope="row"><label for="superficie_terrain">Superficie du terrain</label></td>
                        <td><input type="number" placeholder="(facultatif)" name="superficie_terrain"></td>
                    </tr>
                    <tr class="form-field">
                        <td scope="row"><label for="nombre_pieces">Nombres de pièces</label></td>
                        <td><input type="number" placeholder="(facultatif)" name="nombre_pieces"></td>
                        <td scope="row"><label for="designation">Désignation </label></td>
                        <td><textarea name="designation" maxlength="250" placeholder="250 caractères maximum"></textarea></td>
                    </tr> 

                    <tr class="form-field">
                        <td scope="row"><label for="nombre_chambres">Nombre de chambres</label></td>
                        <td><input type="number" placeholder="(facultatif)" name="nombre_chambres"></td>
                        <td scope="row"><label for="budget">Budget</label></td>
                        <td><input type="number" name="budget"></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="designation_longue">Description de l'annonce</label></td>
                        <td><textarea name="designation_longue" placeholder="Entrez la description de l'annonce"></textarea></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="adresse_1">Adresse 1</label></td>
                        <td><input type="text" name="adresse_1"></td>
                        <td scope="row"><label for="adresse_2">Adresse 2</label></td>
                        <td><input type="text" name="adresse_2"></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="adresse_3">Adresse 3</label></td>
                        <td>
                            <select name="adresse_3">
                                <?php do_shortcode( '[affiche_select table="ild_ville"]' ); ?>
                            </select>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="hors_frais_notaire">Hors frais de notaire</label></td>
                        <td><input type="checkbox" name="hors_frais_notaire"></td>
                    </td>

                    <tr class="form-field">
                        <td scope="row"><label for="classe_energie">Classe énergie</label></td>
                        <td>
                            <?php do_shortcode( '[affiche_radio energie="classe_energie"]' ); ?>
                        </td>
                        <td scope="row"><label for="ges">GES</label></td>
                        <td>
                        <?php do_shortcode( '[affiche_radio energie="GES"]' ); ?>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="telephone">Numéro de téléphone</label></td>
                        <td><input type="tel" name="telephone"></td>
                        <td scope="row"><input type="checkbox" name="telephone_visible" checked>
                        <label for="telephone_visible">Numéro de téléphone visible</label></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="mail">Adresse mail</label></td>
                        <td><input type="email" name="mail"></td>
                        <td scope="row"><input type="checkbox" name="mail_visible" checked>
                        <label for="mail_visible">Adresse mail visible</label></td>
                    </tr>

                    <tr class="form-field">
                        <td scope="row"><label for="photos">Ajouter des photos</label></td>
                        <td><input type="file" name="photo[]" multiple></td>
                    </tr>

                </tbody>
            </table>
            <div class="inline">
                <input type="submit" value="Ajouter" class="button button-primary">
        </form>
            <div class="marge">
                    <form action="?page=<?php echo $_REQUEST['page']; ?>" method="POST">
                        <input type="submit" value="Annuler" class="button button-primary">
                    </form>
                </div>
            </div>
</div>

<!----------------------------- affichage du tableau des annonces ---------------------------------------------->

<?php } else { ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">Liste des annonces</h1>
            <a href="?page=<?php echo $_REQUEST["page"]; ?>&action=<?php echo Affuteo_Admin::AJOUTER_ANNONCE; ?>" class="page-title-action">Ajouter</a>
        </div>
        <div class="wrap">

            <!-------------------------------- filtre recherche par département ou code postal --------------------------------->

            <div class="div_inline_end">
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::SEARCH_VILLE; ?>" method="POST">
                        <label for="search_ville">Recherche de villes par numéro de département ou code postal : </label>
	                    <input type="search" id="search_ville" name="search_ville" value="<?php do_shortcode( '[afficher_session_search nom_session="departement_ou_codepostal"]' ); ?>">
	                	<input type="submit" id="button_search" name="button_search" class="button" value="Rechercher">
                </form>
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::RESET_SEARCH_VILLE; ?>" method="POST" class="marge">
                    <input type="submit" name="reset_search_ville" value="Reset" class="button">
                </form>       
            </div>

                <!--------------------------------- filtre recherche par annonce à vérifier --------------------------------------->
            <div class="wrap inline">
                <ul class="subsubsub">
	                <li class="all">
                        <a href="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::RESET_SEARCH_ANNONCE_A_VERIFIER; ?>" class="current" aria-current="page">
                            Toutes <span class="count">(<?php do_shortcode( '[compteur_total_annonces]' ); ?>)</span>
                        </a>
                         |
                    </li>
	                <li class="publish">
                        <a href="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::SEARCH_ANNONCE_A_VERIFIER; ?>">
                            Annonces à vérifier <span class="count">(<?php do_shortcode( '[compteur_annonces_a_verifier]' ); ?>)</span>
                        </a>
                         |
                    </li>
                </ul>
                <br/>
            </div>

                <!------------------------------- filtre recherche par type d'annonce ----------------------------------------------->
            <div class="wrap inline">

                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::SEARCH_TYPE; ?>" method="POST">
                    <label for="search_type">Recherche par type d'annonce : </label>
                    <select name="search_type">
                        <option value="<?php do_shortcode( '[afficher_nom_session nom_session="type_annonce"]' ); ?>"><?php do_shortcode('[afficher_designation_session_type_annonce]'); ?></option>
                        <?php do_shortcode( '[affiche_select table="ild_type_annonce"]' ); ?>
                    </select>
                    <input type="submit" value="Rechercher" class="button">
                </form>
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::RESET_SEARCH_TYPE; ?>" method="POST" class="marge">
                    <input type="submit" name="reset_search_type" value="Reset" class="button">
                </form>

                <!-------------------------------- filtre recherche par rôle d'utilisateur -------------------------------------------> 

                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::SEARCH_ROLE; ?>" method="POST" class="marge">
                    <label for="role">Recherche par rôle d'utilisateur : </label>
                    <select name="role">
                        <option value=""><?php echo translate_user_role($_SESSION['role']); ?></option> <!-- traduction du rôle dans la langue du site -->
                        <?php do_shortcode('[afficher_roles]'); ?>
                    </select>
                    <input type="submit" value="Rechercher" class="button">
                </form>
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::RESET_SEARCH_ROLE; ?>" method="POST" class="marge">
                    <input type="submit" value="Reset" class="button">
                </form>
            </div>



                <!--------------------------------- filtre recherche par nom du client --------------------------------------------> 
            <div class="wrap inline">

                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::SEARCH_NOM_CLIENT; ?>" method="POST">
                    <label for="nom_client">Recherche par nom de client : </label>
                    <input type="text" value="<?php echo $_SESSION['nom_client']; ?>" name="nom_client">
                    <input type="submit" value="Rechercher" class="button">
                </form>
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::RESET_SEARCH_NOM_CLIENT; ?>" method="POST" class="marge">
                    <input type="submit" value="Reset" class="button">
                </form>

                <!--------------------------------- filtre recherche par mail du client -------------------------------------------> 

                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::SEARCH_MAIL_CLIENT; ?>" method="POST" class="marge">
                    <label for="mail_client">Recherche par adresse mail de client : </label>
                    <input type="text" value="<?php echo $_SESSION['mail_client']; ?>" name="mail_client">
                    <input type="submit" value="Rechercher" class="button">
                </form>
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::RESET_SEARCH_MAIL_CLIENT; ?>" method="POST" class="marge">
                    <input type="submit" value="Reset" class="button">
                </form>


            </div>
        </div>

        <div class="wrap">
            <?php //affiche la table des annonces
            do_shortcode( "[affiche_la_table_annonce]"); ?>
        </div>

<?php } ?>