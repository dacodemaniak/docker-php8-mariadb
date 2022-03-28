<?php
namespace Aelion;

use \Aelion\Http\Foundation\Request;
use \Aelion\Http\Foundation\Response;

/**
 * @name Kernel
 * @author Aélion (jean-luc.aubert@aelion.fr)
 * @version 1.0.0
 * Request handler that's produce a Response. Kernel manage routes and security
 */
final class Kernel {
    /**
     * 
     * @var {Kernel} $instance
     * 
     * Current instance of the Kernel singleton
     */
    private static $instance;

    /**
     * Http Request object
     * @var {Request}
     */
    private $request;

    private function __construct() {}

    /**
     * Create a Kernel instance if not and return it
     * 
     * @return Aelion\Kernel
     */
    public static function create(): Kernel {
        if (!self::$instance) {
            self::$instance = new Kernel();
        }

        return self::$instance;
    }

    public function handleRequest(): Response {
        $this->request = new Request();
        
        $response = new Response();

        // For demo purpose
        $response->setContent($this->request->get('name', 'Jean-Luc'));

        return $response;
    }

    public function getRequest(): Request {
        return $this->request;
    }
}

