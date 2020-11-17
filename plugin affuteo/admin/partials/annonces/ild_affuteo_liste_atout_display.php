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
 * @subpackage Affuteo/admin/partials/annonces
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php 
/*************************** formulaire update atout ****************************************** */

if ($_REQUEST['action'] === Affuteo_Admin::UPDATE_ATOUT) {
    $id = $_REQUEST['ID']; ?>

    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire d'ajout d'un atout : </h2>
        <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::UPDATE_VALID_ATOUT; ?>" method="POST" class="validate">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr class="form-field"> 
                        <td scope="row"><label for="ID">ID de l'atout : </label></td>
                        <td><input type="text" value="<?php do_shortcode( '[affiche_valeur_champ table="ild_atout" id='.$id.' champ="ID"]' ); ?>" name="ID" style="max-width:100px !important;" readonly></td>
                    </tr>
                    <tr class="form-field">
                        <td scope="row"><label for="designation">Désignation</label></td>
                        <td><input type="text" name="designation" value="<?php do_shortcode( '[affiche_valeur_champ id='.$id.' table="ild_atout" champ="designation"]' ); ?>"></td>
                    </tr>
                </tbody>
            </table>
            <div class="inline">
                <input type="submit" name="submit_add" value="Modifier" class="button button-primary">
        </form>
                <div class="marge">
                    <form action="?page=<?php echo $_REQUEST['page']; ?>" method="POST">
                        <input type="submit" value="Annuler" class="button button-primary">
                    </form>
                </div>
            </div>
    </div>  

<?php 
/********************* formulaire ajout atout ************************************************* */

} else if ($_REQUEST['action'] === Affuteo_Admin::AJOUT_ATOUT) { ?>

    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire d'ajout de région : </h2>
        <form action="?page=<?php echo $_REQUEST['page']; ?>&action=<?php echo Affuteo_Admin::AJOUT_VALID_ATOUT; ?>" method="POST" class="validate">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr class="form-field">
                        <td scope="row"><label for="designation">Désignation</label></td>
                        <td><input type="text" name="designation"></td>
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
/******************** affichage de la liste des atouts ************************************************* */

} else { ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Liste des atouts</h1>
        <a href="?page=<?php echo $_REQUEST["page"]; ?>&action=<?php echo Affuteo_Admin::AJOUT_ATOUT; ?>" class="page-title-action">Ajouter</a>
        <?php //affiche la table des atouts
        do_shortcode( "[affiche_la_table_atout]"); ?>
    </div>

    <?php } ?>
    
    

