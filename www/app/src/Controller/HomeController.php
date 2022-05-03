<?php
namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Todo;
use App\Service\TodoService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
    public function addTodo(Request $request): Response {
        $todo = new Todo();
        $todo->setTitle('');
        $todo->setDescription('');
        $todo->setBeginDate(new \DateTime());
        $todo->setDuration(1);

        // Appeler le service pour assurer la persistence de l'entité
        //$newTodo = $this->todoService->add($todo);

        // Créer un formulaire à l'aide d'un FormBuilder
        $form = $this->createFormBuilder($todo)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
                'label' => 'Catégorie'
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => ['placeholder' => 'Titre du todo']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Description']
            ])
            ->add('beginDate', DateType::class, [
                'label' => 'Date de début'
            ])
            ->add('duration', NumberType::class, [
                'label' => 'Durée'
            ])
            ->add('save', SubmitType::class, ['label' => 'Créer'])
            ->getForm();

        // Traiter le formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todo = $form->getData();

            // On fait ce qu'on a à faire avec l'objet Todo qui contient les données saisies
            $this->todoService->add($todo);

            // Redirige vers la page d'accueil qui affiche tous les todos
            return $this->redirectToRoute('home');
        }

        // Retourner une réponse pour affichage du résultat
        return $this->render(
            'home/todo.html.twig',
            ['todoForm' => $form->createView()]
        );
    }

    /**
     * @Route("/todo/delete/{id}", name="todo-delete")
     */
    public function remove(int $id): Response {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/todo/update/{id}", name="todo-update")
     */
    public function update(int $id, Request $request): Response {
        return $this->redirectToRoute('home');
    }
}