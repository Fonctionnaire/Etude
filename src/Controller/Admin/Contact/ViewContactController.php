<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 29/06/2018
 * Time: 14:16
 */

namespace App\Controller\Admin\Contact;


use App\Entity\Contact\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewContactController extends AbstractController
{

    /**
     * @Route("/admin/gestion-contact/{id}", name="admin_view_contact")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function viewContact(Contact $contact)
    {

        return $this->render('admin/contact/viewContact.html.twig', array(
            'contact' => $contact
        ));
    }

    /**
     * @Route("/admin/gestion-contact/{id}/traiter", name="admin_valide_contact")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function valideContact(Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $contact->setStatus(true);
        $em->flush();

        $this->addFlash('success', 'Le contact est marqué comme traité !');

        return $this->redirectToRoute('admin_view_contact', array(
            'id' => $contact->getId()
        ));
    }
}