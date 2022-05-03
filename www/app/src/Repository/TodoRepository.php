<?php
namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Todo::class);
    }

    public function all(): array {
        return $this->findAll();
    }

    public function add(Todo $todo): Todo {
        $this->_em->persist($todo);
        $this->_em->flush();

        return $todo;
    }

        /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Todo $entity, bool $flush = true): void {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}