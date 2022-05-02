<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\CategoryService;
use App\Service\Exception\NotFoundException;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            'controller_name' => 'Categories',
            'list' => $this->service->findAll(),
            'addUri' => $this->generateUrl('add_category')
        ]);
    }

    /**
     * @Route("/category/add", name="add_category")
     */
    public function addCategory(Request $request): Response {
        $category = new Category(); // Une instance vide de l'entité Category

        // Créer le formulaire
        $form = $this->createFormBuilder($category)
            ->add('label', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Catégorie']
                ]
            )
            ->add('color',  TextType::class, [
                'label' => 'Couleur',
                'attr' => ['placeholder' => 'Couleur']
                ]
            )
            ->add('save', SubmitType::class, ['label' => 'Créer'])
            ->getForm(); // Récupération du formulaire construit

        // Traiter le formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            // On fait ce qu'on a à faire avec l'objet Todo qui contient les données saisies
            if (!$this->service->categoryExists($category->getLabel())) {
                $this->service->add($category);
                // Redirige vers la page d'accueil qui affiche tous les todos
                return $this->redirectToRoute('app_category');
            } else {
                // La catégorie existe déjà, informer l'utilisateur...
                $this->addFlash(
                    'error',
                    'La catégorie ' . $category->getLabel() . ' existe déjà dans la base de données'
                );
            }
        }

        return $this->render(
            'category/add-category.html.twig',
            [
                'categoryForm' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/category/delete/{id}", name="category-delete")
     */
    public function remove(int $id): Response {

        try {
            $this->service->remove($id);
        } catch (\Exception $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
        } catch(NotFoundException $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
        }
        

        return $this->render('category/index.html.twig', [
            'controller_name' => 'Categories',
            'list' => $this->service->findAll(),
            'addUri' => $this->generateUrl('add_category')
        ]);
    }

    /**
     * @Route("/category/update/{id}", name="category-update")
     */
    public function update(int $id, Request $request): Response {
        $category = $this->service->findOne($id);

        $form = $this->createFormBuilder($category)
            ->add('label', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Catégorie']
            ])
            ->add('color', TextType::class, [
                'label' => 'Couleur',
                'attr' => ['placeholder', 'Couleur']
            ])
            ->add('id', HiddenType::class)
            ->add('save', SubmitType::class, ['label' => 'Mettre à jour'])
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $this->service->add($category);

            return $this->redirectToRoute('app_category');
        }

        return $this->render(
            'category/update-category.html.twig',
            [
                'categoryForm' => $form->createView()
            ]
        );
        
    }
}
