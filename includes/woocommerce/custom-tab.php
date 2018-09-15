<?php
    add_action('template_redirect', function() {
        add_filter( 'woocommerce_product_tabs', 'woo_product_tabs_specifications' );
        function woo_product_tabs_specifications( $tabs ) {
            //Attribute Description tab
            $tabs['attrib_desc_tab'] = array(
                'title'     => __( 'Thông số kỹ thuật', 'pure' ),
                'priority'  => 100,
                'callback'  => 'woo_specifications_tab_content'
            );
            return $tabs;
        }

        // New Tab contents
        function woo_specifications_tab_content() {
            include_once DIR . "templates/tem_tab.php";
        }
    });
?>