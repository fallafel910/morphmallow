CREATE TABLE IF NOT EXISTS `#__nextend_smartslider_layouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slide` LONGTEXT NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE #__nextend_smartslider_layouts CHANGE `slide` `slide` LONGTEXT;

CREATE TABLE IF NOT EXISTS `#__nextend_smartslider_sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL,
  `params` text NOT NULL,
  `generator` text NOT NULL,
  `slide` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE #__nextend_smartslider_sliders CHANGE `slide` `slide` LONGTEXT;

CREATE TABLE IF NOT EXISTS `#__nextend_smartslider_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slider` int(11) NOT NULL,
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `first` int(11) NOT NULL,
  `slide` LONGTEXT NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `background` varchar(300) NOT NULL,
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `generator` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE #__nextend_smartslider_slides CHANGE `slide` `slide` LONGTEXT;


CREATE TABLE IF NOT EXISTS `#__nextend_smartslider_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL,
  `value` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE #__nextend_smartslider_storage CHANGE `value` `value` LONGTEXT;