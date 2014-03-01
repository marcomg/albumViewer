<?php
/**
 * Do everything albumVisualizer needs to load.
 */

/**
 * Require all needed libs
 */
require(ROOT . '/includes/smarty/Smarty.class.php');
require(ROOT . '/includes/albumVisualizer.php');

/**
 * Config
 */
define('URL', 'http://localhost');

/**
 * Get the page to load
 */
if(empty($_GET['q']))
    $q = array('home_page');
else
    $q = explode('/', $_GET['q']);

error_reporting(0);
new albumVisualizer($q, ROOT . '/albums', ROOT . '/cache/public', ROOT . '/templates', ROOT . '/cache/compiles');
