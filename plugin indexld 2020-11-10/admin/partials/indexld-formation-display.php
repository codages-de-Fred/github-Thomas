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

/********************** affichage du formulaire update ******************************************************************* */
/**
 * la super global $_REQUEST activée par le lien 'modifier' dans son href de la classe wp_list_table
 */
if ($_REQUEST['action'] === 'update_formation') { 
    $id = $_REQUEST['id'];
?>
    <div class="wrap">
        <form action="?page=<?php echo $_REQUEST["page"]; ?>&action=update_formation_valid" method="POST" class="validate" > 

        <h2 class="wp-heading-inline">Formulaire de modification de formation </h2>

        <table class="form-table" role="presentation">
            <tbody>
                <tr class="form-field"> 
                    <td scope="row"><label for="id">ID de la formation : </label></td>
                    <td><input type="text" value="<?php echo $id; ?>" name="id" style="max-width:100px !important;" readonly></td>
                </tr>
                <tr class="form-field">                
                    <th scope="row"><label for="categorie_id">Sélectionnez la catégorie correspondante : </label></th>
                    <td><select name="categorie_id" id="categorie_id">
                        <?php do_shortcode( '[afficher_la_premiere_option_update_formation_select_categorie id='.$id.']' ); ?>
                        <?php do_shortcode( '[afficher_option_select_liste_categories]' ); ?>
                    </select></td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row"><label for="client">Entrez le nom du client <span class="description">(nécessaire)</span> : </label></th>
                    <td><input type="text" name="client" style="max-width:400px !important;" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="client"]' ); ?>"></td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row"><label for="annee">Entrez l\'année de la formation : </label></th>    
                    <td><input type="number" min="0" max="3000" name="annee" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="annee"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="remarque">Entrez la (ou les) remarque du formateur sur la formation : </label></th>
                    <td><textarea name="remarque" style="max-width:400px !important;"><?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="remarque"]' ); ?></textarea></td> 
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="nombre_stagiaires">Entrez le nombre de stagiaires : </label></th>
                    <td><input type="number" name="nombre_stagiaires" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="nombre_stagiaires"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="nombre_reponse_questionnaire">Entrez le nombre de réponses au questionnaire : </label></th>
                    <td><input type="number" name="nombre_reponse_questionnaire" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="nombre_reponse_questionnaire"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="note_generale">Entrez la note générale : </label></th>
                    <td><input type="number" step="0.1" min="0" max="10" name="note_generale" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="note_generale"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="note_contenu_formation">Entrez la note sur le contenu de la formation : </label></th>
                    <td><input type="number" step="0.1" min="0" max="10" name="note_contenu_formation" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="note_contenu_formation"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="note_formateur_comprehensible">Entrez la note sur la compréhensibilté du formateur : </label></th>
                    <td><input type="number" step="0.1" min="0" max="10" name="note_formateur_comprehensible" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="note_formateur_comprehensible"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="note_formateur_questions">Entrez la note des réponses aux questions au formateur : </label></th>
                    <td><input type="number" step="0.1" min="0" max="10" name="note_formateur_questions" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="note_formateur_questions"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="note_formateur_adaptation">Entrez la note sur l\'adaptabilité du formateur : </label></th>
                    <td><input type="number" step="0.1" min="0" max="10" name="note_formateur_adaptation" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="note_formateur_adaptation"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="note_lieu_adapte">Entrez la note sur l\'adaptabilité du lieu : </label></th>
                    <td><input type="number" step="0.1" min="0" max="10" name="note_lieu_adapte" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="note_lieu_adapte"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="note_materiel">Entrez la note du matériel : </label></th>
                    <td><input type="number"  step="0.1" min="0" max="10" name="note_materiel" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="note_materiel"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="remarque_et_suggestion">Entrez les remarques et suggestions des stagiaires : </label></th>
                    <td><textarea style="max-width:400px !important;" name="remarque_et_suggestion"><?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="remarque_et_suggestion"]' ); ?></textarea></td> 
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="nombre_abandon">Entrez le nombre d\'abandons à cette formation : </label></th>
                    <td><input type="number" name="nombre_abandon" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="nombre_abandon"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="cause_abandon">Entrez la cause de l'abandon : </label></th>
                    <td><textarea style="max-width:400px !important;" name="cause_abandon"><?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="cause_abandon"]' ); ?></textarea></td> 
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="nombre_interruption">Entrez le nombre d'interruptions : </label></th>
                    <td><input type="number" name="nombre_interruption" value="<?php do_shortcode( '[afficher_les_valeurs_input_update_formation id="'.$id.'" champ="nombre_interruption"]' ); ?>" style="max-width:100px !important;"></td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="convention">Sélectionnez le mode de convention de la formation : </label></th>
                    <td><select name="convention" id="convention">
                        <?php do_shortcode( '[afficher_la_premiere_option_update_formation_convention id='.$id.']' ); ?>
                        <option value="1">Formation conventionnée</option>
                        <option value="0">Formation hors convention</option>
                    </select></td>   
                </tr>
            </tbody>
        </table> 
                <div class="inline">
                    <input type="submit" name="submit_update" value="Modifier" class="button button-primary">
                    </form>
                    <form action="?page=<?php echo $_REQUEST["page"]; ?>" method="POST" class="marge_left">
                        <input type="submit" class="button button-primary" value="Annuler">
                    </form>
                </div>
                
    </div>

<?php
/***************************** affichage du formulaire ajout ****************************************************************** */
/**
 * la super global $_REQUEST activée par le lien 'ajouter' du bouton 'ajouter' dans son href
 * le return permet de bloquer les autres affichages suivants
 */
} else if ($_REQUEST['action'] === 'add_formation') {  
?>

        <div class="wrap">
            <form action="?page=<?php echo $_REQUEST["page"]; ?>&action=add_formation_valid" method="POST" class="validate"  > 

            <h2 class="wp-heading-inline">Formulaire d\'ajout de formation</h2>

                <table class="form-table" role="presentation" >
                    <tbody>
                        <tr class="form-field form-required">                
                            <th scope="row"><label for="categorie_id">Sélectionnez la catégorie correspondante <span class="description">(nécessaire)</span> : </label></th>
                            <td><select name="categorie_id" id="categorie_id">';
                            <?php do_shortcode( '[afficher_option_select_liste_categories]' ); ?>
                        </tr>
                        <tr class="form-field form-required">
                            <th scope="row"><label for="client">Entrez le nom du client <span class="description">(nécessaire)</span> : </label></th>
                            <td><input type="text" name="client" style="max-width:400px !important;"></td>
                        </tr>
                        <tr class="form-field form-required">
                            <th scope="row"><label for="annee">Entrez l\'année de la formation <span class="description">(nécessaire)</span> : </label></th>    
                            <td><input type="number" name="annee" min="1900" max="3000" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="remarque">Entrez la (ou les) remarque du formateur sur la formation : </label></th>
                            <td><textarea style="max-width:400px !important;" name="remarque"></textarea></td> 
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="nombre_stagiaires">Entrez le nombre de stagiaires : </label></th>
                            <td><input type="number" value="" name="nombre_stagiaires" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="nombre_reponse_questionnaire">Entrez le nombre de réponses au questionnaire : </label></th>
                            <td><input type="number" value="" name="nombre_reponse_questionnaire" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="note_generale">Entrez la note générale : </label></th>
                            <td><input type="number" value="" step="0.1" min="0" max="10" name="note_generale" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="note_contenu_formation">Entrez la note sur le contenu de la formation : </label></th>
                            <td><input type="number" value="" step="0.1" min="0" max="10" name="note_contenu_formation" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="note_formateur_comprehensible">Entrez la note sur la compréhensibilté du formateur: </label></th>
                            <td><input type="number" value="" step="0.1" min="0" max="10" name="note_formateur_comprehensible" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="note_formateur_questions">Entrez la note des réponses aux questions au formateur : </label></th>
                            <td><input type="number" value="" step="0.1" min="0" max="10" name="note_formateur_questions" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="note_formateur_adaptation">Entrez la note sur l\'adaptabilité du formateur : </label></th>
                            <td><input type="number" value="" step="0.1" min="0" max="10" name="note_formateur_adaptation" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="note_lieu_adapte">Entrez la note sur l\'adaptabilité du lieu : </label></th>
                            <td><input type="number" value="" step="0.1" min="0" max="10" name="note_lieu_adapte" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="note_materiel">Entrez la note du matériel : </label></th>
                            <td><input type="number" value="" step="0.1" min="0" max="10" name="note_materiel" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="remarque_et_suggestion">Entrez les remarques et suggestions des stagiaires : </label></th>
                            <td><textarea style="max-width:400px !important;" name="remarque_et_suggestion"></textarea></td> 
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="nombre_abandon">Entrez le nombre d\'abandons à cette formation : </label></th>
                            <td><input type="number" name="nombre_abandon" style="max-width:100px !important;"></td>
                            <tr><td></td><td><p class="desc label">Veuillez entrer un nombre entier</p></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="cause_abandon">Entrez la cause de l\'abandon : </label></th>
                            <td><textarea style="max-width:400px !important;" name="cause_abandon"></textarea></td> 
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="nombre_interruption">Entrez le nombre d\'interruptions : </label></th>
                            <td><input type="number" name="nombre_interruption" style="max-width:100px !important;"></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="convention">Sélectionnez le mode de convention de la formation : </label></th>
                            <td><select name="convention" id="convention">
                                <option value="1">Formation conventionnée</option>
                                <option value="0">Formation hors convention</option>
                            </select></td>   
                        </tr>
                    </tbody>
                </table> 
                <p class="submit">
                    <input type="submit" name="submit_add" value="ajouter" class="button button-primary">
                    <button class="button button-primary"><a href="?page=<?php echo $_REQUEST["page"]; ?>" style="color:white; text-decoration:none;">annuler</a></button>
                </p>  
        </form>
    </div>

<?php } else { ?>  
        <!-- affichage HTML avec les classes de wordpress  -->
        
    <div class="wrap">
        <h1 class="wp-heading-inline">Liste des formations</h1>';

        <!-- bouton ajouter : ajoute une nouvelle formation -->

        <a href="?page=<?php echo $_REQUEST["page"]; ?>&action=add_formation" class="page-title-action">Ajouter</a><br/><hr/>

        <!-- checkboxs d'affichage des colonnes manquantes -->

        <div class="wrap">
            <h3>Affichage des colonnes manquantes</h3>
            <form action="?page=<?php echo $_REQUEST["page"]; ?>" method="POST">
                <table class="form-table">

                    <tr class="form-field">  
                        <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="remarque"]' ); ?>
                        <label for="remarque">Remarque</label>    
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="nombre_stagiaires"]' ); ?>
                        <label for="nombre_stagiaires">Nombre de stagiaires</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="note_contenu_formation"]' ); ?>
                        <label for="note_contenu_formation">Note sur le contenu de la formation</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="note_formateur_comprehensible"]' ); ?>
                        <label for="note_formateur_comprehensible">Note sur la compréhensibilité du formateur</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="note_formateur_questions"]' ); ?>
                        <label for="note_formateur_questions">Note des réponses aux questions</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="note_formateur_adaptation"]' ); ?>
                        <label for="note_formateur_adaptation">Note adaptabilité du formateur</label>
                    </td>
                </tr> 
                <tr class="form-field">
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="note_lieu_adapte"]' ); ?>
                        <label for="note_lieu_adapte">Note adaptabilité du lieu</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="note_materiel"]' ); ?>
                        <label for="note_materiel">Note du matériel</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="remarque_et_suggestion"]' ); ?>
                        <label for="remarque_et_suggestion">Remarque et suggestion</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="nombre_abandon"]' ); ?>
                        <label for="nombre_abandon">Nombre d\'abandon</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="cause_abandon"]' ); ?>
                        <label for="cause_abandon">Cause abandon</label>
                    </td>
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="nombre_interruption"]' ); ?>
                        <label for="nombre_interruption">Nombre d\'interruption</label>
                    </td>
                </tr>
                <tr> 
                    <td scope="row">
                        <?php do_shortcode( '[afficher_les_checkboxes_filtres name="date_de_mise_a_jour"]' ); ?>
                        <label for="date_de_mise_a_jour">Date de mise à jour</label>
                    </td>
                </tr>

            </table>
            <div class="div_inline">
                <input type="submit" name="checkboxes" value="Afficher" class="button">
                </form>
                <form action="?page=<?php echo $_REQUEST["page"]; ?>" method="POST" class="form_reset">
                    <input type="submit" class="button" value="reset" name="reset_checkboxes">
                </form>
            </div>
        </div>
              

    <!-- formulaire pour les filtres (par catégorie, convention, client et date) -->

    <!--
     * les filtres sont placés dans un formulaire post
     * l'action contient les globales page (adresse de la page), action (actions en cours) si existante
     -->
        
        <h3>Affichage par filtres</h3>
        <form action="?page=<?php echo $_REQUEST["page"]; ?>" method="POST">  
            <div class="tablenav top">
                <div class="alignleft actions">

                    <select name="categorie_id">
                        <?php do_shortcode('[afficher_les_options_filtre_par_categorie]'); ?>
                    </select>

                    <select name="convention">
                        <?php do_shortcode( '[afficher_la_premiere_option_filtre_par_convention]' ); ?>
                        <option value="1">Conventionné</option> 
                        <option value="0">Hors convention</option> 
                    </select>

                    <select name="client">
                        <?php do_shortcode( '[afficher_les_options_filtre_client]' ); ?>
                    </select>

                    <select name="annee_min">
                        <?php do_shortcode( '[afficher_les_options_filtre_annee_min]' ); ?>
                    </select>

                    <select name="annee_max">
                        <?php do_shortcode( '[afficher_les_options_filtre_annee_max]' ); ?>
                    </select>
                    
                    <div class="div_inline">
                        <input type="submit" class="button" value="Filtrer" name="filtre">
        </form>
                        <form action="?page=<?php echo $_REQUEST["page"]; ?>" method="POST" class="form_reset">
                            <input type="submit" class="button" value="reset" name="reset_filtre">
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <!-- affichage de la table formation --> 

    <div class="wrap">
        <?php do_shortcode( '[afficher_la_table_formation]' ); ?>
    </div>

    <!-- bouton pour exporter les données au format csv -->

    <div class="wrap">
        <h3>Exporter les données des formations au format CSV</h3>
        <a href="?page=<?php echo $_REQUEST["page"]; ?>&action=export_fichier_csv" class="page-title-action">Transformer en csv</a>
    </div>

    <!-- formulaire des modifications via un téléchargement d'un fichier CSV -->

      <!--
       * pour modifier la couleur de police de l'input de type file
       * je le cache de l'affichage et ajoute un autre bouton et son label gérés en javascript
      -->
   
    <div class="danger">
        <h3 class="danger">Modifications des formations via un fichier excel en csv</h3>
        <p>Attention, cette action supprimera les données actuelles !</p>
        <form action="?page=<?php echo REQUEST["page"]; ?>&action=import_fichier_csv" method="post" enctype="multipart/form-data" >
            <input type="file" name="fichier" class="danger" id="input_file">
            <input type="button" value="choisir un fichier en csv" id="faux_bouton_file"><label id="label_faux_bouton_file"> Auncun fichier choisi </label>
            <input type="submit" value="télécharger" name="import" class="danger">
        </form>
    </div>
    
<?php } ?>
