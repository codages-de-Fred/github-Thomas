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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php


/******************** affichage du formulaire de modification d'une ville ******************************************************* */

if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_VILLE) {
    $ID = $_REQUEST['ID'];?>
    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire de modification de la ville : </h2>
        <div>
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::UPDATE_VALID_VILLE; ?>" method="POST" class="validate">
                    <table class="form-table" role="presentation">
                    <tbody>
                        <tr class="form-field"> 
                            <td scope="row"><label for="ID">ID de la ville : </label></td>
                            <td><input type="text" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_ville" id='.$ID.' champ="ID"]' ); ?>" name="ID" style="max-width:100px !important;" readonly></td>
                        </tr>
                        <td scope="row">
                                <label for="ID_departement">Sélectionnez le département de la ville : </label>
                            </td>
                            <td>
                                <select name="ID_departement">
                                    <option value="<?php do_shortcode( '[affiche_valeur_champ table="ild_ville" id='.$ID.' champ="ID_departement"]' ); ?>"><?php do_shortcode( '[affiche_designation_departement id='.$ID.']' ); ?></option>
                                    <?php do_shortcode( "[affiche_select table='ild_departement']" ); ?>
                                </select>
                            </td>
                        <tr class="form-field">
                            <td scope="row"><label for="designation">Nom de la ville : </label></td>
                            <td><input type="text" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_ville" id='.$ID.' champ="designation"]' ); ?>" name="designation" style="max-width:200px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <td scope="row"><label for="slug">Slug de la ville : </label></td>
                            <td><input type="text" name="slug" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_ville" id='.$ID.' champ="slug"]' ); ?>" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <td scope="row"><label for="codepostal">Code postal de la ville : </label></td>
                            <td><input type="number" name="codepostal" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_ville" id='.$ID.' champ="codepostal"]' ); ?>" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <td scope="row"><label for="codeinsee">Code INSEE de la ville : </label></td>
                            <td><input type="text" name="codeinsee" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_ville" id='.$ID.' champ="codeinsee"]' ); ?>" style="max-width:100px !important;"></td>
                        </tr class="form-field">
                        <tr class="form-field">
                            <td scope="row"><label for="latitude">Latitude : </label></td>
                            <td><input type="text" name="latitude" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_ville" id='.$ID.' champ="latitude"]' ); ?>" style="max-width:200px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <td scope="row"><label for="longitude">Longitude : </label></td>
                            <td><input type="text" name="longitude" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_ville" id='.$ID.' champ="longitude"]' ); ?>" style="max-width:200px !important;"></td>
                        </tr>
                    </tbody>
                    </table>
                <div class="inline">
                    <input type="submit" value="Modifier" class="button button-primary">
                    </form>
                    <div class="marge">
                        <form action="?page=<?php echo $_REQUEST['page']; ?>" method="POST">
                            <input type="submit" value="Annuler" class="button button-primary">
                        </form>
                    </div>
                </div>
        </div>
    </div>
<?php 

/*************************** affichage du formulaire d'ajout d'une ville ******************************************************* */

} else if ($_REQUEST['action'] === Affuteo_Admin::AJOUTER_VILLE) { ?>

    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire d'ajout de ville : </h2>
            <div>
                <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::AJOUT_VALID_VILLE; ?>" method="POST" class="validate">
                    <table class="form-table" role="presentation">
                        <tbody>
                            <tr class="form-field">
                                <td scope="row">
                                    <label for="ID_departement">Sélectionnez le département de la ville : </label>
                                </td>
                                <td>
                                    <select name="ID_departement">
                                        <?php do_shortcode( "[affiche_select table='ild_departement']" ); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="form-field">
                                <td scope="row"><label for="designation">Nom de la ville : </label></td>
                                <td><input type="text" name="designation" style="max-width:200px !important;"></td>
                            </tr>
                            <tr class="form-field">
                                <td scope="row"><label for="slug">Slug de la ville : </label></td>
                                <td><input type="text" name="slug" style="max-width:100px !important;"></td>
                            </tr>
                            <tr class="form-field">
                                <td scope="row"><label for="codepostal">Code postal de la ville : </label></td>
                                <td><input type="number" name="codepostal"  style="max-width:100px !important;"></td>
                            </tr>
                            <tr class="form-field">
                                <td scope="row"><label for="codeinsee">Code INSEE de la ville : </label></td>
                                <td><input type="text" name="codeinsee" style="max-width:100px !important;"></td>
                            </tr>
                            <tr class="form-field">
                                <td scope="row"><label for="latitude">Latitude : </label></td>
                                <td><input type="text" name="latitude" style="max-width:200px !important;"></td>
                            </tr>
                            <tr class="form-field">
                                <td scope="row"><label for="longitude">Longitude : </label></td>
                                <td><input type="text" name="longitude" style="max-width:200px !important;"></td>
                            </tr>
                        </tbody>
                    </table>
                <div class="inline">
                    <input type="submit" name="submit_add" value="Ajouter" class="button button-primary">
                    </form>
                    <div class="marge">
                        <form action="?page=<?php echo $_REQUEST['page']; ?>" method="POST">
                            <input type="submit" value="Annuler" class="button button-primary">
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

<?php

/**************************************** affichage du tableau de villes ********************************************* */

} else { ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Liste des villes</h1>
        <a href="?page=<?php echo $_REQUEST["page"]; ?>&action=<?php echo Affuteo_Admin::AJOUTER_VILLE; ?>" class="page-title-action">Ajouter</a>
    </div>
    <div>
        <div class="div_inline_end">
            <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::SEARCH_VILLE; ?>" method="POST">
                    <label for="search_ville">Recherche de villes par numéro de département ou code postal : </label>
	                <label class="screen-reader-text" for="search_ville">Rechercher par département:</label>
	                <input type="search" id="search_ville" name="search_ville" value="<?php do_shortcode( '[afficher_session_search nom_session="departement_ou_codepostal"]' ); ?>">
	            	<input type="submit" id="button_search" name="button_search" class="button" value="Rechercher">
            </form>
            <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::RESET_SEARCH_VILLE; ?>" method="POST">
                <input type="submit" name="reset_search_ville" value="reset" class="button">
            </form>       
        </div>
    </div>
    <div class="wrap">
        <?php
        //affiche la table des villes
        do_shortcode( "[affiche_la_table_ville]");
        ?>
    </div>
<?php }

