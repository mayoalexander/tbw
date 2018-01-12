<?php
// Define the directory separator variable
define('DS', DIRECTORY_SEPARATOR);

// Include the autoloader for custom classes
require_once(__DIR__ . DS . 'Application' . DS . 'Autoload.php');

// Get the connection into the database
$request        = \Application::getSingleton('Core\Request');
$accountType    = '1'; //$request->getData('account-type');
$pricing        = \Application::getModel('Baewatch\Pricing')->load($accountType);
$price = '10';
$signup        = \Application::getSingleton('Core\Signup');

\Application::debug($signup);