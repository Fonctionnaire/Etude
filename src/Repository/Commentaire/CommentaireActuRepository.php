<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/06/2018
 * Time: 17:41
 */

namespace App\Repository\Commentaire;


use App\Entity\Commentaire\CommentaireActu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentaireActu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireActu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireActu[]    findAll()
 * @method CommentaireActu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireActuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentaireActu::class);
    }



    public function findSignaleComments()
    {
        return $this->createQueryBuilder('c')
            ->where('c.signale = true')
            ->getQuery()
            ->getResult();
    }
}