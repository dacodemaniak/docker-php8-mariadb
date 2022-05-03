<?php
namespace App\Service;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use App\Service\Exception\NotFoundException;

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

    public function remove(int $id): void {
        $todo = $this->todoRepository->find($id);
        if ($todo) {
            $this->todoRepository->remove($todo);
            return;
        }
        throw new NotFoundException('Le todo n° ' . $id . 'n\'existe plus !');
    }

    public function find(int $id): ?Todo {
        return $this->todoRepository->find($id);
    }
}