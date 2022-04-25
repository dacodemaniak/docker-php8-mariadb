<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {

    /**
     * @var CategoryService
     */
    private $service;

    public function __construct(CategoryService $service) {
        $this->service = $service;
    }

    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/category/add", name="add_category")
     */
    public function addCategory(): void {
        $category = new Category();
        $category->setLabel("Personnel");
        $category->setColor("#999");

        $this->service->add($category);

        $category = new Category();
        $category->setLabel("Professionnel");
        $category->setColor("#888");

        $this->service->add($category);

    }
}
