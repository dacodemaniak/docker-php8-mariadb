<?php
namespace App\Repository;

use App\Entity\Todo;

class TodoRepository {
    private $todos;

    public function __construct() {
        $this->todos = [];
        $this->_createTodos();
    }

    public function findAll(): array {
        return $this->todos;
    }

    private function _createTodos(): void {

        $todo = new Todo();
        $todo->setId(1);
        $todo->setTitle('Framework PHP Symfony');
        array_push($this->todos, $todo);

        $todo = new Todo();
        $todo->setId(2);
        $todo->setTitle('Controller Symfony');
        array_push($this->todos, $todo);

        $todo = new Todo();
        $todo->setId(3);
        $todo->setTitle('Template Twig');
        array_push($this->todos, $todo);
    }
}