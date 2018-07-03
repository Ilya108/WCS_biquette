<?php

namespace AppBundle\Controller;

use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Velo;
use Symfony\Component\HttpFoundation\Response;

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
     * @Method({"GET", "POST"})
     */
    public function indexAction(request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if (isset ($_POST['ville'])) {
            $criteria = ($_POST['ville']);
            $velos=$this->getDoctrine()->getManager()->getRepository(Velo::class)->findBy(array('ville'=>$criteria));

            // replace this example code with whatever you need
            return $this->render('recherche/rechercheListe.html.twig', array(
                'velos' => $velos,
                'membre'=> $this->getUser(),
            ));
        }

        $velos=$this->getDoctrine()->getManager()->getRepository(Velo::class)->findAll();

        // replace this example code with whatever you need
        return $this->render('recherche/rechercheListe.html.twig', array(
            'velos' => $velos,
            'membre'=> $this->getUser(),

        ));
    }

    /**
     * Search velos.
     *
     * @Route("/getVille/{nom}", name="ville_search")
     * @Method({"GET"})
     */
    public function searchAction($nom, SerializerInterface $serializer): Response
    {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository(Velo::class)->findByExampleField($nom);
        //$resultJson = array();
        //foreach ($result as $value)
        //{
        //    $veloSimple['ville'] = $value->getVille();
        //    $resultJson[]=$veloSimple;
        //}

        $data = $serializer->serialize($result, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

