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
        if ( !$this->activated( 'auth_manager' ) ) return;

        $this->create_auth_pages();

        add_action( 'admin_menu', array( $this, 'set_user_roles' ) );
        add_action( 'wp_ajax_nopriv_login', array( $this, 'submit_login' ) );
        add_action( 'wp_ajax_nopriv_register', array( $this, 'submit_registration' ) );
        add_action( 'wp_ajax_nopriv_lost_password', array( $this, 'submit_lost_password' ) );
        add_action( 'wp_ajax_nopriv_reset_password', array( $this, 'submit_reset_password' ) );
        add_action( 'login_form_login', array( $this, 'redirect_to_di_login') );
        add_action( 'login_form_register', array( $this, 'redirect_to_di_register' ) );
        add_action( 'login_form_lostpassword', array( $this, 'redirect_to_di_lost_password' ) );
        add_action( 'login_form_rp', array( $this, 'redirect_to_di_password_reset' ) );
        add_action( 'login_form_resetpass', array( $this, 'redirect_to_di_password_reset' ) );
        add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );

        add_filter( 'editable_roles', array( $this, 'set_user_role_order' ), 10, 1 );
        add_filter( 'retrieve_password_message', array( $this, 'di_retrieve_password_message' ), 10, 4 );
    }

    public function create_auth_pages()
    {
        // Create definitions for each page needed
        $this->page_definitions = [
            'client-account'    => [
                'title'         => __( 'Your Account', 'di-plugin' ),
                'content'       => '[client-info]'
            ],
            'member-login'    => [
                'title'         => __( 'Sign In', 'di-plugin' ),
                'content'       => '[login-form]'
            ],
            'member-account'  => [
                'title'         => __( 'Your Account', 'di-plugin' ),
                'content'       => '[member-info]'
            ],
            'member-register' => [
                'title'         => __( 'Register', 'di-plugin' ),
                'content'       => '[register-form]'
            ],
            'member-password-lost'  => [
                'title'         => __( 'Forgot Your Password?', 'di-plugin' ),
                'content'       => '[password-lost-form]'
            ],
            'member-password-reset' => [
                'title'         => __( 'Pick a New Password', 'di-plugin' ),
                'content'       => '[password-reset-form]'
            ]
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
    
    /**
     * Remove the default user roles and add new custom user roles
     *
     * @return void
     */
    public function set_user_roles()
    {
        // Check if the user roles have already been set
        if ( get_option( 'di_plugin_user_roles' ) ) { return; }

        // Remove the default user roles
        $blacklist_roles = array(
            'author',
            'contributor',
            'editor',
            'subscriber'
        );

        foreach ( $blacklist_roles as $role ) {
            remove_role( $role );
        }

        // default Capabilities
        $default_capabilities = array(
            'edit_published_posts'      => true,
            'upload_files'              => true,
            'publish_posts'             => true,
            'delete_published_posts'    => true,
            'edit_posts'                => true,
            'delete_posts'              => true,
            'read'                      => true,
        );

        // Add the custom user roles
        $di_roles = array(
            'client' => array(
                'capabilities'  => $default_capabilities,
                'name'          => 'Client'
            ),
            'member' => array(
                'capabilities'  => $default_capabilities,
                'name'          => 'Member'
            )
        );

        foreach ( $di_roles as $key => $role ) {
            add_role(
                $key,
                $role['name'],
                array()
            );

            $new_role = get_role( $key );
            foreach ( $default_capabilities as $key => $value ) {
                $new_role->add_cap( $key, $value );
            }

        }

        update_option( 'default_role', 'member');
        update_option( 'di_plugin_user_roles', true );
        return;
    }

    /**
     * Sets a new default order for the user roles
     *
     * @param array     $roles  The array of user roles
     * @return array            The new array of user roles in order
     */
    public function set_user_role_order( $all_roles )
    {
        $roles = array(
            'client' => $all_roles['client'],
            'member' => $all_roles['member'],
            'administrator' => $all_roles['administrator']
        );
        
        return array_reverse( $roles );
    }

    public function submit_login()
    {
        if( !DOING_AJAX || !check_ajax_referer( 'ajax-login-nonce', 'di_auth' )) {
            return $this->return_json( 'no-ajax' );
        }
        
        // Sanitize the data
        $username = sanitize_text_field( $_POST['username'] );
        $password = sanitize_text_field( $_POST['password'] );
        $remember = isset($_POST['remember']);

        $credentials = array(
            'user_login' => $username,
            'user_password' => $password,
            'remember' => $remember
        );

        //$user = wp_signon( $credentials, '' );
        $user = get_user_by('login', $credentials['user_login']);
        $result = wp_check_password($credentials['user_password'], $user->data->user_pass, $user->data->ID);
        
        if ( $result ) {
            $user_id = $user->data->ID;
            $user_login = $user->data->user_login;
    
            wp_set_current_user( $user_id, $user_login );
            wp_set_auth_cookie( $user_id );

            echo json_encode(
                array(
                    'status' => 'success',
                    'message' => [ 'Login successful! Redirecting...' ],
                    'user' => $user
                )
            );
        } else {
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => [ 'invalid_login' ],
                    'user' => ''
                )
            );
        }
        
        exit;

    }

    public function submit_registration()
    {
        if( !DOING_AJAX || !check_ajax_referer( 'ajax-register-nonce', 'di_register' )) {
            return $this->return_json( 'no-ajax' );
        }
        
        // Sanitize the data
        $username = sanitize_text_field( $_POST['username'] );
        $email = sanitize_email( $_POST['email'] );
        $first_name = sanitize_text_field( $_POST['first_name'] );
        $last_name = sanitize_text_field( $_POST['last_name'] );

        if ( !get_option( 'users_can_register' ) ) {
            // Registration  is closed, display error
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => [ 'closed' ]
                )
            );
            exit;
        } 
        
        if ( !$this->verify_recaptcha() ) {
            // reCAPTCHA check failed, display error
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => [ 'captcha' ]
                )
            );
            exit;
        }
        
        $result = $this->register_user( $username, $email, $first_name, $last_name );

        if ( is_wp_error( $result ) ) {
            // Parse errors into a string and append as parameter to redirect
            $errors = join( ',', $result->get_error_codes() );
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => [ $errors ]
                )
            );
            exit;
        }

        // Success
        echo json_encode(
            array(
                'status' => 'success',
                'message' => [ 'Registration successful! Redirecting...' ]
            )
        );
        exit;

    }

    public function submit_lost_password()
    {
        if( !DOING_AJAX || !check_ajax_referer( 'ajax-lost-password-nonce', 'di_lost_password' )) {
            return $this->return_json( 'no-ajax' );
        }

        // Sanitize the data
        $email = sanitize_email( $_POST['email'] );
        $user = get_user_by( 'email', $email );
        $result = retrieve_password( $user->user_login );

        if ( is_wp_error( $result ) ) {
            // Parse errors into a string and append as parameter to redirect
            $errors = join( ',', $result->get_error_codes() );
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => [ $errors ]
                )
            );
            exit;
        }

        // Success - Email sent
        echo json_encode(
            array(
                'status' => 'success',
                'message' => [ 'Password retrieval successful! Redirecting...' ]
            )
        );
        exit;

    }

    public function return_json($status)
    {
        $return = array(
            'status' => $status
        );
        wp_send_json( $return );

        // Send response
        wp_die();
    }

    /**
     * Redirect the user to the custom login page instead of wp_login.php
     *
     * @return void
     */
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

    /**
     * Redirects the user to the custom registration page instead
     * of wp-login.php?action=register
     *
     * @return void
     */
    public function redirect_to_di_register()
    {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user();
                exit;
            } 
            
            wp_redirect( home_url( 'member-register' ) );
            exit;

        }
        
    }

    /**
     * Redirects the user to the custom "Forgot your password?" page instead of
     * of wp-login.php?action=lostpassword
     *
     * @return void
     */
    public function redirect_to_di_lost_password()
    {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            
            if ( is_user_logged_in() ) {
                $this->redirect_logged_in_user();
                exit;
            } 
            
            wp_redirect( home_url( 'member-password-lost' ) );
            exit;

        }
    }

    /**
     * Redirects to the custom password reset page, or the login page
     * if there are errors
     *
     * @return void
     */
    public function redirect_to_di_password_reset()
    {
        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
            // Verify Key / login combo
            $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );

            if ( !$user || is_wp_error( $user ) ) {
                if ( $user && $user->get_error_code() === 'expired_key' ) {
                    wp_redirect( home_url( 'member-login?login=expiredkey' ) );
                } else {
                    wp_redirect( home_url( 'member-login?login=invalidkey' ) );
                }

                exit;
            }

            $redirect_url = home_url( 'member-password-reset' );
            $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
            $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );

            wp_redirect( $redirect_url );
            exit;
        }
    }

    /**
     * Redirects to custom login page after the user has been logged out.
     *
     * @return void
     */
    public function redirect_after_logout()
    {
        $redirect_url = home_url( 'member-login/?logged_out=true' );
        wp_safe_redirect( $redirect_url );

        exit;
    }
    
    /**
     * Validates and then completes the new user signup process if all went well.
     *
     * @param string $username      The new user's username
     * @param string $email         The new user's email address
     * @param string $first_name    The new user's first name
     * @param string $last_name     The new user's last name
     * 
     * @return int|WP_Error         The id of the user that was created, or error if failed.
     */
    public function register_user( $username, $email, $first_name, $last_name )
    {
        $errors = new \WP_Error();

        // Validate username
        if ( empty( $username ) || !validate_username( $username ) ) {
            $errors->add( 'username', $this->get_error_message( 'username' ) );
            return $errors;
        }
        if ( username_exists( $username ) ) {
            $errors->add( 'username_exists', $this->get_error_message( 'username_exists' ) );
            return $errors;
        }

        // Validate email address
        if ( !is_email( $email ) ) {
            $errors->add( 'email', $this->get_error_message( 'email' ) );
            return $errors;
        }
        if ( email_exists( $email ) ) {
            $errors->add( 'email_exists', $this->get_error_message( 'email_exists' ) );
            return $errors;
        }

        // Auto-Generate the password so that the new user will have to check email
        $password = wp_generate_password( 12, true );

        $user_data = array(
            'user_login'    => $username,
            'user_email'    => $email,
            'user_pass'     => $password,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'role'       => 'member'
        );

        $user_id = wp_insert_user( $user_data );
        wp_new_user_notification( $user_id, $password );

        return $user_id;

    }

    /**
     * Checks that the reCAPTCHA parameter sent with the registration
     * request is valid.
     *
     * @return bool True if the CAPTCHA is OK, otherwise false
     */
    public function verify_recaptcha()
    {
        // This field is set by the reCAPTCHA widget if check is successful
        if ( !isset( $_POST['g-recaptcha-response'] ) ) { return false; }

        $captcha_response = $_POST['g-recaptcha-response'];

        // Verify the captcha response from Google
        $response = wp_remote_post(
            'https://www.google.com/recaptcha/api/siteverify',
            array(
                'body' => array(
                    'secret'    => get_option( 'di_plugin_api' )['reCAPTCHA']['secret_key'],
                    'response'  => $captcha_response
                )
            )
        );

        $success = false;

        if ( $response && is_array( $response ) ) {
            $decoded_response = json_decode( $response['body'] );
            $success = $decoded_response->success;
        }

        return $success;

    }

    /**
     * Redirects the user to the correct page depending on whether they
     * are an admin or not.
     *
     * @param string $redirect_to   An optional redirect_to URL for admin users
     * 
     * @return void
     */
    private function redirect_logged_in_user( $redirect_to = null )
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

        exit;
    }

    /**
     * Returns the message body for the password reset email.
     * Call through the retieve_password_message filter.
     *
     * @param string    $message        Default mail message
     * @param string    $key            The activation key
     * @param string    $user_login     The username for the user
     * @param WP_User   $user_data      WP_User object
     * 
     * @return string   The mail message to send
     */
    public function di_retrieve_password_message( $message, $key, $user_login, $user_data )
    {
        // Create new email message
        $msg = __( 'Hello!', 'di-plugin' ) . "\r\n\r\n";
        $msg .= sprintf( __( 'You asked us to reset your password for your account using the email address %s.', 'di-plugin' ), $user_login ) . "\r\n\r\n";
        $msg .= __( 'If this was a mistake, or you did\'t ask for a password reset, just ignore this email and nothing will happen.', 'di-plugin' ) . "\r\n\r\n";
        $msg .= __( 'To reset your password, visit the following address:', 'di-plugin' ) . "\r\n\r\n";
        $msg .= site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n\r\n";
        $msg .= __( 'Thanks!', 'di-plugin' ) . "\r\n\r\n";

        return $msg;
    }
    
}