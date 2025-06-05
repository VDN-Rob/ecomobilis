CREATE TABLE `faq` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `category` varchar(255) DEFAULT NULL,
    `order` int(11) DEFAULT NULL,
    `question` varchar(255) DEFAULT NULL,
    `answer` TEXT DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
