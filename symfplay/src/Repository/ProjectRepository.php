<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    private function withTasks($projectId=null)
    {
        $qb= $this->createQueryBuilder("p")
                    ->addSelect("t");
            if ($projectId) {
                $qb->innerJoin("p.tasks","t",
                    "WITH", "p.id=:projectId");
                $qb->setParameter("projectId",$projectId);
            } else{
               $qb->innerJoin("p.tasks","t");
            }
            $query =  $qb->getQuery();
            return $query->getResult();
    }

    /**
     * @return Project[]| null Returns an array of Project objects
      */
    public function fetchAllProjectsWithTasks()
    {
        return $this->withTasks();
    }

    /**
     * @param $projectId
     * @return Project| null Returns an array of Project objects
     */
    public function fetchProjectByIdWithTasks($projectId)
    {
       return $this->withTasks($projectId);
    }
    // /**
    //  * @return Project[] Returns an array of Project objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
