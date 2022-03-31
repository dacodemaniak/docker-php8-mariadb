<?php
namespace App\Service;

use App\Repository\TodoRepository;

class TodoService {
    private $todoRepository;

    public function __construct() {
        $this->todoRepository = new TodoRepository();
    }

    public function findAll(): array {
        return $this->todoRepository->findAll();
    }
}