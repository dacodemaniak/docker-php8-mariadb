<?php
namespace App\Service;

use App\Entity\Todo;
use App\Repository\TodoRepository;

class TodoService {
    private $todoRepository;

    /**
     * TodoRepository va être automatiquement "injecté" dans le service courant
     * - Une instance de TodoRepository va être automatiquement créée par Symfony
     */
    public function __construct(TodoRepository $repository) {
        $this->todoRepository = $repository;
    }

    public function findAll(): array {
        return $this->todoRepository->all();
    }

    public function add(Todo $todo): Todo {
        return $this->todoRepository->add($todo);
    }
}