<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;


class CartOptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $cartOption = $event->getData();
            $form = $event->getForm();

            $form->add('productOptionChoice', EntityType::class, array(
                'class' => 'AppBundle:ProductOptionChoice',
                'query_builder' => function (EntityRepository $er) use ($cartOption) {
                    return $er->createQueryBuilder('c')
                        ->join('c.option', 'o')
                        ->where('o.id=:id')
                        ->setParameter('id', $cartOption->getProductOption()->getId())
                    ;
                },
                'label' => $cartOption->getProductOption()->getOptionLabel(),
                'placeholder' => 'Maak een keuze',
                /*
                 * voeg een data-price attribuut toe aan de <option> elementen
                 */
                'choice_attr' => function (\AppBundle\Entity\ProductOptionChoice $choice, $key, $index) {
                    return ['data-price' => (float) $choice->getPrice()];
                },
                
                /*
                 * Voeg een class attibuut toe aan de <select> element
                 */
                'attr' => array(
                    'class' => 'productoption'
                )
            ));
        });
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CartOption'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cartoption';
    }


}