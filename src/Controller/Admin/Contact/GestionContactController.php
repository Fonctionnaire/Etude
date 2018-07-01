<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 29/06/2018
 * Time: 13:21
 */

namespace App\Controller\Admin\Contact;


use App\Entity\Contact\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionContactController extends AbstractController
{

    /**
     * @Route("/admin/gestion-contact", name="admin_gestion_contact")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function gestionContact()
    {
        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository(Contact::class)->findAll();

        return $this->render('admin/contact/gestionContact.html.twig', array(
            'contacts' => $contacts
        ));
    }
}