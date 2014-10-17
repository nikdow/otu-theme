<?php
/*
 * login form
 */
function my_login_logo() { ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url(/wp-content/uploads/2014/10/OTU-Sign-NEW-2001.jpg);
                -webkit-background-size: auto;
                background-size: auto;
                width: auto;
            }
            #login {
                    width: 335px;
            }
        </style>
<?php } 
add_action( 'login_enqueue_scripts', 'my_login_logo' );
?>
 
