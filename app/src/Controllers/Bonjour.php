<?php
namespace App\Controllers;

use \Aelion\Kernel;
use \Aelion\Http\Foundation\Response;

class Bonjour {
    public function __construct() {}

    public function process(): Response {
        $response = new Response();

        $request = Kernel::create()->getRequest();

        $response->setContent($request->get('name', 'Jean-Luc'));

        return $response;
    }
}