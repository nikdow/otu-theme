<?php
/*----------------------------------------------------*/
/*	Display Committee
/*----------------------------------------------------*/

function cbdweb_committee() {
    $avatar_size = 95;
    $user_array = array ( 
        'meta_key' => 'committee',
        'meta_value' => 1
    );
    $committee = get_users ( $user_array );
    
    echo '<ul class="contributors">';

    foreach ($committee as $bloguser) {
            $user = get_userdata($bloguser->ID);
            $display_name = get_userdata($user->ID)->display_name;
            $avatar = get_avatar($user->ID, $avatar_size);
            $bb_profile_url = bbp_get_user_profile_url($user->ID);

            echo '<li><a href="' .$bb_profile_url. '"><span data-tooltip data-options="disable_for_touch:true" class="has-tip tip-bottom radius round" title="'.$display_name.'">'.$avatar.'</span></a></li>';
    }
    echo '</ul>';
}