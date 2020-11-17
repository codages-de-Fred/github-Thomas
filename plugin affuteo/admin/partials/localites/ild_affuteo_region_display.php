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

/******************** affichage du formulaire de modification d'une region ******************************************************* */

if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_REGION) {
    $ID = $_REQUEST['ID'];?>
    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire de modification de la région : </h2>
        <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::UPDATE_VALID_REGION; ?>" method="POST" class="validate">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr class="form-field"> 
                        <td scope="row"><label for="ID">ID de la région : </label></td>
                        <td><input type="text" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_region" id='.$ID.' champ="ID"]' ); ?>" name="ID" style="max-width:100px !important;" readonly></td>
                    </tr>
                    <tr class="form-field">
                        <td scope="row"><label for="designation">Nom de la région : </label></td>
                        <td><input type="text" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_region" id='.$ID.' champ="designation"]' ); ?>" name="designation" style="max-width:300px !important;"></td>
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

} else if ($_REQUEST['action'] === Affuteo_Admin::AJOUTER_REGION) { ?>

    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire d'ajout de région : </h2>
        <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::AJOUT_VALID_REGION; ?>" method="POST" class="validate">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr class="form-field">
                        <td scope="row"><label for="designation">Nom de la région : </label></td>
                        <td><input type="text" name="designation" style="max-width:300px !important;"></td>
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

/**************************************** affichage du tableau de régions ********************************************* */

} else { ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Liste des régions</h1>
        <a href="?page=<?php echo $_REQUEST["page"]; ?>&action=<?php echo Affuteo_Admin::AJOUTER_REGION; ?>" class="page-title-action">Ajouter</a>
        <?php
        //affiche la table des régions
        do_shortcode( "[affiche_la_table_region]");
        ?>
    </div>
<?php }

