<?php
namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Service\Exception\NotFoundException;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class CategoryService {
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository) {
        $this->repository = $repository;
    }

    public function findAll(): array {
        return $this->repository->findAll();
    }

    public function findOne(int $id): Category {
        return $this->repository->findOne($id);
    }

    public function add(Category $category): void {
        $this->repository->add($category);
    }

    public function categoryExists(string $label): bool {
        try {
            $this->repository->findByLabel($label);
            return true;
        } catch(NonUniqueResultException $e) {
            return true;
        } catch (NoResultException $e) {
            return false;
        }
    }

    public function remove(int $id): void {
        $category = $this->repository->find($id);

        if ($category) {
            try {
                $this->repository->remove($category);
            } catch(ForeignKeyConstraintViolationException $e) {
                throw new \Exception('Impossible de supprimer la catégorie : ' . $category->getLabel() . ' La catégorie est utilisée !');
            }
        }

        throw new NotFoundException('La catégorie : ' . $id . ' n\'existe plus');
    }

}