<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Todo::class, mappedBy="category")
     */
    private $todos;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $color;

    public function __construct() {
        $this->todos = [];    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function addTodo(Todo $todo): void {
        array_push($this->todos, $todo);
    }

    public function getTodos(): array {
        return $this->todos;
    }
}
