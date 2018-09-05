<?php

/**
 * Contains the database commands to be run during install
 *
 */
$sql = "CREATE TABLE IF NOT EXISTS `s_plugin_provenexpert_rs` (
                `id`                        int(3)          NOT NULL,
                `pe_rsApiScriptVersion`     varchar(3)      DEFAULT NULL,
                `pe_rsStatus`               varchar(1)      NOT NULL,
                `pe_rsVersion`              int(1)          NOT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        Shopware()->Db()->query($sql); 
        
        $sql = "CREATE TABLE IF NOT EXISTS `s_plugin_provenexpert_seals` (
                `id`                int(3)          NOT NULL,
		`pe_widgetActive`           varchar(1)      NOT NULL,
		`pe_type`                   varchar(30)     DEFAULT NULL UNIQUE,
		`pe_style`                  varchar(20)     DEFAULT NULL,
		`pe_feedback`               int(11)         DEFAULT NULL,
		`pe_avatar`                 int(11)         DEFAULT NULL,
		`pe_competence`             int(11)         DEFAULT NULL,
		`pe_position`               varchar(20)     DEFAULT NULL,
        `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        Shopware()->Db()->query($sql);    
        
        $sql = "INSERT INTO `s_plugin_provenexpert_rs` (`id`, `pe_rsApiScriptVersion`, `pe_rsStatus`, `pe_rsVersion`) 
                VALUES  (1, '1.7', 0, 1),
                        (2, '1.7', 0, 2),
                        (3, '1.7', 0, 3),
                        (4, '1.7', 0, 4)
                ON DUPLICATE KEY UPDATE `pe_rsApiScriptVersion` = '1.7';";
        Shopware()->Db()->query($sql);
        
        $sql = "INSERT INTO `s_plugin_provenexpert_seals` (`id`, `pe_widgetActive`, `pe_type`, `pe_style`, `pe_feedback`, `pe_avatar`, `pe_competence`, `pe_position`) 
                VALUES  (1, 0, 'portrait', NULL,    0, 0, 0, NULL),
                        (3, 0, 'circle',   NULL,    0, 0, 0, NULL),
                        (4, 0, 'logo',     NULL,    0, 0, 0, NULL),
                        (5, 0, 'bar',      'white', 0, 0, 0, NULL),
                        (6, 0, 'landing',  'white', 0, 0, 0, 'bottom')
                ON DUPLICATE KEY UPDATE `pe_competence` = 0;";
        Shopware()->Db()->query($sql);        
        