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

<div class="wrap">
    <h1>Liste des images</h1>
    <?php do_shortcode( '[affiche_la_table_photo]' ); ?>
</div>