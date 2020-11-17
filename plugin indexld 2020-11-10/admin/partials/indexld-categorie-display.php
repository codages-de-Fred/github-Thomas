<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.indexld.com
 * @since      1.0.0
 *
 * @package    Indexld
 * @subpackage Indexld/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
/*************** affichage du formulaire update ********************************************** */

if ($_REQUEST['action'] == 'update_categorie') {
    $id = $_REQUEST['id']; ?>

    <h2 class="wp-heading-inline">Formulaire de modification de catégorie </h2>
            
    <form action="?page=<?php echo $_REQUEST["page"]; ?>&action=update_categorie_valid" method="POST">
        <p>
            <label class="textinput">ID de la catégorie : </label> 
            <input value="<?php echo $id; ?>" name="id" readonly  class="textinput">
            <br class="clear">
        </p>
        <p>
            <label for="nom" class="textinput">Nom de la catégorie : </label>
            <input type="text" value="<?php do_shortcode( '[afficher_nom_categorie id="'.$id.'"]' ); ?>" name="nom" id="nom" class="textinput" size="60">
            <br class="clear">
        </p>
        <div class="inline">
        
            <input type="submit" name="submit_update" value="modifier" class="button button-primary">
        
    </form>
    <form action="?page=<?php echo $_REQUEST["page"]; ?>" method="POST" class="marge_left">
        <input type="submit" value="Annuler" class="button button-primary">
    </form>
        </div>
   
<?php 

/************  affichage du formulaire d'ajout ********************************************************************************************/

} else if ($_REQUEST['action'] === 'add_categorie') { ?>
    <div class="wrap">
        <h2 class="wp-heading-inline">Formulaire d'ajout de catégorie</h2>

        <form action="?page=<?php echo $_REQUEST["page"]; ?>&action=add_categorie_valid" method="POST">
            <p>
                <label for="nom" class="textinput">Nom de la catégorie : </label>
                <input type="text" name="nom" id="nom" size="60" class="textinput">
            </p>
            
            <div class="inline">
            <input type="submit" name="submit_add" value="Ajouter" class="button button-primary">
        </form>
        <form action="?page=<?php echo $_REQUEST["page"]; ?>" class="marge_left" method="POST">
            <input type="submit" value="Annuler" class="button button-primary">
        </form>
            </div>
    </div>
            
       
<?php 

/************  le tableau des catégories ****************************************************************************************************/

} else { ?>

<div class="wrap">
    <h1 class="wp-heading-inline">Liste des catégories</h1>
    <a href="?page=<?php echo $_REQUEST['page']; ?>&action=add_categorie" class="page-title-action">Ajouter</a>
    <?php do_shortcode( '[afficher_la_table_categorie]' ); ?>
</div>

<?php } ?>       
