<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    // /**
    //  * @return Movie[] Returns an array of Movie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOneById($value): ?Movie
    {
        return $this->createQueryBuilder('m')//creador de la query
            ->andWhere('m.id = :val')//esta es la consulta
            ->setParameter('val', $value)//asigna parametros
            ->getQuery()//crea el query
            ->getOneOrNullResult()//lo ejecuta
        ;
    }

    //m. es el objeto movie que crea automaticamente
    public function findOneByTitle($value,$id): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.title LIKE :val AND m.id = :val2')//aqui no se puede concatenar, de poner % seria en setParameter
            ->setParameter('val', '%'.$value.'%')
            ->setParameter('val2', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findAllVisible()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.visible = :val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getResult()
        ;
    }
}
