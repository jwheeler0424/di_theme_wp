<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN AUTHORIZATION CONTROLLER              |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Base\BaseController;

class AuthController extends BaseController
{
    public $callbacks;
    public $subpages = array();
    public $page_definitions = array();

    public function register()
    {
        if ( !$this->activated( 'login_manager' ) ) return;

        $this->create_auth_pages();

        add_action( 'login_form_login', array( $this, 'redirect_to_di_login') );
        add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );

        add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );
        add_filter( 'authenticate', array( $this, 'error_redirect_at_authentication' ), 101, 3 );

        // add_action( 'wp_head', array( $this, 'add_auth_template' ) );
        // add_action( 'wp_ajax_nopriv_di_login', array( $this, 'login' ) );

    }

    public function create_auth_pages()
    {
        // Create definitions for each page needed
        $this->page_definitions = [
            'member-login'   => [
                'title'         => __( 'Sign In', 'di-plugin' ),
                'content'       => '[login-form]'
            ],
            'member-account' => [
                'title'         => __( 'Your Account', 'di-plugin' ),
                'content'       => '[account-info]'
            ],
        ];

        foreach ( $this->page_definitions as $slug => $page ) {

            // Check that the page doesn't already exist
            $page_query = get_posts(
                array(
                    'name'      => $slug,
                    'post_type' => 'page'
                )
            );

            if ( !$page_query ) {

                // Add the page using the page definitions array
                wp_insert_post (
                    [
                        'post_content'      => $page['content'],
                        'post_name'         => $slug,
                        'post_title'        => $page['title'],
                        'post_status'       => 'publish',
                        'post_type'         => 'page',
                        'ping_status'       => 'closed',
                        'comment_status'    => 'closed'
                    ]
                );

            }

        }
    }

    public function redirect_to_di_login()
    {
        if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
            $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : null;

            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user( $redirect_to );
                exit;
            }

            // The rest are redirected to the login page
            $login_url = home_url( 'member-login' );
            if ( !empty( $redirect_to ) ) {
                $login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
            }

            wp_redirect( $login_url );
            exit;

        }
    }

    // Redirects to custom login page after the user has been logged out.
    public function redirect_after_logout()
    {
        $redirect_url = home_url( 'member-login?logged_out=true' );
        wp_safe_redirect( $redirect_url );
        exit;
    }

    // Returns the URL to which the user should be redirected after the (successful) login.
    public function redirect_after_login( $redirect_to, $request_redirect_to, $user )
    {
        $redirect_url = home_url();

        if ( !isset( $user->ID ) ) {
            return $redirect_url;
        }

        if ( user_can( $user, 'manage_options' ) ) {
            // Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
            if ( $request_redirect_to == '' ) {
                $redirect_url = admin_url();
            } else {
                $redirect_url = $request_redirect_to;
            }
        } else {
            // Non-admin users always go to their account page after login.
            $redirect_url = home_url( 'member-account' );
        }

        return wp_validate_redirect( $redirect_url, home_url() );

    }

    // Redirects the user to the correct page depending on whether they
    // are an admin or not.
    public function redirect_logged_in_user( $redirect_to = null )
    {
        $user = wp_get_current_user();

        if ( user_can( $user, 'manage_options' ) ) {
            if ( $redirect_to ) {
                wp_safe_redirect( $redirect_to );
            } else {
                wp_redirect( admin_url() );
            }
        } else {
            wp_redirect( home_url( 'member-account' ) );
        }
    }

    // Redirect the user after authentication if there were any errors.
    public function error_redirect_at_authentication( $user, $username, $password )
    {
        // Check if the earlier authenticate filter functions have found errors
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            if ( is_wp_error( $user ) ) {
                $error_codes = join( ',', $user->get_error_codes() );

                $login_url = home_url( 'member-login' );
                $login_url = add_query_arg( 'login', $error_codes, $login_url );

                wp_redirect( $login_url );
                exit;
            }
        }

        return $user;
    }

    public function login()
    {
        // check_ajax_referer( 'ajax-login-nonce', 'di_auth' );

        // $info = array();
        // $info['user_login'] = $_POST['username'];
        // $info['user_password'] = $_POST['password'];
        // $info['remember'] = true;

        // $user_signon = wp_signon( $info, true );
        
        // if ( is_wp_error( $user_signon ) ) {
        //     echo json_encode(
        //         array(
        //             'status' => false,
        //             'message' => 'Wrong username or password'
        //         )
        //     );

        //     die();
        // }

        // echo json_encode(
        //     array(
        //         'status' => true,
        //         'message' => 'Login successful, redirecting...'
        //     )
        // );

        // die();
    }
}