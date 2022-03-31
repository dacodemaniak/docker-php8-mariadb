<?php
namespace App\Entity;

class Todo {
    private $id;

    private $title;

    private $description;

    private $beginDate;

    private $duration;

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
}