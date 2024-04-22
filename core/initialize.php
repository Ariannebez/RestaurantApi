<?php
// DS stands for directory separator, ':' means else 
// ? means true
defined('DS')? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'Applications'.DS.'MAMP'.DS.'htdocs'.DS.'RestaurantApi');

defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

require_once(INC_PATH.DS.'config.php');
require_once(CORE_PATH.DS.'clients.php'); 
require_once(CORE_PATH.DS.'address.php'); 
require_once(CORE_PATH.DS.'staff.php'); 
require_once(CORE_PATH.DS.'town.php');
require_once(CORE_PATH.DS.'country.php');
require_once(CORE_PATH.DS.'role.php');