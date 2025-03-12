<?php
/*
 * get template tags from child theme
 */
require_once( trailingslashit(get_stylesheet_directory() ). 'template-tags.php' );

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
                height: 133px;
            }
            #login {
                    width: 335px;
            }
        </style>
<?php } 
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_action( 'wp_enqueue_scripts', function() {
   wp_dequeue_style( 'font_awesome' );
   wp_enqueue_style( 'font_awesome_cdn', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '4.4.0', 'all');
});
if ( defined('CBDWeb_SUPPRESS_CHECK_UPDATES' ) && CBDWeb_SUPPRESS_CHECK_UPDATES ) {
    add_action( 'admin_head', 'suppress_update_checks', 999 );
}
function suppress_update_checks() {
    
//    remove_action( 'admin_bar_menu', 'stats_admin_bar_menu', 100 );
    remove_action( 'admin_bar_menu', 'wp_admin_bar_updates_menu', 40 );
}

add_shortcode('otu_login', 'otu_login' );

function otu_login (  ) {
    ob_start(); ?>
    <div class="home_login_wrap">
        <a name="login"></a>
        <div class="row">
            <div class="large-12 columns">
                 <h3>Login</h3>
                 <form name="loginform-custom" id="loginform-custom" onSubmit="loginSubmit(this)" action="<?=site_url()?>/wp-login.php" method="post">
                     <p class="login-username"><label for="user_login">surname</label>
                         <input type="text" name="partial_log" id="user_login" class="input" size="20"/>
                         <input type="hidden" name="log" />
                     </p>
                     <P class="login-password">
                         <label for="user_pass">Reg No</label>
                         <input type="password" name="pwd" id="user_pass" class="input" size="20"/>
                     </P>
                     <?php // do_action( 'login_form' );?>
                     <p class="login-remember">
                         <label>
                             <input name="rememberme" type="checkbox" id="rememberme" value="forever">
                             Remember Me
                         </label>
                     </p>
                     <p class="login-submit">
                         <input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In"/>
                     </p>
                 </form>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
 
