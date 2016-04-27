<?php
/**
 * Template Name: login
 *
 * login form for members
 *
 */

if ( is_user_logged_in() ) { // Display WordPress login form:
    wp_redirect( site_url() );
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

                                    <div class="home_login_wrap">
                                        <a name="login"></a>
                                        <div class="row">
                                            <div class="large-12 columns">

                                    <?php

                                                 ?>
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
                                                 Online membership is preferred, but if you would rather use a printed form, <a href="http://www.otu.asn.au/wp-content/uploads/Renewal-Form-16-17.pdf">download one here</a>.
                                        </div>
                                    </div>
                                </div>

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