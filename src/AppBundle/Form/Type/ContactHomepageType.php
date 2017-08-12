<?php

namespace AppBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ContactHomepageType
 *
 * @category FormType
 * @package  AppBundle\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class ContactHomepageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                array(
                    'label'    => false,
                    'required' => true,
                    'attr'     => array(
                        'placeholder' => 'Nom *',
                    ),
                )
            )
            ->add(
                'email',
                EmailType::class,
                array(
                    'label'    => false,
                    'required' => true,
                    'attr'     => array(
                        'placeholder' => 'Email *',
                    ),
                    'constraints' => array(
                        new Assert\Email(
                            array(
                                'checkMX'   => true,
                                'checkHost' => true,
                                'strict'    => true,
                                'message'   => 'Email invàlid'
                            )
                        ),
                    )
                )
            )
            ->add(
                'phone',
                TextType::class,
                array(
                    'label'    => false,
                    'required' => false,
                    'attr'     => array(
                        'placeholder' => 'Telèfon',
                    ),
                )
            )
            ->add(
                'recaptcha',
                EWZRecaptchaType::class,
                array(
                    'label' => ' ',
                    'constraints' => array(
                        new RecaptchaTrue(),
                    )
                )
            )
            ->add(
                'send',
                SubmitType::class,
                array(
                    'label' => 'Enviar',
                    'attr'  => array(
                        'class' => 'btn-danger',
                    ),
                )
            )
        ;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'contact_homepage';
    }
}
