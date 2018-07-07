<?php

namespace App\Repository\Newsletter;

use App\Entity\Newsletter\SendNewsletter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SendNewsletter|null find($id, $lockMode = null, $lockVersion = null)
 * @method SendNewsletter|null findOneBy(array $criteria, array $orderBy = null)
 * @method SendNewsletter[]    findAll()
 * @method SendNewsletter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SendNewsletterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SendNewsletter::class);
    }

}
