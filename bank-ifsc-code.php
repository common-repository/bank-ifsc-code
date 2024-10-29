<?php
/**
 * @link              http://www.pakainfo.com
 * @since             1.0
 * @package           ifsc
 *
 * @wordpress-plugin
 * Plugin Name:       Bank IFSC Code
 * Plugin URI:        https://wordpress.org/plugins/bank-ifsc-code/
 * Description:       Type IFSC code to Know Branch Details of any Bank Find IFSC, MICR Codes, Address, All Bank Branches, for NEFT, RTGS, ECS Transactions. Use <strong>[ifsc_shortcode]</strong> shortcode for IFSC Code or Place them any location as per your requirement.
 * Version:           1.0
 * Author:            PAKAINFO
 * Author URI:        https://www.pakainfo.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

register_activation_hook(__FILE__,'bank_ifsc_code_ifsc_install');
register_deactivation_hook(__FILE__,'bank_ifsc_code_ifsc_deactivate');

function bank_ifsc_code_ifsc_install(){

}

function bank_ifsc_code_ifsc_deactivate(){

}

add_shortcode('ifsc_shortcode','bank_ifsc_code_ifsc_form');
function bank_ifsc_code_ifsc_form(){
	include('bank-ifsc-code-ifsc-form.php');
}

add_filter( 'plugin_row_meta', 'bank_ifsc_code_row_meta', 10, 2 );

if (!function_exists('bank_ifsc_code_row_meta')) { 
    function bank_ifsc_code_row_meta( $links, $file ) {    
        if ( plugin_basename( __FILE__ ) == $file ) {
            $row_meta = array(
              'docs'    => '<a href="' . esc_url( 'https://www.pakainfo.com/ifsc-code/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Plugin Additional Links', 'domain' ) . '" style="color:green;">' . esc_html__( 'Docs', 'domain' ) . '</a>'
            );
     
            return array_merge( $links, $row_meta );
        }
        return (array) $links;
    }
}

if (!function_exists('bankIfscCodegetRemoteDataContentHtml')) {
    function bankIfscCodegetRemoteDataContentHtml($ifsc_code){

            $request = wp_remote_post('https://www.pakainfo.com/ifsc/getwpifscinfo.php', array(
            'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
            'body'        => json_encode($ifsc_code, true),
            'method'      => "POST",
            'data_format' => 'body',
            ));

            $results = wp_remote_retrieve_body( $request );
            return json_decode( $results );
    }
}	
?>