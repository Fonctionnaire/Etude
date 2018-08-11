<?php

namespace App\Repository\Etude;

use App\Entity\Etude\Etude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
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

    public function findLastEtudeValide()
    {
        return $this->createQueryBuilder('e')
            ->where('e.valide = true')
            ->andWhere('e.refuse = false')
            ->orderBy('e.dateValidation', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findEtudeNonValide()
    {
        return $this->createQueryBuilder('e')
            ->where('e.valide = false')
            ->andWhere('e.refuse = false')
            ->getQuery()
            ->getResult();
    }

    public function findEtudesRefuses()
    {
        return $this->createQueryBuilder('e')
            ->where('e.refuse = true')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findLastTenEtude()
    {
        return $this->createQueryBuilder('e')
            ->where('e.valide = true')
            ->andWhere('e.refuse = false')
            ->orderBy('e.dateValidation', 'DESC')
            ->setFirstResult(1)
            ->setMaxResults(21)
            ->getQuery()
            ->getResult();
    }

    public function findLastFiveEtudes($cat)
    {
        return $this->createQueryBuilder('e')
            ->where('e.valide = true')
            ->andWhere('e.refuse = false')
            ->andWhere('e.categorie != :cat')
            ->setParameter('cat', $cat)
            ->orderBy('e.dateValidation', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    public function findUserEtudesValide($user)
    {
    return $this->createQueryBuilder('e')
        ->where('e.valide = true')
        ->andWhere('e.user = :user')
        ->setParameter('user', $user)
        ->getQuery()
        ->getResult()
        ;
    }

    public function findUserEtudesNonValide($user)
    {
        return $this->createQueryBuilder('e')
            ->where('e.valide = false')
            ->andWhere('e.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findUserEtudesRefuse($user)
    {
        return $this->createQueryBuilder('e')
            ->where('e.refuse = true')
            ->andWhere('e.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByCat($categorie, $page)
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.refuse = false')
            ->andWhere('e.valide = true')
            ->andWhere('e.categorie = :cat')
            ->setParameter('cat', $categorie)
            ->orderBy('e.dateValidation', 'DESC')
            ->setFirstResult(($page - 1) * Etude::NB_ETUDES)
            ->setMaxResults(Etude::NB_ETUDES)
            ->getQuery()
        ;

        return new Paginator($qb, true);
    }

    public function findLastByCat($categorie, $slug)
    {
        return $this->createQueryBuilder('e')
            ->where('e.refuse = false')
            ->andWhere('e.valide = true')
            ->andWhere('e.categorie = :cat')
            ->andWhere('e.slug != :slug')
            ->setParameters(['cat' => $categorie, 'slug' => $slug])
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findEtudesPaginated($page)
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.refuse = false')
            ->andWhere('e.valide = true')
            ->orderBy('e.dateValidation', 'DESC')
            ->setFirstResult(($page - 1) * Etude::NB_ETUDES)
            ->setMaxResults(Etude::NB_ETUDES)
            ->getQuery()
            ;

        return new Paginator($qb, true);
    }

    public function findAllEtudesValide()
    {
        return $this->createQueryBuilder('e')
            ->where('e.refuse = false')
            ->andWhere('e.valide = true')
            ->orderBy('e.dateValidation', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

}
