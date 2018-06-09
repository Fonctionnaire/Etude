<?php

namespace App\Repository\Actualite;

use App\Entity\Actualite\Actualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Actualite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actualite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actualite[]    findAll()
 * @method Actualite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Actualite::class);
    }


    public function findLastActu()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.dateAjout', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findLastFiveActu($slug)
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.dateAjout', 'DESC')
            ->where('a.slug != :slug')
            ->setParameter('slug', $slug)
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
            ;
    }
}
