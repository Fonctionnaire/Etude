<?php

namespace App\Repository\Etude;

use App\Entity\Etude\Etude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Etude|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etude|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etude[]    findAll()
 * @method Etude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Etude::class);
    }

    public function findEtudeNonValide()
    {
        return $this->createQueryBuilder('e')
            ->where('e.valide = false')
            ->getQuery()
            ->getResult();
    }

    public function findLastTenEtude()
    {
        return $this->createQueryBuilder('e')
            ->where('e.valide = true')
            ->orderBy('e.dateAjout', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
