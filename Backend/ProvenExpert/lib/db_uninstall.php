<?php

/**
 * Contains the database commands to be run during uninstall
 *
 */
    $sql = "DROP TABLE IF EXISTS `s_plugin_provenexpert_rs`;";
    Shopware()->Db()->query($sql);
    
    $sql = "DROP TABLE IF EXISTS `s_plugin_provenexpert_seals`;";
    Shopware()->Db()->query($sql);