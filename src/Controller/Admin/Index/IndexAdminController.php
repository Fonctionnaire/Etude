<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 25/04/2018
 * Time: 13:44
 */

namespace App\Controller\Admin\Index;


use App\Entity\Actualite\Actualite;
use App\Entity\Categorie\Categorie;
use App\Entity\Contact\Contact;
use App\Entity\Etude\Etude;
use App\Entity\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexAdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin_index")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAdmin()
    {

        $em = $this->getDoctrine()->getManager();
        $allActu = $em->getRepository(Actualite::class)->findAll();
        $allEtudes = $em->getRepository(Etude::class)->findAll();
        $allCat = $em->getRepository(Categorie::class)->findAll();
        $allUser = $em->getRepository(User::class)->findAll();
        $nonValideEtudes = $em->getRepository(Etude::class)->findEtudeNonValide();
        $etudesRefuses = $em->getRepository(Etude::class)->findEtudesRefuses();
        $contactAttente = $em->getRepository(Contact::class)->findAttenteContact();

        return $this->render('admin/indexAdmin/indexAdmin.html.twig', array(
            'allActu' => $allActu,
            'allEtudes' => $allEtudes,
            'allCat' => $allCat,
            'allUser' => $allUser,
            'nonValideEtudes' => $nonValideEtudes,
            'etudesRefuses' => $etudesRefuses,
            'contactAttente' => $contactAttente,
        ));
    }
}