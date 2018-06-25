<?php

namespace App\Repository\Commentaire;

use App\Entity\Commentaire\CommentaireEtude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentaireEtude|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireEtude|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireEtude[]    findAll()
 * @method CommentaireEtude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireEtudeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentaireEtude::class);
    }



    public function findSignaleComments()
    {
        return $this->createQueryBuilder('c')
            ->where('c.signale = true')
            ->getQuery()
            ->getResult();
    }
}
