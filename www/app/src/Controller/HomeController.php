<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Todo;
use App\Service\TodoService;

class HomeController extends AbstractController {

    private $todoService;

    public function __construct(TodoService $service) {
        $this->todoService = $service;
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response {
        $uri = $this->generateUrl('add_todo');

        return $this->render(
            'home/home.html.twig',
            [
                'todos' => $this->todoService->findAll(),
                'addUri' => $uri
            ]
        );
    }

    /**
     * @Route("/add", name="add_todo")
     * 
     * Client -> GET http://127.0.0.1:8081/add
     */
    public function addTodo(): Response {
        $todo = new Todo();
        $todo->setTitle('Controller Symfony');
        $todo->setDescription('Mécanisme du contrôleur');
        $todo->setBeginDate(new \DateTime());
        $todo->setDuration(2);

        // Appeler le service pour assurer la persistence de l'entité
        $newTodo = $this->todoService->add($todo);

        // Retourner une réponse pour affichage du résultat
        return $this->render(
            'home/todo.html.twig',
            ['todo' => $newTodo]
        );
    }
}