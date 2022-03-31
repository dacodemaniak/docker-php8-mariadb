<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Todo;

class HomeController extends AbstractController {

    /**
     * @Route("/")
     */
    public function home(): Response {
        return $this->render(
            'home/home.html.twig',
            ['todos' => $this->createTodos()]
        );
    }

    private function createTodos(): array {
        $todos = [];

        $todo = new Todo();
        $todo->setId(1);
        $todo->setTitle('Framework PHP Symfony');
        array_push($todos, $todo);

        $todo = new Todo();
        $todo->setId(2);
        $todo->setTitle('Controller Symfony');
        array_push($todos, $todo);

        $todo = new Todo();
        $todo->setId(3);
        $todo->setTitle('Template Twig');
        array_push($todos, $todo);

        return $todos;

    }
}