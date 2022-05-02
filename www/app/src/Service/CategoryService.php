<?php
namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
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
}