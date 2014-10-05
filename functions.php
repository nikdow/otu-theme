<?php
/*
 * login form
 */
function my_login_logo() { ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url(/wp-content/uploads/2014/09/otu_logo-300x300.png);
            }
        </style>
<?php } 
add_action( 'login_enqueue_scripts', 'my_login_logo' );
?>
 
