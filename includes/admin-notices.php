<?php

/**
 * Admin Notice Plugins Required
 * @since 0.5
 */
function smfedd_admin_notice_plugins_required(){
            ?>
            <div class="notice notice-error is-dismissable">
                <p>Saucy Menus for EDD Plugin required: <strong>Easy Digital Downloads &amp; If Menu</strong> to be installed and activated.</p>
            </div>
            <?php
}

if( ! class_exists( 'If_Menu' ) ) {

	add_action('admin_notices', 'smfedd_admin_notice_plugins_required');

}