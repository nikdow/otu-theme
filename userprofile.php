<?php
/**
 * Template Name: User Profile
 *
 * Allow users to update their profiles from Frontend.
 *
 */

/* Get user info. */
global $current_user;
get_currentuserinfo();

$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user information. */
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
            update_user_meta( $current_user->ID, 'pmpro_bemail', esc_attr( $_POST['email'] ) );
        }
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['pmpro_class'] ) )
        update_user_meta( $current_user->ID, 'pmpro_class', esc_attr( $_POST['pmpro_class'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
    if ( !empty( $_POST['pmpro_baddress1'] ) )
        update_user_meta($current_user->ID, 'pmpro_baddress1', esc_attr ( $_POST['pmpro_baddress1'] ) );
    if ( !empty( $_POST['pmpro_bcity'] ) )
        update_user_meta($current_user->ID, 'pmpro_bcity', esc_attr ( $_POST['pmpro_bcity'] ) );
    if ( !empty( $_POST['pmpro_bstate'] ) )
        update_user_meta($current_user->ID, 'pmpro_bstate', esc_attr ( $_POST['pmpro_bstate'] ) );
    if ( !empty( $_POST['pmpro_bzipcode'] ) )
        update_user_meta($current_user->ID, 'pmpro_bzipcode', esc_attr ( $_POST['pmpro_bzipcode'] ) );
    if ( !empty( $_POST['pmpro_bphone'] ) )
        update_user_meta($current_user->ID, 'pmpro_bphone', esc_attr ( $_POST['pmpro_bphone'] ) );
    if ( !empty( $_POST['pmpro_bmobile'] ) )
        update_user_meta($current_user->ID, 'pmpro_bmobile', esc_attr ( $_POST['pmpro_bmobile'] ) );
    if ( !empty( $_POST['pmpro_bbusiness'] ) )
        update_user_meta($current_user->ID, 'pmpro_bbusiness', esc_attr ( $_POST['pmpro_bbusiness'] ) );
    if ( !empty( $_POST['pmpro_deceased'] ) ) {
        update_user_meta($current_user->ID, 'pmpro_deceased', 1 );
    } else {
        update_user_meta($current_user->ID, 'pmpro_deceased', 0 );
    }
    if ( !empty( $_POST['pmpro_do_not_contact'] ) ) {
        update_user_meta($current_user->ID, 'pmpro_do_not_contact', 1 );
    } else {
        update_user_meta($current_user->ID, 'pmpro_do_not_contact', 0 );
    }
    
    /* Redirect so the page will show updated info.*/
    if ( count($error) == 0 ) {
        wp_redirect( get_permalink() );
        exit;
    }
}

get_header(); ?>

</div><!-- .hero_wrap -->

<div class="row content_row">

	<div class="large-9 columns">

	<div id="primary" class="content-area">
		
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <div id="post-<?php the_ID(); ?>">
                            <div class="entry-content entry">
                                <?php the_content(); ?>
                                <?php if ( !is_user_logged_in() ) : ?>
                                        <p class="warning">
                                            <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                                        </p><!-- .warning -->
                                <?php else : ?>
                                    <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; 
                                        
                                    $query = $wpdb->prepare ( 
                                        "SELECT meta_key, meta_value FROM " . $wpdb->usermeta .
                                        " WHERE user_id=%s", $current_user->ID );
                                    $meta_rows = $wpdb->get_results( $query, OBJECT );
                                    $metas = array();
                                    foreach ( $meta_rows as $row ) {
                                        $metas[$row->meta_key] = $row->meta_value;
                                    }
                                    
                                    ?>   
                                    <form method="post" id="adduser" action="<?php the_permalink(); ?>">
                                        <p class="form-username">
                                            <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
                                            <input class="text-input" name="first-name" type="text" id="first-name" value="<?= $metas['first_name']; ?>" />
                                        </p><!-- .form-username -->
                                        <p class="form-username">
                                            <label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
                                            <input class="text-input" name="last-name" type="text" disabled="disabled" id="last-name" value="<?= $metas['last_name']; ?>" />
                                        </p><!-- .form-username -->
                                        <p class="form-email">
                                            <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
                                            <input class="text-input" name="email" type="email" id="email" value="<?= $metas[ 'pmpro_bemail' ]; ?>" />
                                        </p><!-- .form-email -->
                                        <p class="form-textarea">
                                            <label for="description"><?php _e('Biographical Information', 'profile') ?></label>
                                            <textarea name="description" id="description" rows="3" cols="50"><?= $metas[ 'description' ]; ?></textarea>
                                        </p><!-- .form-textarea -->
                                        <p class="form-regno">
                                            <label for="pmpro_regimental_number"><?php _e('Regimental number', 'profile'); ?></label>
                                            <input class="text-input" disabled="disabled" name="pmpro_regimental_number" type="text" value="<?= $metas[ 'pmpro_regimental_number' ]; ?>" />
                                        </p>
                                        <p class="form-class">
                                            <label for="pmpro_class"><?php _e('Class', 'profile'); ?></label>
                                            <input class="text-input" name="pmpro_class" type="text" value="<?= str_replace("//", "/", $metas[ 'pmpro_class' ] ); ?>" />
                                        </p>
                                        <p class="form-address1">
                                            <label for="pmpro_baddress1"><?php _e('Address', 'profile'); ?></label>
                                            <input class="text-input" name="pmpro_baddress1" type="text" value="<?= $metas[ 'pmpro_baddress1' ]; ?>" />
                                        </p>
                                       <p class="form-address2">
                                            <label for="pmpro_baddress2">&nbsp;</label>
                                            <input class="text-input" name="pmpro_baddress2" type="text" value="<?= isset($metas[ 'pmpro_baddress2' ]) ? $metas[ 'pmpro_baddress2' ] : ""; ?>" />
                                        </p>
                                        <p class="form-city">
                                            <label for="pmpro_bcity">City</label>
                                            <input class="text-input" name="pmpro_bcity" type="text" value="<?= $metas[ 'pmpro_bcity' ]; ?>" />
                                        </p>
                                        <p class="form-state">
                                            <label for="pmpro_bstate">State</label>
                                            <input class="text-input" name="pmpro_bstate" type="text" value="<?= $metas[ 'pmpro_bstate' ]; ?>" />
                                        </p>
                                        <p class="form-zipcode">
                                            <label for="pmpro_bzipcode">Postcode</label>
                                            <input class="text-input" name="pmpro_bzipcode" type="text" value="<?= $metas[ 'pmpro_bzipcode' ]; ?>" />
                                        </p>
                                        <p class="form-hphone">
                                            <label for="pmpro_bphone">Home phone</label>
                                            <input class="text-input" name="pmpro_bphone" type="text" value="<?= $metas[ 'pmpro_bphone' ]; ?>" />
                                        </p>
                                        <p class="form-mphone">
                                            <label for="pmpro_bmobile">Mobile phone</label>
                                            <input class="text-input" name="pmpro_bmobile" type="text" value="<?= $metas[ 'pmpro_bmobile' ]; ?>" />
                                        </p>
                                        <p class="form-bphone">
                                            <label for="pmpro_bbusiness">Business phone</label>
                                            <input class="form-input" name="pmpro_bbusiness" type="text" value="<?= $metas[ 'pmpro_bbusiness' ]; ?>" />
                                        </p>
                                        <p class="form-deceased">
                                            <label for="pmpro_deceased">Deceased</label>
                                            <input class="checkbox-input" name="pmpro_deceased" type="checkbox" value="1" <?= $metas[ 'pmpro_deceased' ]==1 ? "checked" : ""; ?> />
                                        </p>
                                        <p class="form-do_not_contact">
                                            <label for="pmpro_do_not_contact">Do not contact</label>
                                            <input class="checkbox-input" name="pmpro_do_not_contact" type="checkbox" value="1" <?= $metas[ 'pmpro_do_not_contact' ]==1 ? "checked" : ""; ?> />
                                        </p>

                                        <p class="form-submit">
                                            <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
                                            <?php wp_nonce_field( 'update-user' ) ?>
                                            <input name="action" type="hidden" id="action" value="update-user" />
                                        </p><!-- .form-submit -->
                                    </form><!-- #adduser -->
                                <?php endif; ?>
                            </div><!-- .entry-content -->
                        </div><!-- .hentry .post -->
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="no-data">
                            <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
                        </p><!-- .no-data -->
                    <?php endif; ?>

        	</main><!-- #main -->

	</div><!-- #primary -->

</div><!-- .large-8 -->

</div> <!-- .row .content_row -->

<?php get_footer(); ?>