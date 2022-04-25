<?php
namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

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
}