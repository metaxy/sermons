DROP TABLE IF EXISTS `#__sermonsFile`;
DROP TABLE IF EXISTS `#__sermonsFolder`;
CREATE TABLE `#__sermonsFile` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) character set utf8 NOT NULL,
  `speaker` varchar(100) character set utf8 NOT NULL,
  `topic` varchar(200) character set utf8 NOT NULL,
  `path` varchar(200) character set utf8 NOT NULL,
  `date` varchar(200) character set utf8 NOT NULL,
  `folder` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `links` text,
  `privateFile` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

CREATE TABLE `#__sermonsFolder` (
  `id` int(11) NOT NULL auto_increment,
  `alias` varchar(100) character set utf8 NOT NULL,
  `path` varchar(200) character set utf8 NOT NULL,
  `parentFolder` int(11) NOT NULL ,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;
