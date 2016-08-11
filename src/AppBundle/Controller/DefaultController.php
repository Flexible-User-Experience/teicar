<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactHomepageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @category Controller
 * @package  AppBundle\Controller
 * @author   David Romaní <david@flux.cat>
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ContactHomepageType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash(
                'notice',
                'Missatge enviat correctament, respondrem el més aviat possible. Gràcies.'
            );
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
