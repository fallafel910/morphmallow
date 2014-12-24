<?php
define('MAGENTO_ROOT', (dirname(__FILE__).'/../../../../..'));
$mageFilename = MAGENTO_ROOT . '/app/Mage.php';
require_once $mageFilename;

umask(0);
if ( empty($_GET['store']) ) {
    $_GET['store'] = '';
}
Mage::app( $_GET['store'] );

header("Content-type: text/css; charset: UTF-8");
?>



/* Start primary Color */

    /* Color */
        .dropdown_detail a.selected, .dropdown_detail a:hover,
        .footer_link_box .link h1,
        .product-view .product-shop .no-rating a,
        .email-friend a,
        .product-view .product-shop .price-box .price,
        .customized .best_theme h2,
        .tabs li.active a,
        .product-view .box-tags .form-add label,
        .product-collateral .padder .form-add h3, .product-collateral .padder .form-add h4,
        .product-view .product-shop .add-to-links li a, .product-view .product-shop .add-to-links li,
        .product-essential h1,
        .product-view .product-shop .ratings .rating-links a,
        .product-view .box-reviews dt a,
        .block .block-title strong,
        .pager .pages li a:hover, .pager .pages li.current,
        .block li a:hover,
        div.wp-custom-menu-popup a.itemMenuName,
        div.wp-custom-menu-popup .itemSubMenu a.itemMenuName:hover,
        .products-list .product-name a,
        .products-list .price-box .price,
        .products-list .add-to-links li a, .products-list .add-to-links li,
        .products-list .ratings .rating-links a,
        #opc-login h4,
        .f-left, .left,
        .opc .active .step-title h2,
        .opc .active .step-title .number,
        .gift-messages h3,
        .gift-messages-form h4,
        .subtitle, .sub-title,
        .block-poll .block-subtitle,
        .fieldset .legend,
        .products-list .ratings .rating-links .separator,
        .onepagecheckout_datafields .op_block_title,
        .checkout-progress li.active,
        .multiple-checkout .col2-set h2.legend,
        .multiple-checkout h3, .multiple-checkout h4,
        .multiple-checkout .box h2,
        .multiple-checkout .place-order .grand-total big,
        .multiple-checkout .place-order .grand-total .price,
        .price-box .price-label,
        .dashboard .welcome-msg p strong,
        .box-account .box-head h2,
        .dashboard .box-content a,
        .dashboard .box-tags .tags strong, .dashboard .box-tags .tags ul, .dashboard .box-tags .tags ul li,
        .block-account .block-content li.current,
        .order-info .current,
        .order-items h2,
        .link-print,
        .addresses-list h2,
        .addresses-list a,
        .my-tag-edit strong,
        .default-container #nav li ul li a:hover,
        .product-view .product-shop .ratings .rating-links .separator,
        .advanced-search-summary strong,
        .menu_customlinks li a:hover
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('primary_color') ?>; }
    /* End Color */
    
    /* BG */
        .btn-remove:hover, .btn-edit:hover,
        button.button,
        .quick-view,
        .bx-wrapper .bx-next,
        .bx-wrapper .bx-prev,
        .footer-block,
        .scrollup,
        .text-box .go,
        .ui-slider-horizontal .ui-slider-handle,
        .customized .best_theme a span,
        div.alert a:hover,
        div.alert button:hover,
        .cart .totals .checkout-types button.btn-checkout:hover,
        .sorter .view-mode .grid-mode-active, .sorter .view-mode .grid-mode-active:hover,
        .sorter .view-mode .list-mode-active, .sorter .view-mode .list-mode-active:hover,
        #sidenav li a.active,
        #sidenav li a.show-cat:hover,
        .buttons-set .back-link a,
        .block-progress dt.complete,
        .bx-wrapper .bx-pager.bx-default-pager a:hover, .bx-wrapper .bx-pager.bx-default-pager a.active,
        .close_la:hover,
        .dashboard .box-reviews .number,
        .dashboard .box-tags .number,
        .toggleMenu,
        #menu-button a,
        .sale
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('primary_color') ?>; }
        
        <?php
        $hex =  "#".Mage::helper("ExtraConfig")->themeOptions('primary_color'); 
        $val = Mage::helper("ExtraConfig")->html2rgb($hex);
        ?>
        .products-grid .productgrid-area,
        .banner .summer_box
        {  background-color: rgba(<?php echo $val[0]; ?>,<?php echo $val[1]; ?>,<?php echo $val[2]; ?>, 0.85); }
        
        <?php
        $hex3 =  "#".Mage::helper("ExtraConfig")->themeOptions('primary_color'); 
        $val3 = Mage::helper("ExtraConfig")->html2rgb($hex3);
        ?>
        div.ajaxcartpro_progress
        {  background-color: rgba(<?php echo $val3[0]; ?>,<?php echo $val3[1]; ?>,<?php echo $val3[2]; ?>, 0.40); }
    /* End BG */
    
    /* Border */
        .opc .active .step-title .number
        {  border-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('primary_color') ?>; }
    /* End border */
    
    /* Border Left */
        
        {  border-left-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('primary_color') ?>; }
    /* End Border Left */
    
    /* Border Top */
        .checkout-progress li.active,
        .menu_customlinks,
        .default-container #nav li ul li ul.shown-sub
        {  border-top-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('primary_color') ?>; }
    /* End Border Top */
    
/* End primary Color */


/* Start Secondary Color */
    /* BG */
        .header .quick-access,
        .block,
        .product-view .more-views,
        .tabs li a,
        .customized,
        .data-table thead th,
        .cart .discount, .cart .shipping,
        .cart .totals,
        div.wp-custom-menu-popup,
        div.menu.act a, div.menu.active a, div.menu .parentMenu a:hover,
        .col2-set .col-1,
        .col2-set .col-2,
        .opc .gift-messages-form,
        .checkout-multishipping-shipping .box-sp-methods,
        .default-container #nav li a.over, .default-container #nav a:hover, .default-container #nav li.level0.active a.level-top,
        #nav ul
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('secondary_color') ?>; !important}
    /* BG */
/* End Secondary Color */


/* Start button color */

    button.button,
    .buttons-set .back-link a,
    .customized .best_theme a span,
    div.alert a:hover,
    .banner .container a,
    .cart .totals .checkout-types button.btn-checkout:hover,
    .btn-remove:hover, .btn-edit:hover,
    .block .btn-remove:hover,
    #sidenav li a.active,
    #sidenav li a.show-cat:hover,
    .close_la:hover
    {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('buttonaerrow_color') ?>; }

/* End button color */


/*  button hover color */

    button.button:hover,
    .buttons-set .back-link a:hover,
    .customized .best_theme a span:hover,
    div.alert a,
    .banner .container a:hover,
    .cart .totals .checkout-types button.btn-checkout,
    .btn-remove, .btn-edit,
    .block .btn-remove,
    #sidenav li a.show-cat,
    .close_la
    {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('buttonhover_color') ?>; }

/* End button hover color */

/* border */

    /* border color */
        .dropdown_detail,
        .dropdown:hover,
        .sorter .sort_box, .sorter .show_box,
        .product-view .more-views,
        .tabs li a,
        input.input-text, select, textarea,
        .opc .gift-messages-form,
        .onepagecheckout_datafields .col-1 .form_fields input.t1,
        .onepagecheckout_datafields .col-1 .form_fields div.full input.t1,
        .op_login_area,
        .toptital,
        .multiple-checkout .col2-set, .multiple-checkout .col3-set,
        .checkout-multishipping-shipping .box-sp-methods,
        .header .form-search:hover,
        .header2 .shopping_bg,
        .products-grid li.item,
        .products-list .product-image,
        .product-view .product-img-box .product-image,
        .product-view .product-img-box .more-views li a
        {  border-color:  #<?php echo Mage::helper("ExtraConfig")->themeOptions('border_color') ?>; }
    /* End border color */
    
    /* left border color */
        
        {  border-left-color:  #<?php echo Mage::helper("ExtraConfig")->themeOptions('border_color') ?>; }
    /* End left border color */
    
     /* right border color */
        
        {  border-right-color:  #<?php echo Mage::helper("ExtraConfig")->themeOptions('border_color') ?>; }
     /* End right border color */
     
     /* bottom border color */
        .block-cart .block-subtitle,
        .mini-products-list li,
        .page-title,
        .footer_link_box .link ul li,
        .footer .footer_link_box,
        .dropdown_detail a,
        .block .block-title strong,
        .sorter,
        .data-table td,
        .cart .discount h2, .cart .shipping h2,
        .cart .totals table,
        .products-list .productlist-area,
        .products-list li.item,
        .fancy.product-view .product-shop .product-name,
        .product-view .product-shop .short-description,
        .product-view .product-shop .short-description,
        .product-view .product-shop .add-to-cart,
        .menuwithlogo.fixed,
        .data-table tbody th,
        div.wp-custom-menu-popup a.itemMenuName,
        #opc-login h3,
        .account-login .content h2,
        .fieldset .legend,
        .onepagecheckout_datafields .op_block_title,
        .product-options,
        .box-account .box-head,
        .dashboard .box .box-title,
        .dashboard .box-info h4,
        .order-info-box h2,
        .order-items h2,
        .data-table tbody.odd tr.border td, .data-table tbody.even tr.border td,
        .addresses-list h2,
        .slideTogglebox .top-image,
        .menu-block h2
        {  border-bottom-color:  #<?php echo Mage::helper("ExtraConfig")->themeOptions('border_color') ?>; }
     /* End bottom border color */
     
     /* End top border color */
        .menuwithlogo,
        .block-cart .subtotal,
        .footer_link_box .link p,
        .block .actions,
        #content,
        .products-list .productlist-area,
        .buttons-set,
        .checkout-progress li,
        .menu_customlinks
        {  border-top-color:  #<?php echo Mage::helper("ExtraConfig")->themeOptions('border_color') ?>; }
     /* End top border color */
/* End border */


/* Start Menu */
    /* top Menu background */
        .menuwithlogo,
        .menuwithlogo.fixed,
        .toggleMenu,
        #menu-button a
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('topmenu_background') ?>; }
    /* End top Menu background */
    
    /* Menu TopFonts */
        <?php $topmenu_fonts = Mage::helper("ExtraConfig")->themeOptions('topmenu_fonts'); ?>
        <?php if(isset($topmenu_fonts) && $topmenu_fonts != null && $topmenu_fonts != '--select--')   {  ?>
                
                    .default-container #nav li.level0 a.level-top,
                    div.menu a,
                    #custommenu-mobile .level0
                    {font-family: '<?php echo $topmenu_fonts; ?>'!important;}
                    
        <?php } ?>
    /* End TopMenu Fonts */
    
    /* Menu top Fonts Color */
        .default-container #nav li.level0 a.level-top,
        div.menu a,
        .toggleMenu,
        #menu-button a
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('topmenu_fonts_color') ?>; }
    /* End top Menu Fonts Color */
    
    /* Menu top Fonts hover Color */
        
        .default-container #nav li.level0 a.level-top:hover,
        .default-container #nav li.level0.active a.level-top,
        .default-container #nav li.level0 a.level-top.over,
        div.menu a:hover,
        div.menu.active a,
        div.menu.act a
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('topmenu_fontshover_color') ?>; }
    /* End top Menu Fonts hover Color */
    
    /* Menu top Fonts hover bg Color */
        div.menu.act a, div.menu.active a, div.menu .parentMenu a:hover,
        .default-container #nav li.level0 a.level-top.over,
        .default-container #nav li.level0 a.level-top:hover,
        .default-container #nav li.level0.active a.level-top
        { background: #<?php echo Mage::helper("ExtraConfig")->themeOptions('topmenu_fontshover_bg_color') ?>; }
    /* End top Menu Fonts hover bg Color */
    
    /* Menu background */
        #nav ul,
        div.wp-custom-menu-popup
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('menu_background') ?>; }
    /* End Menu background */
    
    /* SubMenu Fonts */
        <?php $submenu_fonts = Mage::helper("ExtraConfig")->themeOptions('submenu_fonts'); ?>
        <?php if(isset($submenu_fonts) && $submenu_fonts != null && $submenu_fonts != '--select--')   {  ?>
                
        div.wp-custom-menu-popup a.itemMenuName
        {font-family: '<?php echo $submenu_fonts; ?>'!important;}
                    
        <?php } ?>
    /* End SubMenu Fonts */
    
    /* SubMenu Fonts Color */
        div.wp-custom-menu-popup a.itemMenuName
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('submenu_fonts_color') ?>; }
    /* End SubMenu Fonts Color */
    
    /* SubMenu Fonts Hover Color */
        div.wp-custom-menu-popup a.itemMenuName:hover
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('submenu_fontshover_color') ?>; }
    /* End SubMenu Fonts Hover Color */
    
    /* Menu Fonts */
        <?php $menu_fonts = Mage::helper("ExtraConfig")->themeOptions('menu_fonts'); ?>
        <?php if(isset($menu_fonts) && $menu_fonts != null && $menu_fonts != '--select--')   {  ?>
                
        .default-container #nav li ul li a,
        div.wp-custom-menu-popup .itemSubMenu a.itemMenuName,
        .menu_customlinks li,
        #custommenu-mobile .level1
        {font-family: '<?php echo $menu_fonts; ?>'!important;}
                    
        <?php } ?>
    /* End Menu Fonts */
    
    /* Menu Fonts Color */
        .default-container #nav li ul li a,
        div.wp-custom-menu-popup .itemSubMenu a.itemMenuName,
        .menu_customlinks li a,
        .menu_customlinks li
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('menu_fonts_color') ?>; }
    /* End Menu Fonts Color */
    
    /* Menu Fonts Hover Color */
        .default-container #nav li ul li a:hover,
        div.wp-custom-menu-popup .itemSubMenu a.itemMenuName:hover,
        .menu_customlinks li a:hover
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('menu_fontshover_color') ?>; }
    /* End Menu Fonts Hover Color */
    
    /* border color */
        .menuwithlogo,
        div.wp-custom-menu-popup a.itemMenuName,
        .menu-block h2,
        .menu_customlinks
        { border-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('menu_border_color') ?>; }
    /* End border Color */
/* End Menu */


/* Start Sidebar */
    
    /* Sidebar BG Color */
        <?php $sidebar_bg = Mage::helper("ExtraConfig")->themeOptions('sidebar_background_color'); ?>  
        .block
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sidebar_background_color') ?>; }
    /* End Sidebar BG Color */
    
    /* Sidebar Title Font */
        <?php $sidebartitlefont = Mage::helper("ExtraConfig")->themeOptions('sidebar_title_fonts'); ?>
        <?php   if(isset($sidebartitlefont) && $sidebartitlefont != null && $sidebartitlefont != '--select--')   {  ?>
                
                    .block .block-title strong
                    {font-family: '<?php echo $sidebartitlefont; ?>';}
                    
        <?php } ?>
    /* End Sidebar Title Font */
    
    /* Sidebar Title fonts Color */
        .block .block-title strong
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sidebar_title_fonts_color') ?>; }
    /* End Sidebar Title fonts Color */
    
    /* Sidebar Title fonts bg Color */
        .block .block-title
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sidebar_title_fonts_bg_color') ?>; }
    /* End Sidebar Title fonts bg Color */

    /* Sidebar Fonts Color */
        .block-layered-nav dt,
        .block-poll label,
        .block .block-subtitle,
        .block-subscribe label,
        .block .price-box .price,
        .block .block-content
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sidebar_fonts_color') ?>; }
    /* End Sidebar Fonts Color */
    
    /* Sidebar Link Color */
        .block li a,
        .block .actions a
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sidebar_link_color') ?>; }
    /* End Sidebar Link Color */
    
    /* Sidebar Link Hover Color */
        .block li a:hover,
        .block .actions a:hover
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sidebar_linkhover_color') ?>; }
    /* End Sidebar Link Hover Color */
    
    /* Sidebar Seperator Color */
        .block .actions,
        .block-wishlist .block-content li.item
        {  border-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sidebar_seperator_color') ?>; }
    /* End Sidebar Seperator Color */
    
/* End Sidebar */


/* Start Header */
    /* Header BG */
    <?php
    $headerbg_color = Mage::helper("ExtraConfig")->themeOptions('headerbg_color');
    $headerbg_pattern = Mage::helper("ExtraConfig")->themeOptions('headerbg_pattern');
    $headerbg_image = Mage::helper("ExtraConfig")->themeOptions('headerbg_image');
    ?>
    
    <?php if(isset($headerbg_color) && $headerbg_color != null){  ?>
                
                            .header-container
                            {
                                  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('headerbg_color') ?>; 
                            }
                            
                <?php } elseif(isset($headerbg_pattern) && $headerbg_pattern != null) { ?>
                    
                            .header-container
                            {
                                background-image: url(<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'pattern/'.Mage::helper("ExtraConfig")->themeOptions('headerbg_pattern') ?>);
                            }    
                    
                <?php }	elseif(isset($headerbg_image) && $headerbg_image != null) { ?>
                    
                            .header-container           
                            {
                                    background-image: url(<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'custom/image/'.Mage::helper("ExtraConfig")->themeOptions('headerbg_image') ?>);
                                    background-attachment: <?php echo Mage::helper("ExtraConfig")->themeOptions('headerbg_attachment') ?>;
                                     background-position: <?php echo Mage::helper("ExtraConfig")->themeOptions('headerbg_position_y') ?> <?php echo Mage::helper("ExtraConfig")->themeOptions('headerbg_position_x') ?>;
                                    background-repeat: <?php echo Mage::helper("ExtraConfig")->themeOptions('headerbg_repeat') ?>;
                                    
                                    <?php if (Mage::helper("ExtraConfig")->themeOptions('headerbg_attachment') == 'fixed')
                                        {
                                    ?>
                                        background-size: 100%;
                                    <?php	} ?>
                            }    
                    
    <?php } else{} ?>
    /* End Header BG */

    /* Header BG */
        .header .quick-access
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('header_topblock_color') ?>; }
    /* End Header BG */
    
    /* Header Link Color */
        .header .links a
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('header_link_color') ?>; }
    /* End Header Link Color */
    
    /* Header Link Hover Color */
        .header .links a:hover
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('header_linkhover_color') ?>; }
    /* End Header Link Hover Color */
    
    /* sticky header */
        <?php $sticky_header = Mage::helper("ExtraConfig")->themeOptions('sticky_header'); ?>
        <?php if($sticky_header == '0' || Mage::helper("ExtraConfig")->is_mobile() == true) { ?>
            .menuwithlogo.fixed{position: inherit;margin-top:30px;border-bottom:none;}
        <?php } ?>
    /* End sticky header */
    
/* End Header */


/* Banner */
    
    /* Banner Title Color */
        .banner .container h2
        {color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('banner_title_color') ?>;}
    /* End Banner Title Color */
    
    /* Banner Content Color */
        .banner .container p
        {color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('banner_content_color') ?>;}
    /* End Banner Title Color */
    
    /* Banner Title size */
        .banner .container h2
        {font-size: <?php echo Mage::helper("ExtraConfig")->themeOptions('banner_title_fontsize') ?>px;}
    /* End Banner Title size */
    
    /* view-more Color */
        .banner .container a
        {color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('view_color') ?>;}
    /* End view-more Color */
    
    /* view-more hover Color */
        .banner .container a:hover
        {color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('view_hover_color') ?>;}
    /* End view-more hover Color */
    
    /* banner content bg Color */
         <?php
        $hex1 =  "#".Mage::helper("ExtraConfig")->themeOptions('banner_content_bg'); 
        $val1 = Mage::helper("ExtraConfig")->html2rgb($hex1);
        ?>
        .banner .summer_box
        {  background-color: rgba(<?php echo $val1[0]; ?>,<?php echo $val1[1]; ?>,<?php echo $val1[2]; ?>, 0.85); }
    /* End banner content bg Color */
/* End Banner */

/* Start Footer */
    <?php
    $footer_background_color = Mage::helper("ExtraConfig")->themeOptions('footer_background_color');
    $footer_background_pattern = Mage::helper("ExtraConfig")->themeOptions('footer_background_pattern');
    $footer_background_image = Mage::helper("ExtraConfig")->themeOptions('footer_background_image');
    ?>
    
    <?php if(isset($footer_background_color) && $footer_background_color != null) {  ?>
            
            
                   .footer-container
                    {
                          background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('footer_background_color') ?>; 
                    }
                    
            <?php } elseif(isset($footer_background_pattern) && $footer_background_pattern != null) { ?>
            
                    .footer-container
                    {
                        background-image: url(<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'pattern/'.Mage::helper("ExtraConfig")->themeOptions('footer_background_pattern') ?>);
                    }
                    
            <?php } elseif(isset($footer_background_image) && $footer_background_image != null) { ?>
            
                    .footer-container          
                    {
                            background-image: url(<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'custom/image/'.Mage::helper("ExtraConfig")->themeOptions('footer_background_image') ?>);
                            background-attachment: <?php echo Mage::helper("ExtraConfig")->themeOptions('footer_background_attachment') ?>;
                             background-position: <?php echo Mage::helper("ExtraConfig")->themeOptions('footer_background_position_y') ?> <?php echo Mage::helper("ExtraConfig")->themeOptions('footer_background_position_x') ?>;
                            background-repeat: <?php echo Mage::helper("ExtraConfig")->themeOptions('footer_background_repeat') ?>;
                            
                            <?php if (Mage::helper("ExtraConfig")->themeOptions('footer_background_attachment') == 'fixed')
				{
                            ?>
				background-size: 100%;
                            <?php	} ?>
                    }    
            
    <?php } else{} ?>
    
    /* Footer Font Color */
        .footer address,
        .footer_link_box .link p
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('footer_font_color') ?>; }
    /* End Footer Font Color */
    
    /* Footer Linkbox title Color */
        
        .footer_link_box .link h1
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('footer_link_title_color') ?>; }
    /* End Footer Linkbox title Color */
    
    /* Footer Link Color */
        
        .footer a
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('footer_link_font_color') ?>; }
    /* End Footer Link Color */

    /* Footer Linkhover Color */
        .footer a:hover
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('footer_linkhover_font_color') ?>; }
    /* End Footer Linkhover Color */
    
    /* Footer border Color */
        .footer .footer_link_box,
        .footer_link_box .link ul li,
        .footer_link_box .link p
        {  border-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('footer_border_color') ?>; }
    /* End border Color */
    
    /* Footer topblock bg Color */
        .footer-block
        {  background: #<?php echo Mage::helper("ExtraConfig")->themeOptions('footer_topblock_bg') ?>; }
    /* End Footer topblock bg Color */
    
    /* Footer topblock Color */
        .footer-block .free-shipping h2,
        .footer-block .free-shipping .truck-img,
        .footer-block .newaletter h2
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('footer_topblock_color') ?>; }
    /* End Footer topblock Color */
/* End Footer */




/* start Background Option */

<?php
$background_color = Mage::helper("ExtraConfig")->themeOptions('background_color');
$background_pattern = Mage::helper("ExtraConfig")->themeOptions('background_pattern');
$background_image = Mage::helper("ExtraConfig")->themeOptions('background_image');
?>

 <?php  if(isset($background_color) && $background_color != null) {  ?>
		
            body
                {
                    background-color:#<?php echo Mage::helper("ExtraConfig")->themeOptions('background_color') ?>;
                }
            .tabs li.active a,
            .tabs li a:hover
            {
            border-bottom-color:#<?php echo Mage::helper("ExtraConfig")->themeOptions('background_color') ?>;
            }
<?php	}  elseif(isset($background_pattern) && $background_pattern != null){ ?>
        
            body
                {
                    background-image: url(<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'pattern/'.Mage::helper("ExtraConfig")->themeOptions('background_pattern') ?>);
                }    
<?php   } elseif(isset($background_image) && $background_image != null){ ?>

                body            
                {
                        background-image: url(<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'custom/image/'.Mage::helper("ExtraConfig")->themeOptions('background_image') ?>);
                        background-attachment: <?php echo Mage::helper("ExtraConfig")->themeOptions('bg_attachment') ?>;
                         background-position: <?php echo Mage::helper("ExtraConfig")->themeOptions('bg_position_y') ?> <?php echo Mage::helper("ExtraConfig")->themeOptions('bg_position_x') ?>;
                        background-repeat: <?php echo Mage::helper("ExtraConfig")->themeOptions('bg_repeat') ?>;
			
			<?php if (Mage::helper("ExtraConfig")->themeOptions('bg_attachment') == 'fixed')
				{
			?>
				background-size: 100%;
			<?php	} ?>
			
                }    
        
<?php   } else { } ?>

/* End Background Option */


/* product list */
    
    /* AjaxPopup */
        <?php $ajaxpopup = Mage::helper("ExtraConfig")->themeOptions('ajaxpopup');
        if($ajaxpopup == '0'){ ?>
        .alert{display: none !important;}
        <?php } ?>
    /* End AjaxPopup */
    
    /* border color */
        .products-grid li.item,
        .products-list .product-image,
        .product-view .product-img-box .product-image,
        .product-view .product-img-box .more-views li a
        {border-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('product_border') ?>; }
    /* end border color */
    
    /* Show border */
        <?php $show_border = Mage::helper("ExtraConfig")->themeOptions('show_border');
        if($show_border == '0'){ ?>
            .products-grid li.item{border: 1px solid transparent;}
        <?php } ?>
    /* End Show border */
    
   /* Product Image BG */
        .products-grid .content_top,
        .products-list .product-image,
        .product-view .product-img-box .product-image,
        .product-view .product-img-box .more-views li a,
        .fancy.product-view a.product-image
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('product_image_bg') ?>; }
    /* End Product Image BG */
    
    /* Product content BG */
        <?php
        $hex2 =  "#".Mage::helper("ExtraConfig")->themeOptions('product_content_bg'); 
        $val2 = Mage::helper("ExtraConfig")->html2rgb($hex2);
        ?>
        .products-grid .productgrid-area
        {  background-color: rgba(<?php echo $val2[0]; ?>,<?php echo $val2[1]; ?>,<?php echo $val2[2]; ?>, 0.85); }
    /* End Product content BG */
    
    /* AddtoCart button background */
        .products-list .f-fix button.button.btn-cart,
        .product-view .product-shop button.button.btn-cart
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('addtocart_bg') ?>; }
    /* End AddtoCart button background */
    
    /* AddtoCart button color */
        .products-grid li button.button,
        .products-list .f-fix button.button.btn-cart,
        .product-view .product-shop button.button.btn-cart
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('addtocart_color') ?>; }
    /* End AddtoCart button color */
    
    /* AddtoCart button hover bg */
        .products-list .f-fix button.button.btn-cart:hover,
        .product-view .product-shop button.button.btn-cart:hover
        {   background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('addtocart_hover_bg') ?>; }
    /* End AddtoCart button hover bg */
    
    /* AddtoCart button hover color */
        .products-grid li button.button:hover,
        .products-list .f-fix button.button.btn-cart:hover,
        .product-view .product-shop button.button.btn-cart:hover
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('addtocart_hover_color') ?>; }
    /* End AddtoCart button hover color */
    
    /* button font */
        <?php $buttonfont = Mage::helper("ExtraConfig")->themeOptions('button_fonts'); ?>
        <?php if(isset($buttonfont) && $buttonfont != null && $buttonfont != '--select--')  {  ?>
                   
        .products-grid li button.button,
        .products-list .f-fix button.button.btn-cart,
        .product-view .product-shop button.button.btn-cart
        {font-family: '<?php echo $buttonfont; ?>';}
                
        <?php } ?>
    /* end button font */
    
    /* Product name color */
        .products-grid .product-name a,
        .products-list .product-name a,
        .product-essential h1
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('productname_color') ?>; }
    /* End Product name color */
    
    /* Product name hover color */
        
       .products-grid .product-name a:hover,
       .products-list .product-name a:hover
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('productname_hover_color') ?>; }
    /* End Product name hover color */
    
    /* productname font */
        <?php $productnamefont = Mage::helper("ExtraConfig")->themeOptions('productname_fonts'); ?>
        <?php if(isset($productnamefont) && $productnamefont != null && $productnamefont != '--select--')  {  ?>
                   
            .products-grid .product-name a,
            .products-list .product-name a,
            .product-essential h1
            {font-family: '<?php echo $productnamefont; ?>';}
                
        <?php } ?>
    /* end productname font */
    
     /* Product price color */
        .products-grid li .price-box .price,
        .products-list .price-box .price,
        .product-view .product-shop .price-box .price
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('product_price_color') ?>; }
    /* End Product price color */
    
    /* productprice font */
        <?php $productpricefont = Mage::helper("ExtraConfig")->themeOptions('product_price_fonts'); ?>
        <?php if(isset($productpricefont) && $productpricefont != null && $productpricefont != '--select--')  {  ?>
                   
            .products-grid li .price-box .price,
            .products-list .price-box .price,
            .product-view .product-shop .price-box .price
            {font-family: '<?php echo $productpricefont; ?>';}
                
        <?php } ?>
    /* end productprice font */
    
    /* Addto links color */
        .products-grid li .add-to-links a,
        .products-list .add-to-links li a, .products-list .add-to-links li,
        .product-view .product-shop .add-to-links li a, .product-view .product-shop .add-to-links li
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('addto_color') ?>; }
    /* End Addto links color */
    
     /* Addto links hover color */
        .products-grid li .add-to-links a:hover,
        .products-list .add-to-links li a:hover,
        .product-view .product-shop .add-to-links li a:hover
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('addto_hover_color') ?>; }
    /* End Addto links hover color */
    
    /* Quickview color */
        .quick-view
        {   color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('quickview_color') ?>; }
    /* End Quickview color */
    
    /* Quickview hover color */
        .quick-view:hover
        {   color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('quickview_hover_color') ?>; }
    /* End Quickview hover color */
    
    /* Quickview bg color */
        .quick-view
        {   background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('quickview_bg_color') ?>; }
    /* End Quickview bg color */
    
    /* Quickview hover bg color */
        .quick-view
        {   background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('quickview_hover_bg_color') ?>; }
    /* End Quickview hover bg color */
    
    /* New color */
        .new
        {   color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('new_color') ?>; }
    /* End New color */
    
    /* New color */
        .new
        {   color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('new_bg_color') ?>; }
    /* End New color */
    
    /* Sale color */
        .sale
        {   color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sale_color') ?>; }
    /* End Sale color */
    
    /* Sale color */
        .sale
        {   color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('sale_bg_color') ?>; }
    /* End Sale color */
    
/* end product list */


/* Theme Fonts Settings */
    <?php
    $titlefont = Mage::helper("ExtraConfig")->themeOptions('titlefont');
    $bodyfont = Mage::helper("ExtraConfig")->themeOptions('bodyfont');
    ?>
    
    /* Title font */
        <?php if(isset($titlefont) && $titlefont != null && $titlefont != '--select--')  {  ?>
                   
            .page-title h1,
            .page-title h2
            {font-family: '<?php echo $titlefont; ?>';}
                
        <?php } ?>
    /* end Title font */
    
    /* Title color */
        .page-title
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('titlefont_color') ?>; }
    /* End Title color */
    
    /* Title Font size */
        .page-title h1,
        .page-title h2
        {  font-size: <?php echo Mage::helper("ExtraConfig")->themeOptions('titlefont_size') ?>px; }
    /* End Title Font size */
    
    /* Body font */	
        <?php if(isset($bodyfont) && $bodyfont != null && $bodyfont != '--select--')  {  ?>
            
                    body,
                    input, select option, textarea
                    {font-family: '<?php echo $bodyfont; ?>';}
                
        <?php } ?>	
    /* End Body font */
    
    /* Body font Color */
        body,
        a
        {  color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('bodyfont_color') ?>; }
    /* End Body font Color */
    
    /* Body font size */
        body,
        {  font-size: <?php echo Mage::helper("ExtraConfig")->themeOptions('bodyfont_size') ?>px; }
    /* End Body font size */
/* End Theme Fonts Settings */



/* boxlayout */
    <?php $boxlayout = Mage::helper("ExtraConfig")->themeOptions('boxlayout'); ?>
    <?php if($boxlayout == '1') { ?>
        .page {width:1220px; margin: 0 auto; max-width: 100%; box-shadow: 4px 0px 6px -4px rgba(0, 0, 0, 0.25), -4px 0px 6px -4px rgba(0, 0, 0, 0.25);}
        .page{  background: #<?php echo Mage::helper("ExtraConfig")->themeOptions('boxlayout_bg') ?>; }
        .menuwithlogo.fixed{width:1220px; max-width:100%;}
    <?php } ?>
    
    <?php if($boxlayout == '2') { ?>
        .page {width:1220px; margin: 0 auto; max-width: 100%;}
        .page{  background: #<?php echo Mage::helper("ExtraConfig")->themeOptions('boxlayout_bg') ?>; }
        .menuwithlogo.fixed{width:1220px; max-width:100%;}
    <?php } ?>
/* End boxlayout */

/* Select Box */
    /* Background */
        .dropdown_detail a:hover
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('select') ?>; }
    /* Background */
    
/* End select box */

/* Select bg Box */
    /* Background */
        .dropdown:hover,
        .dropdown_detail
        {  background-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('select_bg') ?>; }
    /* Background */
    
/* End select bg box */

/* Select link color */
        .dropdown_detail a,
        .dropdown
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('select_link_color') ?>; }
/* End select link color */

/* Select link hover color */
        .dropdown_detail a.selected, .dropdown_detail a:hover
        { color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('select_linkhover_color') ?>; }
/* End select link hover color */

/* selectbox border color */
        .dropdown_detail a,
        .dropdown_detail,
        .dropdown:hover,
        .sorter .sort_box, .sorter .show_box
        { border-color: #<?php echo Mage::helper("ExtraConfig")->themeOptions('select_border_color') ?>; }
/* End selectbox border color */


/* Customcss */
    <?php echo Mage::helper("ExtraConfig")->themeOptions('customcss'); ?>
/* End Customcss */

/* Zoom */
    <?php if(Mage::helper("ExtraConfig")->is_mobile() == true) { ?>
    .cloud-zoom-lens,
    .cloud-zoom-big{display: none !important;}
    <?php } ?>
/* End Zoom */

/* cart */
    <?php if(Mage::helper("ExtraConfig")->is_mobile() == true) { ?>
    .slideTogglebox{visibility: inherit; opacity: 1;display:none;}
    .currency_detail{visibility: inherit; opacity: 1;display:none;}
    .language_detail{visibility: inherit; opacity: 1;display:none;}
    .sort_detail{visibility: inherit; opacity: 1;display:none;}
    .show_detail{visibility: inherit; opacity: 1;display:none;}
    <?php } ?>
/* end cart */