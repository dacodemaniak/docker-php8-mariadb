<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass=TodoRepository::class)
 */
class Todo {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @var {int}
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * 
     * @var {string}
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * 
     * @var {string}
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * 
     * @var {\DateTime}
     */
    private $beginDate;

    /**
     * @ORM\Column(type="float")
     * 
     * @var {float}
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="todos")
     */
    private $category;

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }
    
    public function getDescription(): ?string {
        return $this->description;
    }

    public function setBeginDate(\DateTime $beginDate): void {
        $this->beginDate = $beginDate;
    }

    public function getBeginDate(): ?\DateTime {
        return $this->beginDate;
    }

    public function setDuration(float $duration): void {
        $this->duration = $duration;
    }

    public function getDuration(): ?float {
        return $this->duration;
    }

    public function setCategory(Category $category): void {
        $this->category = $category;
    }

    public function getCategory(): ?Category {
        return $this->category;
    }
}