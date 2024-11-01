<?php
/*
Plugin Name: WP Photo Ads
Plugin Script: wpphotoads.php
Plugin URI: http://wpphotoads.yxymedia.com/
Description: Automagically changes the link attached to any image added through the Wordpress image tool into a link that can be used to serve your users with a page in stead of the raw image or the standard Wordpress attachment page.
Version: 1.0.c
License: GPL
Author: yxymedia & Sudar
Author URI: http://www.yxymedia.com/
*/

/**
* Guess the wp-content and plugin urls/paths
*/
if ( !defined('WP_CONTENT_URL') )
    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if ( !defined('WP_CONTENT_DIR') )
    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );

if (!defined('PLUGIN_URL'))
    define('PLUGIN_URL', WP_CONTENT_URL . '/plugins/');
if (!defined('PLUGIN_PATH'))
    define('PLUGIN_PATH', WP_CONTENT_DIR . '/plugins/');


if (!function_exists('smit_request_handler')) {
    function smit_request_handler() {

        if ($_POST['smit_action'] == "update wp it") {

            check_admin_referer( 'wp-it-update-config');

            update_option("smit_iturl", sanitize_url($_POST['smit_iturl']));

            // hook the admin notices action
            add_action( 'admin_notices', 'smit_change_notice', 9 );
        }
    }
}

function smit_change_notice() {
    echo '<br clear="all" /> <div id="message" class="updated fade"><p><strong>Option saved. </strong></p></div>';
}

/**
 * Show the Admin page
 */
if (!function_exists('smit_displayOptions')) {
    function smit_displayOptions() {

        $smit_iturl_v = get_option("smit_iturl");

                print('<div class="wrap">');
                print('<h2>WP Photo Ads Options</h2>');

        print ('<form name="smit_form" action="'. get_bloginfo("wpurl") . '/wp-admin/options-general.php?page=wpphotoads.php' .'" method="post">');
?>
        <fieldset class="options">

        <h3>WP Photo Ads</h3>
        <p>Use this plugin to automagically changes the link attached to any image added through the Wordpress image tool into a link that can be used to serve your users with a page in stead of the raw image or the standard Wordpress attachment page.<br /><br />The url below must specify the location of the file handling the info passed through by the plugin. More info on how to make such a page can be found on the <a href="http://wpphotoads.yxymedia.com/">WP Photo Ads homepage</a>.</p>
                <table class="optiontable">
                 <tr>
                         <th scope="row" >
                                  <label for="smit_iturl">WP Photo Ads Image Page URL</label>
                         </th>
                         <td>
                                 <input name="smit_iturl"  id="smit_iturl" value = "<? echo $smit_iturl_v; ?>" size="50" />
                         </td>
                 </tr>
                </table>

                </fieldset>
        <p class="submit">
                                <input type="submit" name="submit" value="Save &raquo;">
        </p>

                <input type="hidden" name="smit_action" value="update wp it" />
<?php wp_nonce_field('wp-it-update-config'); ?>
                </form>
                </div>

<?php
    }
}

function smit_print_scripts() {
    $smit_iturl_v = get_option("smit_iturl");
    if ($smit_iturl_v != "") {
?>
<script>
    var thumbfile = "<?php echo $smit_iturl_v; ?>";
    jQuery(document).ready(function () {
        var actualHost = jQuery.trim(jQuery.url.attr("host"));
        jQuery("a img").each(function (i) {

            if (jQuery.trim(jQuery.url.setUrl(jQuery(this).attr("src")).attr("host")) == actualHost &&
                (jQuery.url.setUrl(jQuery(this).attr("src")).attr("path")).indexOf("wp-content") != -1 &&
                isImage(jQuery.url.setUrl(jQuery(this).attr("src")).attr("file"))) {

                var parentTag = jQuery(this).parent().get(0).tagName;
                parentTag = parentTag.toLowerCase();

                if (parentTag == "a" &&
                jQuery.url.setUrl(jQuery(this).parent().attr("href")).attr("host") == actualHost &&
                jQuery.url.setUrl(jQuery(this).parent().attr("href")).attr("path").indexOf("wp-content") != -1 &&
                isImage(jQuery(this).parent().attr("href"))) {
                
                    var description = (jQuery(this).attr("alt") == "") ? jQuery(this).attr("title") : jQuery(this).attr("alt");
                    jQuery(this).parent().attr("href", thumbfile +
                            "?title=" + jQuery(this).attr("title") +
                            "&description=" + description +
                            "&url=" + stripDomain(jQuery(this).parent().attr("href"))

                    );
                }
            }
        });

        function stripDomain(url) {
            var pos = url.indexOf('wp-content');
            return (url.substr(pos + 11));
        }

        function isImage(fileName) {
            if (fileName == "") {
                return false;
            }
            var pos = fileName.lastIndexOf(".");
            if (pos == -1){
                return false;
            } else {
                var extension = fileName.substring(pos);
                switch (extension.toLowerCase()) {
                case ".jpg":
                case ".png":
                case ".gif":
                case ".bmp":
                case ".jpeg":
                    return true;
                    break;
                default:
                    return false;
                    break;
                }
            }
        }
    });
</script>
<?php
    }
}

/**
 * Enqueue Scripts
 */
function smit_enqueue_scripts() {
   wp_enqueue_script("jquery");
   wp_enqueue_script("jquery_url", PLUGIN_URL . dirname(plugin_basename(__FILE__)) . "/jquery.url.packed.js","jquery");
}

/**
 *
 */
if(!function_exists('smit_add_menu')) {
        function smit_add_menu() {

            //Add a submenu to Options
        add_options_page("WP Photo Ads", "WP Photo Ads", 8, basename(__FILE__), "smit_displayOptions");
        }
}

add_action('admin_menu', 'smit_add_menu');
add_action('init', 'smit_request_handler');
add_action('wp_head', 'smit_print_scripts');
add_action('init', 'smit_enqueue_scripts', 9);
?>
