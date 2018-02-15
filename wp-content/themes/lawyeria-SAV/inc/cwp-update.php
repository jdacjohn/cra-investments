<?php
if (!defined('TI_SL_STORE_URL')) {
    define( 'TI_SL_STORE_URL', 'http://themeisle.com' );
}
add_action( 'admin_init', 'lawyeria_activate_license' );
add_action( 'admin_init', 'lawyeria_register_settings' );

function lawyeria_register_settings()
{

    if(!is_admin()) return false;
    $theme_data =   wp_get_theme(basename(get_template_directory() ));
    add_settings_field(
        'lawyeria_license',
        $theme_data->get('Name')." license",
        'lawyeria_license_view',
        'general'
    );
}
function lawyeria_license_view(){

    $status =  lawyeria_get_status();
    $value = lawyeria_get_license();
    echo '<p ><input '.(($status === 'valid') ? ('style="border:1px solid #7ad03a; "') : '').' type="text" id="lawyeria_license" name="lawyeria_license" value="' . $value . '" /><a '.(($status === 'valid') ? ('style="color:#fff;background:  #7ad03a; display: inline-block;text-decoration: none;font-size: 13px;line-height: 26px;height: 26px; margin-left:5px; padding: 0 10px 1px;  -webkit-border-radius: 3px;border-radius: 3px; ">Valid') : ('style="color:#fff;background:  #dd3d36; display: inline-block;text-decoration: none;font-size: 13px;line-height: 26px;height: 26px; margin-left:5px; padding: 0 10px 1px;  -webkit-border-radius: 3px;border-radius: 3px; ">Invalid')).' </a>&nbsp;&nbsp;&nbsp;<button name="lawyeria_btn_trigger" '.(($status === 'valid') ? (' class="button button-primary">Deactivate') : (' class="button button-primary" type="submit" >Activate')).' </button></p><p class="description">Enter your license from <a  href="https://themeisle.com/purchase-history">themeisle.com</a> in order to get theme updates</p>';


}

function lawyeria_get_status(){
    $license_data = get_option( 'lawyeria_license_data', '' );
    if($license_data !== ''){
        return isset($license_data->license) ? $license_data->license : get_option( 'lawyeria_license_status','' ) ;
    }else{
        return get_option( 'lawyeria_license_status','' ) ;
    }
}

function lawyeria_get_license(){

    $license_data = get_option( 'lawyeria_license_data', '' );
    if($license_data !== ''){
        return isset($license_data->key) ? $license_data->key: get_option( 'lawyeria_license', '' ) ;
    }else{
        return get_option( 'lawyeria_license','' ) ;
    }
}
function lawyeria_check_activation(){
    $license_data = get_option( 'lawyeria_license_data', '' );

    if($license_data !== ''){
        return isset($license_data->error) ? ($license_data->error == 'no_activations_left') : false;
    }
    return false;
}
function lawyeria_check_expiration(){

    $license_data = get_option( 'lawyeria_license_data', '' );

    if($license_data !== ''){
        if(isset($license_data->expires)) {
            if( strtotime($license_data->expires) - time() < 30 * 24 * 3600) {
                return true;
            }
        }
    }
    return false;
}
function lawyeria_check_hide($hide){
    if(isset($_GET['lawyeria_hide_'.$hide])){
        if($_GET['lawyeria_hide_'.$hide]==='yes') {
            $license = get_option( 'lawyeria_license_data', '' );
            $license->{'hide_'.$hide} = true;
            update_option( 'lawyeria_license_data', $license );
            return false;
        }
    }else{
        $license =
        $license = get_option( 'lawyeria_license_data', '' ); ;
        if($license !== ''){
            if(isset($license->{'hide_'.$hide})){
                return false;
            }
        }
    }
    return true;
}
function lawyeria_notice() {


    if(!is_admin()) return false;
    $status 	= lawyeria_get_status();
    $admin_url = admin_url("options-general.php");

    $theme_data =   wp_get_theme(basename(get_template_directory() ));
    if($status != 'valid')  {
        if(lawyeria_check_activation()){
            if(lawyeria_check_hide('activation')){
                ?>
                <div class="error">
                    <p><strong>No activations left for <?php echo $theme_data->get('Name'); ?>  !!!. You need to upgrade your plan in order to use <?php echo $theme_data->get('Name'); ?> on more websites. Please <a href="mailto:friends@themeisle.com">contact</a> the ThemeIsle Staff for more details.</strong>| <a href="<?php echo $admin_url; ?>?lawyeria_hide_activation=yes">Hide Notice</a></p>
                </div>
                <?php
                return false;
            }
        }
        ?>
        <?php if(lawyeria_check_hide('valid') ): ?>
            <div class="error">
                <p><strong>You do not have a valid license for <?php echo $theme_data->get('Name'); ?>  theme !!!. You can get the license code from your purchase history on <a href="https://themeisle.com/purchase-history" >themeisle.com</a> and validate it <a href="<?php echo admin_url("options-general.php"); ?>#lawyeria_license">here</a> </strong>| <a href="<?php echo $admin_url; ?>?lawyeria_hide_valid=yes">Hide Notice</a></p>
            </div>
        <?php endif; ?>
    <?php
    }else{

        if(lawyeria_check_expiration()){
            if(lawyeria_check_hide('expiration')){
                ?>
                ?>
                <div class="update-nag">
                    <p><strong>Your license is about to expire for <?php echo $theme_data->get('Name'); ?>   theme !!!. You can go to  <a href="https://themeisle.com/" >themeisle.com</a> and  renew it.</strong>| <a href="<?php echo $admin_url; ?>?lawyeria_hide_expiration=yes">Hide Notice</a></p>
                </div>
            <?php
            }
        }
    }
}

add_action( 'admin_notices', 'lawyeria_notice' );
function lawyeria_renew_url(){

    $license_data = get_option( 'lawyeria_license_data', '' );

    if($license_data !== ''){
        if(isset($license_data->download_id) && isset($license_data->key)){
            return "https://themeisle.com/checkout/?edd_license_key=".$license_data->key."&download_id=".$license_data->download_id;
        }
    }

    return " https://themeisle.com/";
}
add_action( 'admin_notices', 'lawyeria_notice' );

function lawyeria_activate_license() {

    // listen for our activate button to be clicked
    if( isset( $_POST['lawyeria_btn_trigger'] ) ) {

        $status = lawyeria_get_status();
        // retrieve the license from the database
        $license = $_POST['lawyeria_license'];

        $theme_data =   wp_get_theme(basename(get_template_directory() ));
        if($status != "valid"){
            // data to send in our API request
            $api_params = array(
                'edd_action'=> 'activate_license',
                'license' 	=> $license,
                'item_name' => urlencode(  $theme_data->get('Name') ),
                'url'       => home_url()
            );
        }else{
            $api_params = array(
                'edd_action'=> 'deactivate_license',
                'license' 	=> $license,
                'item_name' => urlencode(  $theme_data->get('Name') ),
                'url'       => home_url()
            );
        }
        // Call the custom API.
        $response = wp_remote_get( add_query_arg( $api_params, TI_SL_STORE_URL ) );
        // make sure the response came back okay
        if ( is_wp_error( $response ) )
        {
            $license_data = new stdClass();
            $license_data -> license = ($status != "valid" ) ? "valid" : "invalid";

        }else{
            $license_data = json_decode( wp_remote_retrieve_body( $response ) );

            if(!is_object($license_data)){
                $license_data = new stdClass();
                $license_data -> license = ($status != "valid" ) ? "valid" : "invalid";
            }
        }
        if(!isset($license_data->key)) $license_data->key = $license ;
        update_option( 'lawyeria_license_data', $license_data );
        delete_transient( 'lawyeria_license_data');
        set_transient( 'lawyeria_license_data', $license_data, 12  * HOUR_IN_SECONDS  );

    }
}

add_action( 'admin_init', 'lawyeria_theme_valid',9999999 );
function lawyeria_theme_valid($force = false){
    if ( false === ( $license = get_transient( 'lawyeria_license_data' ) ) ) {
        $license = lawyeria_check_license();
        set_transient( 'lawyeria_license_data', $license, 12  * HOUR_IN_SECONDS   );
        update_option( 'lawyeria_license_data', $license );
    }

}

function lawyeria_check_license() {

    global $wp_version;

    $status = lawyeria_get_status();

    if($status != "valid") {
        $license_data = new stdClass();
        $license_data -> license = "invalid";
        return $license_data;
    }
    $theme_data =   wp_get_theme(basename(get_template_directory() ));
    $license = trim( lawyeria_get_license() );
    $api_params = array(
        'edd_action' => 'check_license',
        'license' => $license,
        'item_name' => urlencode(  $theme_data->get('Name') ),
        'url'       => home_url()
    );
    // Call the custom API.
    $response = wp_remote_get( add_query_arg( $api_params, TI_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );


    if ( is_wp_error( $response ) )
    {
        $license_data = new stdClass();
        $license_data -> license = "valid";

    }else{ 

        $license_data = json_decode( wp_remote_retrieve_body( $response ) );
        if(!is_object($license_data)){
            $license_data = new stdClass();
            $license_data -> license = "valid";
        }
    }


    $license_old = get_option( 'lawyeria_license_data', '' );
    if(isset($license_old->hide_valid)) $license_data->hide_valid = true;
    if(!isset($license_data->key)) $license_data->key = isset($license_old->key) ? $license_old->key : "" ;
    if(isset($license_old->hide_expiration)) $license_data->hide_expiration = true;
    if(isset($license_old->hide_activation)) $license_data->hide_activation = true;
    return $license_data;


}

function lawyeria_theme_updater() {


    $theme_data =   wp_get_theme(basename(get_template_directory() ));
    $test_license = trim( lawyeria_get_license() );
    $edd_updater = new EDD_SL_Theme_Updater( array(
            'remote_api_url' 	=> TI_SL_STORE_URL, 	// Our store URL that is running EDD
            'version' 			=> $theme_data->get('Version'), 				// The current theme version we are running
            'license' 			=> $test_license, 		// The license key (used get_option above to retrieve from DB)
            'item_name' 		=> $theme_data->get('Name'),	// The name of this theme
            'author'			=> 'ThemeIsle'	// The author's name
        )
    );
}
add_action( 'admin_init', 'lawyeria_theme_updater' );

if(!class_exists('EDD_SL_Theme_Updater')) {
    class EDD_SL_Theme_Updater {
        private $remote_api_url;
        private $request_data;
        private $response_key;
        private $theme_slug;
        private $license_key;
        private $version;
        private $author;

        function __construct( $args = array() ) {
            $args = wp_parse_args( $args, array(
                'remote_api_url' => 'http://easydigitaldownloads.com',
                'request_data'   => array(),
                'theme_slug'     => get_template(),
                'item_name'      => '',
                'license'        => '',
                'version'        => '',
                'author'         => ''
            ) );
            extract( $args );

            $theme                = wp_get_theme( sanitize_key( $theme_slug ) );
            $this->license        = $license;
            $this->item_name      = $item_name;
            $this->version        = ! empty( $version ) ? $version : $theme->get( 'Version' );
            $this->theme_slug     = sanitize_key( $theme_slug );
            $this->author         = $author;
            $this->remote_api_url = $remote_api_url;
            $this->response_key   = $this->theme_slug . '-update-response';


            add_filter( 'site_transient_update_themes', array( &$this, 'theme_update_transient' ) );
            add_filter( 'delete_site_transient_update_themes', array( &$this, 'delete_theme_update_transient' ) );
            add_action( 'load-update-core.php', array( &$this, 'delete_theme_update_transient' ) );
            add_action( 'load-themes.php', array( &$this, 'delete_theme_update_transient' ) );
            add_action( 'load-themes.php', array( &$this, 'load_themes_screen' ) );
        }

        function load_themes_screen() {
            add_thickbox();
            add_action( 'admin_notices', array( &$this, 'update_nag' ) );
        }

        function update_nag() {
            $theme = wp_get_theme( $this->theme_slug );

            $api_response = get_transient( $this->response_key );

            if( false === $api_response )
                return;

            $update_url = wp_nonce_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $this->theme_slug ), 'upgrade-theme_' . $this->theme_slug );
            $update_onclick = ' onclick="if ( confirm(\'' . esc_js( __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update." ) ) . '\') ) {return true;}return false;"';

            if ( version_compare( $this->version, $api_response->new_version, '<' ) ) {

                echo '<div id="update-nag">';
                printf( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.',
                    $theme->get( 'Name' ),
                    $api_response->new_version,
                    '#TB_inline?width=640&amp;inlineId=' . $this->theme_slug . '_changelog',
                    $theme->get( 'Name' ),
                    $update_url,
                    $update_onclick
                );
                echo '</div>';
                echo '<div id="' . $this->theme_slug . '_' . 'changelog" style="display:none;">';
                echo wpautop( $api_response->sections['changelog'] );
                echo '</div>';
            }
        }

        function theme_update_transient( $value ) {
            $update_data = $this->check_for_update();
            if ( $update_data ) {
                $value->response[ $this->theme_slug ] = $update_data;
            }
            return $value;
        }

        function delete_theme_update_transient() {
            delete_transient( $this->response_key );
        }

        function check_for_update() {

            $theme = wp_get_theme( $this->theme_slug );

            $update_data = get_transient( $this->response_key );
            if ( false === $update_data ) {
                $failed = false;

                if( empty( $this->license ) )
                    return false;

                $api_params = array(
                    'edd_action' 	=> 'get_version',
                    'license' 		=> $this->license,
                    'name' 			=> $this->item_name,
                    'slug' 			=> $this->theme_slug,
                    'author'		=> $this->author,
                    'url'           => home_url()
                );

                $response = wp_remote_post( $this->remote_api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

                // make sure the response was successful
                if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
                    $failed = true;
                }

                $update_data = json_decode( wp_remote_retrieve_body( $response ) );

                if ( ! is_object( $update_data ) ) {
                    $failed = true;
                }

                // if the response failed, try again in 30 minutes
                if ( $failed ) {
                    $data = new stdClass;
                    $data->new_version = $this->version;
                    set_transient( $this->response_key, $data, strtotime( '+30 minutes' ) );
                    return false;
                }

                // if the status is 'ok', return the update arguments
                if ( ! $failed ) {
                    $update_data->sections = maybe_unserialize( $update_data->sections );
                    set_transient( $this->response_key, $update_data, strtotime( '+12 hours' ) );
                }
            }

            if ( version_compare( $this->version, $update_data->new_version, '>=' ) ) {
                return false;
            }

            return (array) $update_data;
        }
    }
}
