<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Todo;
use App\Service\TodoService;

class HomeController extends AbstractController {

    private $todoService;

    public function __construct() {
        $this->todoService = new TodoService();
    }

    /**
     * @Route("/")
     */
    public function home(): Response {
        return $this->render(
            'home/home.html.twig',
            ['todos' => $this->todoService->findAll()]
        );
    }
}