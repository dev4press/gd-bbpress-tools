<?php

if (!defined('ABSPATH')) exit;

class gdbbMod_Admin {
    public $admin_plugin = false;

    function __construct() {
        add_action('admin_init', array($this, 'admin_init'));
    }

    public function admin_init() {
        if (isset($_POST['gdbb-tweaks-submit'])) {

            check_admin_referer('gd-bbpress-tools');

            GDBTOCore::instance()->o['tweak_disable_breadcrumbs'] = isset($_POST['tweak_disable_breadcrumbs']) ? 1 : 0;
            GDBTOCore::instance()->o['tweak_tags_in_reply_for_authors_only'] = isset($_POST['tweak_tags_in_reply_for_authors_only']) ? 1 : 0;
            GDBTOCore::instance()->o['tweak_show_lead_topic'] = isset($_POST['tweak_show_lead_topic']) ? 1 : 0;

            update_option('gd-bbpress-tools', GDBTOCore::instance()->o);
            wp_redirect(add_query_arg('settings-updated', 'true'));
            exit();
        }

        if (isset($_POST['gdbb-views-submit'])) {

            check_admin_referer('gd-bbpress-tools');

            GDBTOCore::instance()->o['view_mostreplies_active'] = isset($_POST['view_mostreplies_active']) ? 1 : 0;
            GDBTOCore::instance()->o['view_latesttopics_active'] = isset($_POST['view_latesttopics_active']) ? 1 : 0;
            GDBTOCore::instance()->o['view_topicsfreshness_active'] = isset($_POST['view_topicsfreshness_active']) ? 1 : 0;

            update_option('gd-bbpress-tools', GDBTOCore::instance()->o);
            wp_redirect(add_query_arg('settings-updated', 'true'));
            exit();
        }

        if (isset($_POST['gdbb-bbcode-submit'])) {

            check_admin_referer('gd-bbpress-tools');

            $all_bbcodes = array(
                'b', 'u', 'i', 's', 'center', 'right', 'left', 'justify', 'sub', 'sup', 'pre',
                'reverse', 'list', 'ol', 'ul', 'li', 'blockquote', 'div', 'area', 'border',
                'hr', 'size', 'color', 'quote', 'url', 'google', 'youtube', 'vimeo', 'img',
                'note');

            $deactivate = array();
            $active = isset($_POST['bbcode_activated']) ? (array)$_POST['bbcode_activated'] : array();

            foreach ($all_bbcodes as $bbc) {
                if (!in_array($bbc, $active)) {
                    $deactivate[] = $bbc;
                }
            }

            GDBTOCore::instance()->o['bbcodes_active'] = isset($_POST['bbcodes_active']) ? 1 : 0;
            GDBTOCore::instance()->o['bbcodes_notice'] = isset($_POST['bbcodes_notice']) ? 1 : 0;
            GDBTOCore::instance()->o['bbcodes_bbpress_only'] = isset($_POST['bbcodes_bbpress_only']) ? 1 : 0;
            GDBTOCore::instance()->o['bbcodes_special_super_admin'] = isset($_POST['bbcodes_special_super_admin']) ? 1 : 0;
            GDBTOCore::instance()->o['bbcodes_special_roles'] = d4p_sanitize_basic_array((array)$_POST['bbcodes_special_roles']);
            GDBTOCore::instance()->o['bbcodes_special_action'] = d4p_sanitize_basic($_POST['bbcodes_special_action']);
            GDBTOCore::instance()->o['bbcodes_deactivated'] = $deactivate;

            update_option('gd-bbpress-tools', GDBTOCore::instance()->o);
            wp_redirect(add_query_arg('settings-updated', 'true'));
            exit();
        }

        if (isset($_POST['gdbb-tools-submit'])) {


            check_admin_referer('gd-bbpress-tools');

            GDBTOCore::instance()->o['include_always'] = isset($_POST['include_always']) ? 1 : 0;
            GDBTOCore::instance()->o['include_js'] = isset($_POST['include_js']) ? 1 : 0;
            GDBTOCore::instance()->o['include_css'] = isset($_POST['include_css']) ? 1 : 0;
            GDBTOCore::instance()->o['allowed_tags_div'] = isset($_POST['allowed_tags_div']) ? 1 : 0;
            GDBTOCore::instance()->o['kses_allowed_override'] = d4p_sanitize_basic($_POST['kses_allowed_override']);
            GDBTOCore::instance()->o['quote_active'] = isset($_POST['quote_active']) ? 1 : 0;
            GDBTOCore::instance()->o['quote_location'] = d4p_sanitize_basic($_POST['quote_location']);
            GDBTOCore::instance()->o['quote_method'] = d4p_sanitize_basic($_POST['quote_method']);
            GDBTOCore::instance()->o['quote_super_admin'] = isset($_POST['quote_super_admin']) ? 1 : 0;
            GDBTOCore::instance()->o['quote_roles'] = d4p_sanitize_basic_array((array)$_POST['quote_roles']);
            GDBTOCore::instance()->o['toolbar_active'] = isset($_POST['toolbar_active']) ? 1 : 0;
            GDBTOCore::instance()->o['toolbar_super_admin'] = isset($_POST['toolbar_super_admin']) ? 1 : 0;
            GDBTOCore::instance()->o['toolbar_roles'] = d4p_sanitize_basic_array((array)$_POST['toolbar_roles']);
            GDBTOCore::instance()->o['admin_disable_active'] = isset($_POST['admin_disable_active']) ? 1 : 0;
            GDBTOCore::instance()->o['admin_disable_super_admin'] = isset($_POST['admin_disable_super_admin']) ? 1 : 0;
            GDBTOCore::instance()->o['admin_disable_roles'] = d4p_sanitize_basic_array((array)$_POST['admin_disable_roles']);
            GDBTOCore::instance()->o['signature_active'] = isset($_POST['signature_active']) ? 1 : 0;
            GDBTOCore::instance()->o['signature_length'] = intval($_POST['signature_length']);
            GDBTOCore::instance()->o['signature_super_admin'] = isset($_POST['signature_super_admin']) ? 1 : 0;
            GDBTOCore::instance()->o['signature_roles'] = d4p_sanitize_basic_array((array)$_POST['signature_roles']);
            GDBTOCore::instance()->o['signature_method'] = d4p_sanitize_basic($_POST['signature_method']);
            GDBTOCore::instance()->o['signature_enhanced_super_admin'] = isset($_POST['signature_enhanced_super_admin']) ? 1 : 0;
            GDBTOCore::instance()->o['signature_enhanced_roles'] = d4p_sanitize_basic_array((array)$_POST['signature_enhanced_roles']);
            GDBTOCore::instance()->o['signature_buddypress_profile_group'] = d4p_sanitize_basic($_POST['signature_buddypress_profile_group']);

            update_option('gd-bbpress-tools', GDBTOCore::instance()->o);
            wp_redirect(add_query_arg('settings-updated', 'true'));
            exit();
        }
    }
}

global $gdbbpress_tools_admin;
$gdbbpress_tools_admin = new gdbbMod_Admin();
