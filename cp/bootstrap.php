<?php
/**
 * CrewkieCP is a powerful Control Panel that manages Ragnarok Online servers by providing
 * useful tools to players and staff, a powerful engine that can be used easily to brand the server
 * and unmatched security.
 *
 * @author Cookie
 * @package CrewkieCP
 * @description bootstrap.php is the core of the Control Panel. It performs actions that the entire application
 * utilize.
 */

// Set application path relative to this directory.
defined('APPLICATION_PATH') or define('APPLICATION_PATH', realpath(dirname(__FILE__)));

// Define the environment.
defined('APPLICATION_ENV') or define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

set_include_path(get_include_path() . PATH_SEPARATOR . APPLICATION_PATH);

// Set various paths.
$path['app']          = APPLICATION_PATH . '/';
$path['conf']         = realpath($path['app'] . 'config') . '/';
$path['writable']     = realpath($path['app'] . 'writable') . '/';
$path['pathWebWrite'] = realpath($path['app'].'public/writable').'/';
$path['cache']        = $path['writable'] . '/zendCache.php';
$path['log']          = realpath($path['app'] . '../config/log.ini');

require_once realpath(APPLICATION_PATH . '/../vendor/autoload.php');

// Zend Framework
try {
    // Autoload any classes/namespaces necessary.
    $reader = new Zend\Config\Reader\Ini();
    $config = $reader->fromFile($path['conf'] . 'autoload.ini');
    Zend\Loader\AutoloaderFactory::factory($config);

    // Grab the application configuration.
    Zend\Mvc\Application::init(require 'config/application.php')->run();

} catch (Exception $e) {
    if (class_exists('Plugin_Log') === false) {
        //die($e); // TODO
    }
}