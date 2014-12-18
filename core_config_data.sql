-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 20 2014 г., 17:03
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `morphmal_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `core_config_data`
--

CREATE TABLE IF NOT EXISTS `core_config_data` (
  `config_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Config Id',
  `scope` varchar(8) NOT NULL DEFAULT 'default' COMMENT 'Config Scope',
  `scope_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Config Scope Id',
  `path` varchar(255) NOT NULL DEFAULT 'general' COMMENT 'Config Path',
  `value` text COMMENT 'Config Value',
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `UNQ_CORE_CONFIG_DATA_SCOPE_SCOPE_ID_PATH` (`scope`,`scope_id`,`path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Config Data' AUTO_INCREMENT=451 ;

--
-- Дамп данных таблицы `core_config_data`
--

INSERT INTO `core_config_data` (`config_id`, `scope`, `scope_id`, `path`, `value`) VALUES
(1, 'default', 0, 'general/region/display_all', '1'),
(2, 'default', 0, 'general/region/state_required', 'AT,CA,CH,DE,EE,ES,FI,FR,LT,LV,RO,US'),
(3, 'default', 0, 'catalog/category/root_id', '2'),
(4, 'default', 0, 'web/seo/use_rewrites', '1'),
(5, 'default', 0, 'admin/dashboard/enable_charts', '1'),
(6, 'default', 0, 'web/unsecure/base_url', 'http://morphmallow.site/'),
(7, 'default', 0, 'web/secure/base_url', 'http://morphmallow.site/'),
(8, 'default', 0, 'general/locale/code', 'en_US'),
(9, 'default', 0, 'general/locale/timezone', 'America/New_York'),
(10, 'default', 0, 'currency/options/base', 'USD'),
(11, 'default', 0, 'currency/options/default', 'USD'),
(12, 'default', 0, 'currency/options/allow', 'USD'),
(13, 'default', 0, 'price_slider/price_slider_conf/use_image', '1'),
(14, 'default', 0, 'price_slider/ajax_conf/layered', '0'),
(15, 'default', 0, 'price_slider/ajax_conf/slider', '1'),
(16, 'default', 0, 'price_slider/price_slider_conf/timeout', '0'),
(17, 'default', 0, 'design/package/name', 'metros'),
(18, 'default', 0, 'design/package/ua_regexp', 'a:0:{}'),
(19, 'default', 0, 'design/theme/locale', NULL),
(20, 'default', 0, 'design/theme/template', 'jack'),
(21, 'default', 0, 'design/theme/template_ua_regexp', 'a:0:{}'),
(22, 'default', 0, 'design/theme/skin', 'jack'),
(23, 'default', 0, 'design/theme/skin_ua_regexp', 'a:0:{}'),
(24, 'default', 0, 'design/theme/layout', 'jack'),
(25, 'default', 0, 'design/theme/layout_ua_regexp', 'a:0:{}'),
(26, 'default', 0, 'design/theme/default', NULL),
(27, 'default', 0, 'design/theme/default_ua_regexp', 'a:0:{}'),
(28, 'default', 0, 'design/head/default_title', 'Nextrendz'),
(29, 'default', 0, 'design/head/title_prefix', 'Nextrendz'),
(30, 'default', 0, 'design/head/title_suffix', NULL),
(31, 'default', 0, 'design/head/default_description', 'Default Description'),
(32, 'default', 0, 'design/head/default_keywords', 'Magento, Varien, E-commerce'),
(33, 'default', 0, 'design/head/default_robots', 'INDEX,FOLLOW'),
(34, 'default', 0, 'design/head/includes', NULL),
(35, 'default', 0, 'design/head/demonotice', '0'),
(36, 'default', 0, 'design/header/logo_src', 'images/morph_logo.png'),
(37, 'default', 0, 'design/header/logo_alt', 'Morphmallow'),
(38, 'default', 0, 'design/header/welcome', 'Welcome to Morphmallow'),
(39, 'default', 0, 'design/footer/copyright', '©2014 <img src="http://sukkahlights.com/efflogo.png">Powered by <a href="http://www.effcreative.com">Eff Creative</a>'),
(40, 'default', 0, 'design/footer/absolute_footer', NULL),
(41, 'default', 0, 'design/watermark/image_size', NULL),
(42, 'default', 0, 'design/watermark/image_imageOpacity', NULL),
(43, 'default', 0, 'design/watermark/image_position', 'stretch'),
(44, 'default', 0, 'design/watermark/small_image_size', NULL),
(45, 'default', 0, 'design/watermark/small_image_imageOpacity', NULL),
(46, 'default', 0, 'design/watermark/small_image_position', 'stretch'),
(47, 'default', 0, 'design/watermark/thumbnail_size', NULL),
(48, 'default', 0, 'design/watermark/thumbnail_imageOpacity', NULL),
(49, 'default', 0, 'design/watermark/thumbnail_position', 'stretch'),
(50, 'default', 0, 'design/pagination/pagination_frame', '5'),
(51, 'default', 0, 'design/pagination/pagination_frame_skip', NULL),
(52, 'default', 0, 'design/pagination/anchor_text_for_previous', NULL),
(53, 'default', 0, 'design/pagination/anchor_text_for_next', NULL),
(54, 'default', 0, 'design/email/logo_alt', NULL),
(55, 'default', 0, 'mygeneral/colors/primary_color', NULL),
(56, 'default', 0, 'mygeneral/colors/secondary_color', NULL),
(57, 'default', 0, 'mygeneral/colors/buttonaerrow_color', 'F15C53'),
(58, 'default', 0, 'mygeneral/colors/buttonhover_color', 'FBD994'),
(59, 'default', 0, 'mygeneral/colors/border_color', NULL),
(60, 'default', 0, 'mygeneral/menu/topmenu_background', NULL),
(61, 'default', 0, 'mygeneral/menu/topmenu_fonts', '--select--'),
(62, 'default', 0, 'mygeneral/menu/topmenu_fonts_color', NULL),
(63, 'default', 0, 'mygeneral/menu/topmenu_fontshover_color', 'FFFFFF'),
(64, 'default', 0, 'mygeneral/menu/topmenu_fontshover_bg_color', 'F16667'),
(65, 'default', 0, 'mygeneral/menu/menu_background', NULL),
(66, 'default', 0, 'mygeneral/menu/submenu_fonts', '--select--'),
(67, 'default', 0, 'mygeneral/menu/submenu_fonts_color', NULL),
(68, 'default', 0, 'mygeneral/menu/submenu_fontshover_color', NULL),
(69, 'default', 0, 'mygeneral/menu/menu_fonts', '--select--'),
(70, 'default', 0, 'mygeneral/menu/menu_fonts_color', NULL),
(71, 'default', 0, 'mygeneral/menu/menu_fontshover_color', NULL),
(72, 'default', 0, 'mygeneral/menu/menu_border_color', NULL),
(73, 'default', 0, 'mygeneral/menu/homelink', '1'),
(74, 'default', 0, 'mygeneral/sidebar/sidebar_background_color', NULL),
(75, 'default', 0, 'mygeneral/sidebar/sidebar_title_fonts', '--select--'),
(76, 'default', 0, 'mygeneral/sidebar/sidebar_title_fonts_color', NULL),
(77, 'default', 0, 'mygeneral/sidebar/sidebar_title_fonts_bg_color', NULL),
(78, 'default', 0, 'mygeneral/sidebar/sidebar_fonts_color', NULL),
(79, 'default', 0, 'mygeneral/sidebar/sidebar_link_color', NULL),
(80, 'default', 0, 'mygeneral/sidebar/sidebar_linkhover_color', NULL),
(81, 'default', 0, 'mygeneral/sidebar/sidebar_seperator_color', NULL),
(82, 'default', 0, 'mygeneral/header/headerbg_color', NULL),
(83, 'default', 0, 'mygeneral/header/headerbg_pattern', NULL),
(84, 'default', 0, 'mygeneral/header/headerbg_repeat', NULL),
(85, 'default', 0, 'mygeneral/header/headerbg_attachment', NULL),
(86, 'default', 0, 'mygeneral/header/headerbg_position_x', NULL),
(87, 'default', 0, 'mygeneral/header/headerbg_position_y', NULL),
(88, 'default', 0, 'mygeneral/header/header_topblock_color', NULL),
(89, 'default', 0, 'mygeneral/header/header_link_color', NULL),
(90, 'default', 0, 'mygeneral/header/header_linkhover_color', NULL),
(91, 'default', 0, 'mygeneral/header/sticky_header', '1'),
(92, 'default', 0, 'mygeneral/banner/banner_title_color', NULL),
(93, 'default', 0, 'mygeneral/banner/banner_title_fontsize', NULL),
(94, 'default', 0, 'mygeneral/banner/banner_content_color', NULL),
(95, 'default', 0, 'mygeneral/banner/view_color', NULL),
(96, 'default', 0, 'mygeneral/banner/view_hover_color', NULL),
(97, 'default', 0, 'mygeneral/banner/banner_content_bg', NULL),
(98, 'default', 0, 'mygeneral/footer/footer_background_color', NULL),
(99, 'default', 0, 'mygeneral/footer/footer_background_pattern', NULL),
(100, 'default', 0, 'mygeneral/footer/footer_background_repeat', NULL),
(101, 'default', 0, 'mygeneral/footer/footer_background_attachment', NULL),
(102, 'default', 0, 'mygeneral/footer/footer_background_position_x', NULL),
(103, 'default', 0, 'mygeneral/footer/footer_background_position_y', NULL),
(104, 'default', 0, 'mygeneral/footer/footer_font_color', NULL),
(105, 'default', 0, 'mygeneral/footer/footer_link_title_color', NULL),
(106, 'default', 0, 'mygeneral/footer/footer_link_font_color', NULL),
(107, 'default', 0, 'mygeneral/footer/footer_linkhover_font_color', NULL),
(108, 'default', 0, 'mygeneral/footer/footer_border_color', NULL),
(109, 'default', 0, 'mygeneral/footer/footer_topblock_bg', NULL),
(110, 'default', 0, 'mygeneral/footer/footer_topblock_color', NULL),
(111, 'default', 0, 'mygeneral/background/background_color', NULL),
(112, 'default', 0, 'mygeneral/background/background_pattern', 'pattern5.png'),
(113, 'default', 0, 'mygeneral/background/bg_repeat', NULL),
(114, 'default', 0, 'mygeneral/background/bg_attachment', NULL),
(115, 'default', 0, 'mygeneral/background/bg_position_x', NULL),
(116, 'default', 0, 'mygeneral/background/bg_position_y', NULL),
(117, 'default', 0, 'mygeneral/product_list/productlayout', 'default'),
(118, 'default', 0, 'mygeneral/product_list/column_count', '3'),
(119, 'default', 0, 'mygeneral/product_list/ajaxcart', '2'),
(120, 'default', 0, 'mygeneral/product_list/ajaxpopup', '1'),
(121, 'default', 0, 'mygeneral/product_list/newsaleicon', '1'),
(122, 'default', 0, 'mygeneral/product_list/product_border', NULL),
(123, 'default', 0, 'mygeneral/product_list/show_border', '1'),
(124, 'default', 0, 'mygeneral/product_list/product_image_bg', NULL),
(125, 'default', 0, 'mygeneral/product_list/product_content_bg', NULL),
(126, 'default', 0, 'mygeneral/product_list/addtocart_bg', NULL),
(127, 'default', 0, 'mygeneral/product_list/addtocart_color', NULL),
(128, 'default', 0, 'mygeneral/product_list/addtocart_hover_bg', NULL),
(129, 'default', 0, 'mygeneral/product_list/addtocart_hover_color', NULL),
(130, 'default', 0, 'mygeneral/product_list/button_fonts', '--select--'),
(131, 'default', 0, 'mygeneral/product_list/productname_color', NULL),
(132, 'default', 0, 'mygeneral/product_list/productname_hover_color', NULL),
(133, 'default', 0, 'mygeneral/product_list/productname_fonts', '--select--'),
(134, 'default', 0, 'mygeneral/product_list/product_price_color', NULL),
(135, 'default', 0, 'mygeneral/product_list/product_price_fonts', '--select--'),
(136, 'default', 0, 'mygeneral/product_list/addto_color', NULL),
(137, 'default', 0, 'mygeneral/product_list/addto_hover_color', NULL),
(138, 'default', 0, 'mygeneral/product_list/quickview_color', NULL),
(139, 'default', 0, 'mygeneral/product_list/quickview_hover_color', NULL),
(140, 'default', 0, 'mygeneral/product_list/quickview_bg_color', NULL),
(141, 'default', 0, 'mygeneral/product_list/quickview_hover_bg_color', NULL),
(142, 'default', 0, 'mygeneral/product_list/new_color', NULL),
(143, 'default', 0, 'mygeneral/product_list/new_bg_color', NULL),
(144, 'default', 0, 'mygeneral/product_list/sale_color', NULL),
(145, 'default', 0, 'mygeneral/product_list/sale_bg_color', NULL),
(146, 'default', 0, 'mygeneral/product_list/sharingicon', '1'),
(147, 'default', 0, 'mygeneral/product_list/brandlogo', '1'),
(148, 'default', 0, 'mygeneral/category/displaycategorysidebar', 'right'),
(149, 'default', 0, 'mygeneral/category/sidebarmenu', '1'),
(150, 'default', 0, 'mygeneral/themefont/titlefont_color', NULL),
(151, 'default', 0, 'mygeneral/themefont/titlefont_size', NULL),
(152, 'default', 0, 'mygeneral/themefont/titlefont', '--select--'),
(153, 'default', 0, 'mygeneral/themefont/bodyfont_color', NULL),
(154, 'default', 0, 'mygeneral/themefont/bodyfont_size', NULL),
(155, 'default', 0, 'mygeneral/themefont/bodyfont', '--select--'),
(156, 'default', 0, 'mygeneral/extra_settings/backtotop', '1'),
(157, 'default', 0, 'mygeneral/extra_settings/instock', '1'),
(158, 'default', 0, 'mygeneral/extra_settings/responsiveness', '1'),
(159, 'default', 0, 'mygeneral/extra_settings/boxlayout', '3'),
(160, 'default', 0, 'mygeneral/extra_settings/boxlayout_bg', NULL),
(161, 'default', 0, 'mygeneral/extra_settings/select', NULL),
(162, 'default', 0, 'mygeneral/extra_settings/select_bg', NULL),
(163, 'default', 0, 'mygeneral/extra_settings/select_link_color', NULL),
(164, 'default', 0, 'mygeneral/extra_settings/select_linkhover_color', NULL),
(165, 'default', 0, 'mygeneral/extra_settings/select_border_color', NULL),
(166, 'default', 0, 'mygeneral/extra_settings/customcss', '.button{padding:5px;}\r\n.logo img{width:100%;height:auto;}\r\n.searchlogo{margin-top:0 !important;}\r\n\r\n@media (max-width: 694px){\r\n.product-view .product-right {\r\n    display: block;\r\n    width: 100%;\r\n}'),
(167, 'default', 0, 'cms/wysiwyg/enabled', 'hidden'),
(168, 'default', 0, 'cms/wysiwyg/use_static_urls_in_catalog', '0'),
(169, 'default', 0, 'web/url/use_store', '0'),
(170, 'default', 0, 'web/url/redirect_to_base', '1'),
(171, 'default', 0, 'web/unsecure/base_link_url', '{{unsecure_base_url}}'),
(172, 'default', 0, 'web/unsecure/base_skin_url', '{{unsecure_base_url}}skin/'),
(173, 'default', 0, 'web/unsecure/base_media_url', '{{unsecure_base_url}}media/'),
(174, 'default', 0, 'web/unsecure/base_js_url', '{{unsecure_base_url}}js/'),
(175, 'default', 0, 'web/secure/base_link_url', '{{secure_base_url}}'),
(176, 'default', 0, 'web/secure/base_skin_url', '{{secure_base_url}}skin/'),
(177, 'default', 0, 'web/secure/base_media_url', '{{secure_base_url}}media/'),
(178, 'default', 0, 'web/secure/base_js_url', '{{secure_base_url}}js/'),
(179, 'default', 0, 'web/secure/use_in_frontend', '0'),
(180, 'default', 0, 'web/secure/use_in_adminhtml', '0'),
(181, 'default', 0, 'web/secure/offloader_header', 'SSL_OFFLOADED'),
(182, 'default', 0, 'web/default/front', 'cms'),
(183, 'default', 0, 'web/default/cms_home_page', 'home'),
(184, 'default', 0, 'web/default/no_route', 'cms/index/noRoute'),
(185, 'default', 0, 'web/default/cms_no_route', 'no-route'),
(186, 'default', 0, 'web/default/cms_no_cookies', 'enable-cookies'),
(187, 'default', 0, 'web/default/show_cms_breadcrumbs', '1'),
(188, 'default', 0, 'web/polls/poll_check_by_ip', '0'),
(189, 'default', 0, 'web/cookie/cookie_lifetime', '3600'),
(190, 'default', 0, 'web/cookie/cookie_path', NULL),
(191, 'default', 0, 'web/cookie/cookie_domain', NULL),
(192, 'default', 0, 'web/cookie/cookie_httponly', '1'),
(193, 'default', 0, 'web/cookie/cookie_restriction', '0'),
(194, 'default', 0, 'web/session/use_remote_addr', '0'),
(195, 'default', 0, 'web/session/use_http_via', '0'),
(196, 'default', 0, 'web/session/use_http_x_forwarded_for', '0'),
(197, 'default', 0, 'web/session/use_http_user_agent', '0'),
(198, 'default', 0, 'web/session/use_frontend_sid', '1'),
(199, 'default', 0, 'web/browser_capabilities/cookies', '1'),
(200, 'default', 0, 'web/browser_capabilities/javascript', '1'),
(201, 'default', 0, 'infinitescroll/general/enabled', '1'),
(202, 'default', 0, 'infinitescroll/general/jquery', '0'),
(203, 'default', 0, 'infinitescroll/instances/grid', '1'),
(204, 'default', 0, 'infinitescroll/instances/layer', '1'),
(205, 'default', 0, 'infinitescroll/instances/search', '1'),
(206, 'default', 0, 'infinitescroll/instances/advanced', '1'),
(207, 'default', 0, 'infinitescroll/selectors/content', 'div.category-products'),
(208, 'default', 0, 'infinitescroll/selectors/pagination', '.toolbar .pager'),
(209, 'default', 0, 'infinitescroll/selectors/toolbar', '.toolbar'),
(210, 'default', 0, 'infinitescroll/selectors/next', '.pager .next'),
(211, 'default', 0, 'infinitescroll/selectors/items_grid', 'ul.products-grid'),
(212, 'default', 0, 'infinitescroll/selectors/items_list', '#products-list'),
(213, 'default', 0, 'infinitescroll/design/loading_img', 'http://www.infinite-scroll.com/loading.gif'),
(214, 'default', 0, 'infinitescroll/design/loading_text', '<em>Loading the next set of posts...</em>'),
(215, 'default', 0, 'infinitescroll/design/done_text', '<em>Congratulations, you''ve reached the end of the internet.</em>'),
(216, 'default', 0, 'infinitescroll/design/hide_toolbar', '0'),
(217, 'default', 0, 'infinitescroll/design/local_mode', '0'),
(218, 'default', 0, 'infinitescroll/design/buffer_px', '150'),
(219, 'default', 0, 'infinitescroll/design/load_more_threshold', '5'),
(220, 'default', 0, 'infinitescroll/design/load_more_text', 'Load more items'),
(221, 'default', 0, 'infinitescroll/memory/enabled', '1'),
(222, 'default', 0, 'infinitescroll/advanced/ias_config', 'js/infinitescroll/ias_config.js'),
(223, 'default', 0, 'ajaxscroll/general/enabled', '1'),
(224, 'default', 0, 'ajaxscroll/general/useajaxscroll', '1'),
(225, 'default', 0, 'clearcode_addshoppers/settings/enabled', '1'),
(226, 'stores', 1, 'yotpo/yotpo_general_group/yotpo_appkey', 'CsCQazywOf8VHfWzOVHpfVT7Rd9hIgnsGjjwo5xt'),
(227, 'stores', 1, 'yotpo/yotpo_general_group/yotpo_secret', 'Fn6Y9aFezTqSsgz2uDDIn50WtcEbfFayiCRBMHRQ'),
(228, 'stores', 1, 'yotpo/yotpo_general_group/disable_default_widget_position', '0'),
(229, 'stores', 1, 'yotpo/yotpo_general_group/custom_order_status', 'complete'),
(230, 'stores', 1, 'yotpo/yotpo_rich_snippets_group/rich_snippets_disabled', '0'),
(231, 'default', 0, 'estimateddeliverydate/options/message_enabled', '1'),
(232, 'default', 0, 'estimateddeliverydate/options/initial_message', 'Please select options to check delivery.'),
(233, 'default', 0, 'estimateddeliverydate/options/failed_request_message', 'An estimated delivery date for this product is currently unavailable.'),
(234, 'default', 0, 'advanced/modules_disable_output/Clearcode_Addshoppers', '0'),
(235, 'default', 0, 'advanced/modules_disable_output/Cm_RedisSession', '0'),
(236, 'default', 0, 'advanced/modules_disable_output/Excellence_Ajax', '0'),
(237, 'default', 0, 'advanced/modules_disable_output/IWD_OnepageCheckout', '0'),
(238, 'default', 0, 'advanced/modules_disable_output/Mage_Admin', '0'),
(239, 'default', 0, 'advanced/modules_disable_output/Mage_AdminNotification', '0'),
(240, 'default', 0, 'advanced/modules_disable_output/Mage_Api', '0'),
(241, 'default', 0, 'advanced/modules_disable_output/Mage_Api2', '0'),
(242, 'default', 0, 'advanced/modules_disable_output/Mage_Authorizenet', '0'),
(243, 'default', 0, 'advanced/modules_disable_output/Mage_Backup', '0'),
(244, 'default', 0, 'advanced/modules_disable_output/Mage_Bundle', '0'),
(245, 'default', 0, 'advanced/modules_disable_output/Mage_Captcha', '0'),
(246, 'default', 0, 'advanced/modules_disable_output/Mage_Catalog', '0'),
(247, 'default', 0, 'advanced/modules_disable_output/Mage_CatalogIndex', '0'),
(248, 'default', 0, 'advanced/modules_disable_output/Mage_CatalogInventory', '0'),
(249, 'default', 0, 'advanced/modules_disable_output/Mage_CatalogRule', '0'),
(250, 'default', 0, 'advanced/modules_disable_output/Mage_CatalogSearch', '0'),
(251, 'default', 0, 'advanced/modules_disable_output/Mage_Centinel', '0'),
(252, 'default', 0, 'advanced/modules_disable_output/Mage_Checkout', '0'),
(253, 'default', 0, 'advanced/modules_disable_output/Mage_Cms', '0'),
(254, 'default', 0, 'advanced/modules_disable_output/Mage_Compiler', '0'),
(255, 'default', 0, 'advanced/modules_disable_output/Mage_Connect', '0'),
(256, 'default', 0, 'advanced/modules_disable_output/Mage_Contacts', '0'),
(257, 'default', 0, 'advanced/modules_disable_output/Mage_Core', '0'),
(258, 'default', 0, 'advanced/modules_disable_output/Mage_Cron', '0'),
(259, 'default', 0, 'advanced/modules_disable_output/Mage_CurrencySymbol', '0'),
(260, 'default', 0, 'advanced/modules_disable_output/Mage_Customer', '0'),
(261, 'default', 0, 'advanced/modules_disable_output/Mage_Dataflow', '0'),
(262, 'default', 0, 'advanced/modules_disable_output/Mage_Directory', '0'),
(263, 'default', 0, 'advanced/modules_disable_output/Mage_Downloadable', '0'),
(264, 'default', 0, 'advanced/modules_disable_output/Mage_Eav', '0'),
(265, 'default', 0, 'advanced/modules_disable_output/Mage_GiftMessage', '0'),
(266, 'default', 0, 'advanced/modules_disable_output/Mage_GoogleAnalytics', '0'),
(267, 'default', 0, 'advanced/modules_disable_output/Mage_GoogleCheckout', '0'),
(268, 'default', 0, 'advanced/modules_disable_output/Mage_ImportExport', '0'),
(269, 'default', 0, 'advanced/modules_disable_output/Mage_Index', '0'),
(270, 'default', 0, 'advanced/modules_disable_output/Mage_Install', '0'),
(271, 'default', 0, 'advanced/modules_disable_output/Mage_Log', '0'),
(272, 'default', 0, 'advanced/modules_disable_output/Mage_Media', '0'),
(273, 'default', 0, 'advanced/modules_disable_output/Mage_Newsletter', '0'),
(274, 'default', 0, 'advanced/modules_disable_output/Mage_Oauth', '0'),
(275, 'default', 0, 'advanced/modules_disable_output/Mage_Page', '0'),
(276, 'default', 0, 'advanced/modules_disable_output/Mage_PageCache', '0'),
(277, 'default', 0, 'advanced/modules_disable_output/Mage_Paygate', '0'),
(278, 'default', 0, 'advanced/modules_disable_output/Mage_Payment', '0'),
(279, 'default', 0, 'advanced/modules_disable_output/Mage_Paypal', '0'),
(280, 'default', 0, 'advanced/modules_disable_output/Mage_PaypalUk', '0'),
(281, 'default', 0, 'advanced/modules_disable_output/Mage_Persistent', '0'),
(282, 'default', 0, 'advanced/modules_disable_output/Mage_Poll', '0'),
(283, 'default', 0, 'advanced/modules_disable_output/Mage_ProductAlert', '0'),
(284, 'default', 0, 'advanced/modules_disable_output/Mage_Rating', '0'),
(285, 'default', 0, 'advanced/modules_disable_output/Mage_Reports', '0'),
(286, 'default', 0, 'advanced/modules_disable_output/Mage_Review', '1'),
(287, 'default', 0, 'advanced/modules_disable_output/Mage_Rss', '0'),
(288, 'default', 0, 'advanced/modules_disable_output/Mage_Rule', '0'),
(289, 'default', 0, 'advanced/modules_disable_output/Mage_Sales', '0'),
(290, 'default', 0, 'advanced/modules_disable_output/Mage_SalesRule', '0'),
(291, 'default', 0, 'advanced/modules_disable_output/Mage_Sendfriend', '0'),
(292, 'default', 0, 'advanced/modules_disable_output/Mage_Shipping', '0'),
(293, 'default', 0, 'advanced/modules_disable_output/Mage_Sitemap', '0'),
(294, 'default', 0, 'advanced/modules_disable_output/Mage_Tag', '0'),
(295, 'default', 0, 'advanced/modules_disable_output/Mage_Tax', '0'),
(296, 'default', 0, 'advanced/modules_disable_output/Mage_Usa', '0'),
(297, 'default', 0, 'advanced/modules_disable_output/Mage_Weee', '0'),
(298, 'default', 0, 'advanced/modules_disable_output/Mage_Widget', '0'),
(299, 'default', 0, 'advanced/modules_disable_output/Mage_Wishlist', '0'),
(300, 'default', 0, 'advanced/modules_disable_output/Mage_XmlConnect', '0'),
(301, 'default', 0, 'advanced/modules_disable_output/Magehouse_Slider', '0'),
(302, 'default', 0, 'advanced/modules_disable_output/Magestore_Bannerslider', '0'),
(303, 'default', 0, 'advanced/modules_disable_output/Moo_Catalog', '0'),
(304, 'default', 0, 'advanced/modules_disable_output/Olegnax_Gfont', '0'),
(305, 'default', 0, 'advanced/modules_disable_output/Phoenix_Moneybookers', '0'),
(306, 'default', 0, 'advanced/modules_disable_output/Strategery_Infinitescroll', '0'),
(307, 'default', 0, 'advanced/modules_disable_output/ThemeOptions_ExtraConfig', '0'),
(308, 'default', 0, 'advanced/modules_disable_output/Undottitled_Estimateddeliverydate', '0'),
(309, 'default', 0, 'advanced/modules_disable_output/WP_CustomMenu', '0'),
(310, 'default', 0, 'advanced/modules_disable_output/Yotpo_Yotpo', '0'),
(311, 'default', 0, 'ehut_sociallogin/general/showonloginpage', 'top'),
(312, 'default', 0, 'ehut_sociallogin/general/showoncheckout', '1'),
(313, 'default', 0, 'ehut_sociallogin/facebook/enabled', '1'),
(314, 'default', 0, 'ehut_sociallogin/facebook/api_key', '1508465796039124'),
(315, 'default', 0, 'ehut_sociallogin/facebook/secret', '173ad675db188465c243108c2613d85e'),
(316, 'default', 0, 'ehut_sociallogin/google/enabled', '0'),
(317, 'default', 0, 'ehut_sociallogin/twitter/enabled', '0'),
(318, 'default', 0, 'ehut_sociallogin/linkedin/enabled', '0'),
(319, 'default', 0, 'ehut_sociallogin/yahoo/enabled', '0'),
(320, 'default', 0, 'le_sociallogin/general/showonloginpage', 'inloginbox'),
(321, 'default', 0, 'le_sociallogin/general/showoncheckout', '1'),
(322, 'default', 0, 'le_sociallogin/facebook/enabled', '1'),
(323, 'default', 0, 'le_sociallogin/facebook/api_key', '1508465796039124'),
(324, 'default', 0, 'le_sociallogin/facebook/secret', '173ad675db188465c243108c2613d85e'),
(325, 'default', 0, 'le_sociallogin/google/enabled', '0'),
(326, 'default', 0, 'le_sociallogin/twitter/enabled', '0'),
(327, 'default', 0, 'le_sociallogin/linkedin/enabled', '0'),
(328, 'default', 0, 'le_sociallogin/yahoo/enabled', '0'),
(329, 'default', 0, 'wordpress/module/enabled', '1'),
(330, 'default', 0, 'wordpress/database/is_shared', '1'),
(331, 'default', 0, 'wordpress/database/table_prefix', 'wp_'),
(332, 'default', 0, 'wordpress/autologin/username_1', 'njaY9+dsT24='),
(333, 'default', 0, 'wordpress/autologin/password_1', 'TRHdRRVS6nY='),
(334, 'default', 0, 'wordpress/integration/full', '1'),
(335, 'default', 0, 'wordpress/integration/route', 'wp'),
(336, 'default', 0, 'wordpress/integration/path', 'wp'),
(337, 'default', 0, 'wordpress/integration/force_single_store', '0'),
(338, 'default', 0, 'wordpress/template/default', NULL),
(339, 'default', 0, 'wordpress/template/homepage', NULL),
(340, 'default', 0, 'wordpress/template/post_list', NULL),
(341, 'default', 0, 'wordpress/template/post_view', NULL),
(342, 'default', 0, 'wordpress/template/page', NULL),
(343, 'default', 0, 'wordpress/menu/enabled', '1'),
(344, 'default', 0, 'wordpress/toplink/enabled', '0'),
(345, 'default', 0, 'wordpress/toplink/label', 'Blog'),
(346, 'default', 0, 'wordpress/toplink/position', '100'),
(347, 'default', 0, 'wordpress/misc/include_css', '0'),
(348, 'default', 0, 'wordpress/misc/sidebar_left_empty', '0'),
(349, 'default', 0, 'wordpress/misc/sidebar_right_empty', '0'),
(350, 'default', 0, 'wordpress/misc/autop', '1'),
(351, 'default', 0, 'dev/restrict/allow_ips', NULL),
(352, 'default', 0, 'dev/debug/profiler', '0'),
(353, 'default', 0, 'dev/template/allow_symlink', '0'),
(354, 'default', 0, 'dev/translate_inline/active', '0'),
(355, 'default', 0, 'dev/translate_inline/active_admin', '0'),
(356, 'default', 0, 'dev/log/active', '1'),
(357, 'default', 0, 'dev/log/file', 'system.log'),
(358, 'default', 0, 'dev/log/exception_file', 'exception.log'),
(359, 'default', 0, 'dev/js/merge_files', '0'),
(360, 'default', 0, 'dev/css/merge_css_files', '0'),
(361, 'default', 0, 'wordpress/integration/at_root', '1'),
(362, 'default', 0, 'wordpress/integration/replace_homepage', '0'),
(363, 'default', 0, 'wordpress/integratedsearch/css', '1'),
(364, 'default', 0, 'wordpress/integratedsearch/magento', '1'),
(365, 'default', 0, 'wordpress/integratedsearch/blog', '1'),
(366, 'default', 0, 'wordpress/extend/cs', '1'),
(367, 'default', 0, 'wordpress/extend/cf7', '1'),
(368, 'default', 0, 'wordpress/extend/facebook', '1'),
(370, 'default', 0, 'wordpress/menu/id', '3'),
(372, 'default', 0, 'wordpress_blog/layout/template_default', NULL),
(373, 'default', 0, 'wordpress_blog/layout/template_homepage', NULL),
(374, 'default', 0, 'wordpress_blog/layout/template_post_list', NULL),
(375, 'default', 0, 'wordpress_blog/layout/template_post_view', NULL),
(376, 'default', 0, 'wordpress_blog/layout/template_page', NULL),
(377, 'default', 0, 'wordpress_blog/layout/update_xml', NULL),
(378, 'default', 0, 'wordpress_blog/layout/sidebar_left_empty', '0'),
(379, 'default', 0, 'wordpress_blog/layout/sidebar_right_empty', '0'),
(380, 'default', 0, 'wordpress_blog/layout/include_css', '0'),
(381, 'default', 0, 'wordpress_blog/layout/toplink_enabled', '1'),
(382, 'default', 0, 'wordpress_blog/layout/toplink_label', 'Blog'),
(383, 'default', 0, 'wordpress_blog/layout/toplink_position', '100'),
(384, 'default', 0, 'wordpress_blog/posts/excerpt_size', '55'),
(385, 'default', 0, 'wordpress_blog/posts/excerpt_suffix', ' [...]'),
(386, 'default', 0, 'wordpress_blog/posts/more_anchor', 'Continue Reading'),
(387, 'default', 0, 'wordpress_blog/posts/display_previous_next', '1'),
(388, 'default', 0, 'wordpress_blog/posts/opengraph', '1'),
(389, 'default', 0, 'wordpress_blog/posts/comment_success_msg', 'Your comment has been accepted for moderation and will be published shortly'),
(390, 'default', 0, 'wordpress_blog/posts/comment_error_msg', 'There was an error posting your comment'),
(391, 'default', 0, 'wordpress_blog/search/enabled', '1'),
(392, 'default', 0, 'wordpress_blog/search/search_base', 'search'),
(393, 'default', 0, 'wordpress_blog/search/use_seo_urls', '1'),
(394, 'default', 0, 'wordpress_blog/search/default_input_value', 'Search our blog...'),
(395, 'default', 0, 'wordpress_blog/search/logical_operator', 'or'),
(396, 'default', 0, 'wordpress_blog/search/searchable_fields', 'post_title,post_content,post_excerpt,post_name'),
(397, 'default', 0, 'wordpress_blog/search/search_by_words', '0'),
(398, 'default', 0, 'wordpress_blog/search/min_word_length', '3'),
(399, 'default', 0, 'wordpress_blog/recaptcha/public_key', NULL),
(400, 'default', 0, 'wordpress_blog/recaptcha/private_key', NULL),
(401, 'default', 0, 'wordpress_blog/recaptcha/enabled', '0'),
(402, 'default', 0, 'wordpress_blog/recaptcha/theme', 'red'),
(403, 'default', 0, 'wordpress_blog/recaptcha/language', 'en'),
(404, 'default', 0, 'wordpress_blog/recaptcha/error_msg', 'You entered an invalid captcha code.'),
(405, 'default', 0, 'wordpress_blog/tag_cloud/max_tags_to_display', '20'),
(406, 'default', 0, 'wordpress_blog/tag_cloud/font_size_below_25', '90'),
(407, 'default', 0, 'wordpress_blog/tag_cloud/font_size_below_50', '100'),
(408, 'default', 0, 'wordpress_blog/tag_cloud/font_size_below_75', '120'),
(409, 'default', 0, 'wordpress_blog/tag_cloud/font_size_below_90', '140'),
(410, 'default', 0, 'wordpress_blog/tag_cloud/font_size_below_100', '150'),
(411, 'default', 0, 'wordpress_blog/associations/force_single_store', '0'),
(412, 'default', 0, 'wordpress_blog/locale/cyrillic_enabled', '0'),
(413, 'default', 0, 'wordpress/database/is_different_db', '0'),
(414, 'default', 0, 'wordpress/misc/path', 'wp'),
(415, 'default', 0, 'wordpress/debug/log_enabled', '1'),
(416, 'default', 0, 'customer/account_share/scope', '1'),
(417, 'default', 0, 'customer/online_customers/online_minutes_interval', NULL),
(418, 'default', 0, 'customer/create_account/auto_group_assign', '0'),
(419, 'default', 0, 'customer/create_account/default_group', '1'),
(420, 'default', 0, 'customer/create_account/viv_disable_auto_group_assign_default', '0'),
(421, 'default', 0, 'customer/create_account/vat_frontend_visibility', '0'),
(422, 'default', 0, 'customer/create_account/email_domain', 'example.com'),
(423, 'default', 0, 'customer/create_account/email_template', 'customer_create_account_email_template'),
(424, 'default', 0, 'customer/create_account/email_identity', 'general'),
(425, 'default', 0, 'customer/create_account/confirm', '0'),
(426, 'default', 0, 'customer/create_account/email_confirmation_template', 'customer_create_account_email_confirmation_template'),
(427, 'default', 0, 'customer/create_account/email_confirmed_template', 'customer_create_account_email_confirmed_template'),
(428, 'default', 0, 'customer/create_account/generate_human_friendly_id', '0'),
(429, 'default', 0, 'customer/password/forgot_email_template', 'customer_password_forgot_email_template'),
(430, 'default', 0, 'customer/password/remind_email_template', 'customer_password_remind_email_template'),
(431, 'default', 0, 'customer/password/forgot_email_identity', 'support'),
(432, 'default', 0, 'customer/password/reset_link_expiration_period', '1'),
(433, 'default', 0, 'customer/address/street_lines', '2'),
(434, 'default', 0, 'customer/address/prefix_show', NULL),
(435, 'default', 0, 'customer/address/prefix_options', NULL),
(436, 'default', 0, 'customer/address/middlename_show', '0'),
(437, 'default', 0, 'customer/address/suffix_show', NULL),
(438, 'default', 0, 'customer/address/suffix_options', NULL),
(439, 'default', 0, 'customer/address/dob_show', NULL),
(440, 'default', 0, 'customer/address/taxvat_show', NULL),
(441, 'default', 0, 'customer/address/gender_show', NULL),
(442, 'default', 0, 'customer/startup/redirect_dashboard', '1'),
(443, 'default', 0, 'customer/address_templates/text', '{{depend prefix}}{{var prefix}} {{/depend}}{{var firstname}} {{depend middlename}}{{var middlename}} {{/depend}}{{var lastname}}{{depend suffix}} {{var suffix}}{{/depend}}\r\n{{depend company}}{{var company}}{{/depend}}\r\n{{if street1}}{{var street1}}\r\n{{/if}}\r\n{{depend street2}}{{var street2}}{{/depend}}\r\n{{depend street3}}{{var street3}}{{/depend}}\r\n{{depend street4}}{{var street4}}{{/depend}}\r\n{{if city}}{{var city}},  {{/if}}{{if region}}{{var region}}, {{/if}}{{if postcode}}{{var postcode}}{{/if}}\r\n{{var country}}\r\nT: {{var telephone}}\r\n{{depend fax}}F: {{var fax}}{{/depend}}\r\n{{depend vat_id}}VAT: {{var vat_id}}{{/depend}}'),
(444, 'default', 0, 'customer/address_templates/oneline', '{{depend prefix}}{{var prefix}} {{/depend}}{{var firstname}} {{depend middlename}}{{var middlename}} {{/depend}}{{var lastname}}{{depend suffix}} {{var suffix}}{{/depend}}, {{var street}}, {{var city}}, {{var region}} {{var postcode}}, {{var country}}'),
(445, 'default', 0, 'customer/address_templates/html', '{{depend prefix}}{{var prefix}} {{/depend}}{{var firstname}} {{depend middlename}}{{var middlename}} {{/depend}}{{var lastname}}{{depend suffix}} {{var suffix}}{{/depend}}<br/>\r\n{{depend company}}{{var company}}<br />{{/depend}}\r\n{{if street1}}{{var street1}}<br />{{/if}}\r\n{{depend street2}}{{var street2}}<br />{{/depend}}\r\n{{depend street3}}{{var street3}}<br />{{/depend}}\r\n{{depend street4}}{{var street4}}<br />{{/depend}}\r\n{{if city}}{{var city}},  {{/if}}{{if region}}{{var region}}, {{/if}}{{if postcode}}{{var postcode}}{{/if}}<br/>\r\n{{var country}}<br/>\r\n{{depend telephone}}T: {{var telephone}}{{/depend}}\r\n{{depend fax}}<br/>F: {{var fax}}{{/depend}}\r\n{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}'),
(446, 'default', 0, 'customer/address_templates/pdf', '{{depend prefix}}{{var prefix}} {{/depend}}{{var firstname}} {{depend middlename}}{{var middlename}} {{/depend}}{{var lastname}}{{depend suffix}} {{var suffix}}{{/depend}}|\r\n{{depend company}}{{var company}}|{{/depend}}\r\n{{if street1}}{{var street1}}\r\n{{/if}}\r\n{{depend street2}}{{var street2}}|{{/depend}}\r\n{{depend street3}}{{var street3}}|{{/depend}}\r\n{{depend street4}}{{var street4}}|{{/depend}}\r\n{{if city}}{{var city}},|{{/if}}\r\n{{if region}}{{var region}}, {{/if}}{{if postcode}}{{var postcode}}{{/if}}|\r\n{{var country}}|\r\n{{depend telephone}}T: {{var telephone}}{{/depend}}|\r\n{{depend fax}}<br/>F: {{var fax}}{{/depend}}|\r\n{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}|'),
(447, 'default', 0, 'customer/address_templates/js_template', '#{prefix} #{firstname} #{middlename} #{lastname} #{suffix}<br/>#{company}<br/>#{street0}<br/>#{street1}<br/>#{street2}<br/>#{street3}<br/>#{city}, #{region}, #{postcode}<br/>#{country_id}<br/>T: #{telephone}<br/>F: #{fax}<br/>VAT: #{vat_id}'),
(448, 'default', 0, 'customer/captcha/enable', '0'),
(449, 'websites', 1, 'dev/debug/template_hints', '0'),
(450, 'websites', 1, 'dev/debug/template_hints_blocks', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
