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


/******************** affichage du formulaire de modification d'un departement ******************************************************* */

if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_DEPARTEMENT) {
    $ID = $_REQUEST['ID'];?>
    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire de modification du département : </h2>
        <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::UPDATE_VALID_DEPARTEMENT; ?>" method="POST" class="validate">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr class="form-field"> 
                        <td scope="row"><label for=ID>ID du département : </label></td>
                        <td><input type="text" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_departement" id='.$ID.' champ="ID"]' ); ?>" name="ID" style="max-width:100px !important;" readonly></td>
                    </tr>
                    <tr class="form-field">
                        <td scope="row"><label for="ID_region">Sa région : </label></td>
                        <td><select name="ID_region">
                            <option value="<?php do_shortcode( '[affiche_valeur_champ table="ild_departement" id='.$ID.' champ="ID_region"]' ); ?>"><?php do_shortcode( '[afficher_designation_region id='.$ID.']' ); ?></option>
                            <?php do_shortcode( '[affiche_select table="ild_region"]' ); ?>
                        </select></td>
                    </tr>
                    <tr class="form-field">
                        <td scope="row"><label for="designation">Nom du département : </label></td>
                        <td><input type="text" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_departement" id='.$ID.' champ="designation"]' ); ?>" name="designation" style="max-width:200px !important;"></td>
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
<?php 

/*************************** affichage du formulaire d'ajout d'une ville ******************************************************* */

} else if ($_REQUEST['action'] === Affuteo_Admin::AJOUTER_DEPARTEMENT) { ?>

    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire d'ajout de département : </h2>
        <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::AJOUT_VALID_DEPARTEMENT; ?>" method="POST" class="validate">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr class="form-field">
                        <td scope="row"><label for="ID_region">Sa région : </label></td>
                        <td><select name="ID_region">
                            <?php do_shortcode( '[affiche_select table="ild_region"]' ); ?>
                        </select></td>
                    </tr>
                    <tr class="form-field">
                        <td scope="row"><label for="designation">Nom du département : </label></td>
                        <td><input type="text" name="designation" style="max-width:200px !important;"></td>
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

<?php

/**************************************** affichage du tableau de départements ********************************************* */

} else { ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Liste des départements</h1>
        <a href="?page=<?php echo $_REQUEST["page"]; ?>&action=<?php echo Affuteo_Admin::AJOUTER_DEPARTEMENT; ?>" class="page-title-action">Ajouter</a>
    </div>
    <div class="wrap">
        <div class="div_inline_end">
            <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::SEARCH_DEPARTEMENT; ?>" method="POST">
                <label for="search_departement">N'afficher que les départements de la région : </label>
                <select name="search_departement" id="search_departement">
                    <option value=""><?php do_shortcode( '[afficher_session_designation_region]'); ?></option>
                    <?php do_shortcode( '[affiche_select table="ild_region"]' ); ?>
                </select>
                <input type="submit" name="submit_search_departement" id="submit_search_departement" class="button" value="Rechercher">
            </form>
            <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::RESET_SEARCH_DEPARTEMENT; ?>" method="POST">
                <input type="submit" class="button" value="reset">
            </form>
        </div>
    </div>
    <div class="wrap">
        <?php
        //affiche la table des ville
        do_shortcode( "[affiche_la_table_departement]");
    ?>
    </div>
    

<?php }

