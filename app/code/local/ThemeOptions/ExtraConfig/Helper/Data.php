<?php 
class ThemeOptions_ExtraConfig_Helper_Data extends Mage_Core_Helper_Abstract
{
    
    function is_mobile()
    {
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$mobiles = array("android", "iphone", "ipod", "ipad",
		"blackberry", "palm", "mobile", "mini", "kindle");
	foreach($mobiles as $mobile)
	{
		if(strpos($ua,$mobile)) return true;
	}
	return false;
    }
    
    function html2rgb($rgb)
    {
	if ($rgb[0] == '#')
	    $rgb = substr($rgb, 1);
    
	if (strlen($rgb) == 6)
	    list($r, $g, $b) = array($rgb[0].$rgb[1],
				     $rgb[2].$rgb[3],
				     $rgb[4].$rgb[5]);
	elseif (strlen($rgb) == 3)
	    list($r, $g, $b) = array($rgb[0].$rgb[0], $rgb[1].$rgb[1], $rgb[2].$rgb[2]);
	else
	    return false;
    
	$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
     
	return array($r, $g, $b);
    }
    
    function jsString($str='')
    { 
        return trim(preg_replace("/('|\"|\r?\n)/", '', $str)); 
    }
    
    
    function themeOptions ($themeOption)
    {
	switch ($themeOption)
	{
            
        /* background color and Pattern */
	    
	    
	    case 'background_pattern':
		return Mage::getStoreConfig('mygeneral/background/background_pattern', Mage::app()->getStore()->getId());
	    break; 
	    case 'background_color':
		return Mage::getStoreConfig('mygeneral/background/background_color', Mage::app()->getStore()->getId());
	    break;
	    case 'background_image':
		return Mage::getStoreConfig('mygeneral/background/background_image', Mage::app()->getStore()->getId());
	    break;
	    case 'bg_repeat':
		return Mage::getStoreConfig('mygeneral/background/bg_repeat', Mage::app()->getStore()->getId());
	    break;  
	    case 'bg_attachment':
		return Mage::getStoreConfig('mygeneral/background/bg_attachment', Mage::app()->getStore()->getId());
	    break;  
	    case 'bg_position_x':
		return Mage::getStoreConfig('mygeneral/background/bg_position_x', Mage::app()->getStore()->getId());
	    break; 
	    case 'bg_position_y':
		return Mage::getStoreConfig('mygeneral/background/bg_position_y', Mage::app()->getStore()->getId());
	    break;   
	
            
         
	   
	    
            /* COLORS */
            
            case 'primary_color':
                return Mage::getStoreConfig('mygeneral/colors/primary_color');
             break;
	     case 'secondary_color':
                return Mage::getStoreConfig('mygeneral/colors/secondary_color');
             break;
	     case 'buttonaerrow_color':
                return Mage::getStoreConfig('mygeneral/colors/buttonaerrow_color');
             break;
	     case 'buttonhover_color':
                return Mage::getStoreConfig('mygeneral/colors/buttonhover_color');
             break;
	     case 'border_color':
                return Mage::getStoreConfig('mygeneral/colors/border_color');
             break;
	

	
	/* Menu */
            
	    case 'topmenu_background':
                return Mage::getStoreConfig('mygeneral/menu/topmenu_background');
             break;
	     case 'topmenu_fonts':
                return Mage::getStoreConfig('mygeneral/menu/topmenu_fonts');
             break;
	    case 'topmenu_fonts_color':
                return Mage::getStoreConfig('mygeneral/menu/topmenu_fonts_color');
             break;
	    case 'topmenu_fontshover_color':
                return Mage::getStoreConfig('mygeneral/menu/topmenu_fontshover_color');
             break;
	    case 'topmenu_fontshover_bg_color':
                return Mage::getStoreConfig('mygeneral/menu/topmenu_fontshover_bg_color');
             break;
             case 'menu_background':
                return Mage::getStoreConfig('mygeneral/menu/menu_background');
             break;
            case 'submenu_fonts':
                return Mage::getStoreConfig('mygeneral/menu/submenu_fonts');
             break;
	     case 'submenu_fonts_color':
                return Mage::getStoreConfig('mygeneral/menu/submenu_fonts_color');
             break;
	     case 'submenu_fontshover_color':
                return Mage::getStoreConfig('mygeneral/menu/submenu_fontshover_color');
             break;
	    case 'menu_fonts':
                return Mage::getStoreConfig('mygeneral/menu/menu_fonts');
             break;
	     case 'menu_fonts_color':
                return Mage::getStoreConfig('mygeneral/menu/menu_fonts_color');
             break;
            case 'menu_fontshover_color':
                return Mage::getStoreConfig('mygeneral/menu/menu_fontshover_color');
             break;
	    case 'menu_border_color':
                return Mage::getStoreConfig('mygeneral/menu/menu_border_color');
             break;
	     case 'homelink':
                return Mage::getStoreConfig('mygeneral/menu/homelink');
             break;
	    
	     
	     
	
	/* Sidebar */
            
            case 'sidebar_background_color':
                return Mage::getStoreConfig('mygeneral/sidebar/sidebar_background_color');
             break;
	     case 'sidebar_title_fonts':
                return Mage::getStoreConfig('mygeneral/sidebar/sidebar_title_fonts');
             break;
	     case 'sidebar_title_fonts_color':
                return Mage::getStoreConfig('mygeneral/sidebar/sidebar_title_fonts_color');
             break;
            case 'sidebar_title_fonts_bg_color':
                return Mage::getStoreConfig('mygeneral/sidebar/sidebar_title_fonts_bg_color');
             break;
	     case 'sidebar_fonts_color':
                return Mage::getStoreConfig('mygeneral/sidebar/sidebar_fonts_color');
             break;
            case 'sidebar_link_color':
                return Mage::getStoreConfig('mygeneral/sidebar/sidebar_link_color');
             break;
            case 'sidebar_linkhover_color':
                return Mage::getStoreConfig('mygeneral/sidebar/sidebar_linkhover_color');
             break;
	     case 'sidebar_seperator_color':
                return Mage::getStoreConfig('mygeneral/sidebar/sidebar_seperator_color');
             break;
	
	
	/* header */
        
	    case 'headerbg_color':
                return Mage::getStoreConfig('mygeneral/header/headerbg_color');
             break;
	    case 'headerbg_pattern':
                return Mage::getStoreConfig('mygeneral/header/headerbg_pattern');
             break;
	    case 'headerbg_image':
                return Mage::getStoreConfig('mygeneral/header/headerbg_image');
             break;
	    case 'headerbg_repeat':
		return Mage::getStoreConfig('mygeneral/header/headerbg_repeat');
	    break;  
	    case 'headerbg_attachment':
		return Mage::getStoreConfig('mygeneral/header/headerbg_attachment');
	    break;  
	    case 'headerbg_position_x':
		return Mage::getStoreConfig('mygeneral/header/headerbg_position_x');
	    break; 
	    case 'headerbg_position_y':
		return Mage::getStoreConfig('mygeneral/header/headerbg_position_y');
	    break; 
	    case 'header_topblock_color':
                return Mage::getStoreConfig('mygeneral/header/header_topblock_color');
             break;
	    case 'header_link_color':
                return Mage::getStoreConfig('mygeneral/header/header_link_color');
             break;
	    case 'header_linkhover_color':
                return Mage::getStoreConfig('mygeneral/header/header_linkhover_color');
             break;
	    case 'sticky_header':
                return Mage::getStoreConfig('mygeneral/header/sticky_header');
             break;
	    
	    
	/* Banner */
	
	    case 'banner_title_color':
                return Mage::getStoreConfig('mygeneral/banner/banner_title_color');
            break;
	    case 'banner_title_fontsize':
                return Mage::getStoreConfig('mygeneral/banner/banner_title_fontsize');
            break;
	    case 'banner_content_color':
                return Mage::getStoreConfig('mygeneral/banner/banner_content_color');
            break;
            case 'view_color':
                return Mage::getStoreConfig('mygeneral/banner/view_color');
            break;
            case 'view_hover_color':
                return Mage::getStoreConfig('mygeneral/banner/view_hover_color');
            break;
	    case 'banner_content_bg':
                return Mage::getStoreConfig('mygeneral/banner/banner_content_bg');
            break;
            
        
	    
	/* footer */
            case 'footer_background_color':
		return Mage::getStoreConfig('mygeneral/footer/footer_background_color');
	     break;
	    case 'footer_background_pattern':
		return Mage::getStoreConfig('mygeneral/footer/footer_background_pattern');
	     break;
	     case 'footer_background_image':
		return Mage::getStoreConfig('mygeneral/footer/footer_background_image');
	     break;
	     case 'footer_background_repeat':
		return Mage::getStoreConfig('mygeneral/footer/footer_background_repeat');
	     break;
	     case 'footer_background_attachment':
		return Mage::getStoreConfig('mygeneral/footer/footer_background_attachment');
	     break;
	     case 'footer_background_position_x':
		return Mage::getStoreConfig('mygeneral/footer/footer_background_position_x');
	     break;
	     case 'footer_background_position_y':
		return Mage::getStoreConfig('mygeneral/footer/footer_background_position_y');
	     break;
            case 'footer_font_color':
                return Mage::getStoreConfig('mygeneral/footer/footer_font_color');
             break;
            case 'footer_link_title_color':
                return Mage::getStoreConfig('mygeneral/footer/footer_link_title_color');
             break;
	     case 'footer_link_font_color':
                return Mage::getStoreConfig('mygeneral/footer/footer_link_font_color');
             break;
	     case 'footer_linkhover_font_color':
                return Mage::getStoreConfig('mygeneral/footer/footer_linkhover_font_color');
             break;
	     case 'footer_border_color':
                return Mage::getStoreConfig('mygeneral/footer/footer_border_color');
             break;
	    case 'footer_topblock_bg':
                return Mage::getStoreConfig('mygeneral/footer/footer_topblock_bg');
             break;
	    case 'footer_topblock_color':
                return Mage::getStoreConfig('mygeneral/footer/footer_topblock_color');
             break;
	
        /* PRODUCT LIST */
     
	    case 'productlayout':
		return Mage::getStoreConfig('mygeneral/product_list/productlayout');
	    break;
            case 'column_count':
		return Mage::getStoreConfig('mygeneral/product_list/column_count');
	    break;
	    case 'ajaxcart':
                return Mage::getStoreConfig('mygeneral/product_list/ajaxcart');
             break;
	     case 'ajaxpopup':
                return Mage::getStoreConfig('mygeneral/product_list/ajaxpopup');
             break;
	     case 'newsaleicon':
                return Mage::getStoreConfig('mygeneral/product_list/newsaleicon');
             break;
	    case 'product_border':
                return Mage::getStoreConfig('mygeneral/product_list/product_border');
             break;
	    case 'show_border':
                return Mage::getStoreConfig('mygeneral/product_list/show_border');
             break;
	    case 'product_image_bg':
                return Mage::getStoreConfig('mygeneral/product_list/product_image_bg');
             break;
	    case 'product_content_bg':
                return Mage::getStoreConfig('mygeneral/product_list/product_content_bg');
             break;
	    case 'addtocart_bg':
                return Mage::getStoreConfig('mygeneral/product_list/addtocart_bg');
             break;
	    case 'addtocart_color':
                return Mage::getStoreConfig('mygeneral/product_list/addtocart_color');
             break;
	    case 'addtocart_hover_bg':
                return Mage::getStoreConfig('mygeneral/product_list/addtocart_hover_bg');
             break;
	    case 'addtocart_hover_color':
                return Mage::getStoreConfig('mygeneral/product_list/addtocart_hover_color');
             break;
	    case 'button_fonts':
                return Mage::getStoreConfig('mygeneral/product_list/button_fonts');
             break;
	    case 'productname_color':
                return Mage::getStoreConfig('mygeneral/product_list/productname_color');
             break;
	    case 'productname_hover_color':
                return Mage::getStoreConfig('mygeneral/product_list/productname_hover_color');
             break;
	    case 'productname_fonts':
                return Mage::getStoreConfig('mygeneral/product_list/productname_fonts');
             break;
            case 'product_price_color':
                return Mage::getStoreConfig('mygeneral/product_list/product_price_color');
             break;
            case 'product_price_fonts':
                return Mage::getStoreConfig('mygeneral/product_list/product_price_fonts');
             break;
            case 'addto_color':
                return Mage::getStoreConfig('mygeneral/product_list/addto_color');
             break;
	    case 'addto_hover_color':
                return Mage::getStoreConfig('mygeneral/product_list/addto_hover_color');
             break;
	    case 'quickview_color':
                return Mage::getStoreConfig('mygeneral/product_list/quickview_color');
             break;
	    case 'quickview_hover_color':
                return Mage::getStoreConfig('mygeneral/product_list/quickview_hover_color');
             break;
	    case 'quickview_bg_color':
                return Mage::getStoreConfig('mygeneral/product_list/quickview_bg_color');
             break;
	    case 'quickview_hover_bg_color':
                return Mage::getStoreConfig('mygeneral/product_list/quickview_hover_bg_color');
             break;
            case 'new_color':
                return Mage::getStoreConfig('mygeneral/product_list/new_color');
             break;
	    case 'new_bg_color':
                return Mage::getStoreConfig('mygeneral/product_list/new_bg_color');
             break;
            case 'sale_color':
                return Mage::getStoreConfig('mygeneral/product_list/sale_color');
             break;
	    case 'sale_bg_color':
                return Mage::getStoreConfig('mygeneral/product_list/sale_bg_color');
             break;
	    case 'sharingicon':
                return Mage::getStoreConfig('mygeneral/product_list/sharingicon');
             break;
	    case 'brandlogo':
                return Mage::getStoreConfig('mygeneral/product_list/brandlogo');
             break;
        
    
	/* Category */
		
	    case 'displaycategorysidebar':
                return Mage::getStoreConfig('mygeneral/category/displaycategorysidebar');
             break;
	    case 'sidebarmenu':
                return Mage::getStoreConfig('mygeneral/category/sidebarmenu');
             break;
	
	/* Theme Fonts Setting */
		
	     case 'titlefont_color':
                return Mage::getStoreConfig('mygeneral/themefont/titlefont_color');
             break;
	     case 'titlefont_size':
                return Mage::getStoreConfig('mygeneral/themefont/titlefont_size');
             break;
	     case 'titlefont':
                return Mage::getStoreConfig('mygeneral/themefont/titlefont');
             break;
	     case 'bodyfont_color':
                return Mage::getStoreConfig('mygeneral/themefont/bodyfont_color');
             break;
	     case 'bodyfont_size':
                return Mage::getStoreConfig('mygeneral/themefont/bodyfont_size');
             break;
	     case 'bodyfont':
                return Mage::getStoreConfig('mygeneral/themefont/bodyfont');
             break;
	     
	/*  Extra settings */
	
	     case 'backtotop':
                return Mage::getStoreConfig('mygeneral/extra_settings/backtotop');
             break;
	     case 'instock':
                return Mage::getStoreConfig('mygeneral/extra_settings/instock');
             break;
	     case 'responsiveness':
                return Mage::getStoreConfig('mygeneral/extra_settings/responsiveness');
             break;
	    case 'boxlayout':
                return Mage::getStoreConfig('mygeneral/extra_settings/boxlayout');
             break;
	    case 'boxlayout_bg':
                return Mage::getStoreConfig('mygeneral/extra_settings/boxlayout_bg');
             break;
            case 'select':
                return Mage::getStoreConfig('mygeneral/extra_settings/select');
             break;
            case 'select_bg':
                return Mage::getStoreConfig('mygeneral/extra_settings/select_bg');
             break;
            case 'select_link_color':
                return Mage::getStoreConfig('mygeneral/extra_settings/select_link_color');
             break;
            case 'select_linkhover_color':
                return Mage::getStoreConfig('mygeneral/extra_settings/select_linkhover_color');
             break;
	    case 'select_border_color':
                return Mage::getStoreConfig('mygeneral/extra_settings/select_border_color');
             break;
	    case 'customcss':
                return Mage::getStoreConfig('mygeneral/extra_settings/customcss');
             break;
               
		
	}
    }
}
?>