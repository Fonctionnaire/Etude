<?php

namespace App\Repository\Categorie;

use App\Entity\Categorie\CategoriesImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoriesImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesImage[]    findAll()
 * @method CategoriesImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoriesImage::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
