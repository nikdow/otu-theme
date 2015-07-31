<?php
/*----------------------------------------------------*/
/*	Display Committee
/*----------------------------------------------------*/

function cbdweb_committee() {
    $avatar_size = 95;
/*    $user_array = array ( 
        'meta_key' => 'committee',
        'meta_value' => 1
    );
    $committee = get_users ( $user_array ); */
    
    global $wpdb;
    $query = 
        "SELECT u.ID, u.display_name FROM $wpdb->usermeta m LEFT JOIN $wpdb->users u ON u.ID=m.user_id WHERE m.meta_key='committee' AND m.meta_value='1'";
    $committee = $wpdb->get_results ( $query, OBJECT );
    
    echo '<ul class="contributors">';

    foreach ($committee as $bloguser) {
//            $user = get_userdata($bloguser->ID);
//            $display_name = get_userdata($user->ID)->display_name;
        $display_name = $bloguser->display_name;
        $avatar = get_avatar($bloguser->ID, $avatar_size);
        $bb_profile_url = bbp_get_user_profile_url($bloguser->ID);

        echo '<li><a href="' .$bb_profile_url. '"><span data-tooltip data-options="disable_for_touch:true" class="has-tip tip-bottom radius round" title="'.$display_name.'">'.$avatar.'</span></a></li>';
    }
    echo '</ul>';
}