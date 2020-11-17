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
    //récupère les page et action envoyés en paramètres url
    $page = $_POST['page'];
    $depart = $_POST['depart']; 
    $id_annonce = "";
    if (isset($_POST['id_annonce'])) {
        $id_annonce = $_POST['id_annonce']; 
    }
    
?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Sélectionnez le client dans la liste ci-dessous :</h1>

        <div class="wrap inline">

            <!--------------------------------- filtre recherche par nom du client -------------------------------------------->

            <form action="?page=annonces%2Fliste_clients&action=search_nom_client" method="POST">
                <label for="nom_client">Recherche par nom de client : </label>
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <input type="hidden" name="depart" value="<?php echo $depart; ?>">
                <input type="hidden" name="id_annonce" value="<?php echo $id_annonce; ?>">
                <input type="text" value="<?php echo $_SESSION['nom_client']; ?>" name="nom_client">
                <input type="submit" value="Rechercher" class="button">
            </form>
            <form action="?page=annonces%2Fliste_clients&action=reset_search_nom_client" method="POST" class="marge">
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <input type="hidden" name="depart" value="<?php echo $depart; ?>">
                <input type="hidden" name="id_annonce" value="<?php echo $id_annonce; ?>">
                <input type="submit" value="Reset" class="button">
            </form>
            
            <!--------------------------------- filtre recherche par mail du client -------------------------------------------> 
            
            <form action="?page=annonces%2Fliste_clients&action=search_mail_client" method="POST" class="marge">
                <label for="mail_client">Recherche par adresse mail de client : </label>
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <input type="hidden" name="depart" value="<?php echo $depart; ?>">
                <input type="hidden" name="id_annonce" value="<?php echo $id_annonce; ?>">
                <input type="text" value="<?php echo $_SESSION['mail_client']; ?>" name="mail_client">
                <input type="submit" value="Rechercher" class="button">
            </form>
            <form action="?page=annonces%2Fliste_clients&action=reset_search_mail_client" method="POST" class="marge">
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <input type="hidden" name="depart" value="<?php echo $depart; ?>">
                <input type="hidden" name="id_annonce" value="<?php echo $id_annonce; ?>">
                <input type="submit" value="Reset" class="button">
            </form>


        </div>

        <?php do_shortcode( '[affiche_la_table_client]' ); ?>
    </div>
