<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\Facture;
use AppBundle\Entity\Customer;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections;

class ProfileController extends Controller
{
    /**
     * Finds and displays a customer entity.
     *
     * @Route("profile", name="customer_show")
     *
     */
    public function profileActionAction()
    {
        // if(){

        //     $message = "Merci de remplir de formulaire afin d'accéder à votre espace client";
            
        //     return $this->redirectToRoute('customer_new', array(
        //         'message' => $message,
        //     ));
        // }
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $customer = $em->getRepository('AppBundle:Customer')->findByUser($user)[0];// @hack

        $ticket = $em->getRepository('AppBundle:Ticket')->findByCustomer($customer);
        
        $tickets = new Collections\ArrayCollection($ticket);

        return $this->render('@FOSUser/Profile/show_content.html.twig', array(
            'customer' => $customer,
            'tickets' => $tickets,
            'user' => $user,
        ));
    }




}
