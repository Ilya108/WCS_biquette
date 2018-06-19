<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Velo;

/**
 * Profil controller.
 *
 * @Route("recherche-liste")
 * @Method("GET")
 */
class RechercheListeController extends Controller
{
    /**
     * Lists velos.
     *
     * @Route("/", name="recherche-liste")
     * @Method({"GET"})
     */
    public function indexAction(request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $velo=$this->getDoctrine()->getManager()->getRepository(Velo::class)->findAll();
        $search = $em->getRepository('AppBundle:Velo')->searchAnnonces();

        // replace this example code with whatever you need
        return $this->render('recherche/rechercheListe.html.twig', array(
            'search' => $search,
            'velo' => $velo
        ));
    }
}

