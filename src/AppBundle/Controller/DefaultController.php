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
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ContactHomepageType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Flash
            $this->addFlash(
                'notice',
                'Missatge enviat correctament, respondrem el més aviat possible. Gràcies.'
            );
            // Email
            $message = \Swift_Message::newInstance()
                ->setSubject('Missatge de contacte pàgina web www.teicar.com')
                ->setFrom($this->getParameter('delivery_address'))
                ->setTo($this->getParameter('delivery_address'))
                ->setBody(
                    $this->renderView(
                        'mail/contact_form_admin_notification.html.twig',
                        array('contact' => $form->getData())
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }

        return $this->render(
            'default/index.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }
}
