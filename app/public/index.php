<?php
/**
 * @name index.php
 * @author Aélion (jean-luc.aubert@aelion.fr)
 * @version 1.0.0
 * Entry point in the application. Every Request may fallback to this unique file
 * then is dispatched to the according controller.
 * Finally, after the request was processed, Response will be send to web server
 * to be available to the client.
 */

// Require Composer autoloader based on PSR4 definitions (@see composer.json)
require_once('./../vendor/autoload.php');

use \Aelion\Kernel;

$kernel = Kernel::create();