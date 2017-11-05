<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductOption;
use AppBundle\Entity\ProductOptionChoice;
use AppBundle\Entity\CartItem;
use AppBundle\Entity\CartOption;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:Product')->findAll();
        
        return $this->render('default/index.html.twig', [
            'products' => $products
        ]);
    }
    
    /**
     * @Route("/testdata", name="testdata")
     */
    public function testdataAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        // Maak een optie om de kleur van een T-shirt te kiezen
        $option1 = new ProductOption();
        $option1->setName('T-shirt Kleur');
        $option1->setOptionLabel('Kleur');
        
        $optionChoice = new ProductOptionChoice();
        $optionChoice->setName('Rood');
        $option1->addChoice($optionChoice);
        
        $optionChoice = new ProductOptionChoice();
        $optionChoice->setName('Wit');
        $option1->addChoice($optionChoice);
        
        $optionChoice = new ProductOptionChoice();
        $optionChoice->setName('Zilver');
        $optionChoice->setPrice(5.0);
        $option1->addChoice($optionChoice);
        
        $em->persist($option1);
        
       // Maak een optie om de maat van een T-shirt te kiezen
        $option2 = new ProductOption();
        $option2->setName('T-shirt maat');
        $option2->setOptionLabel('Maat');
        
        $optionChoice = new ProductOptionChoice();
        $optionChoice->setName('Small');
        $option2->addChoice($optionChoice);
        
        $optionChoice = new ProductOptionChoice();
        $optionChoice->setName('Medium');
        $option2->addChoice($optionChoice);
        
        $optionChoice = new ProductOptionChoice();
        $optionChoice->setName('Large');
        $option2->addChoice($optionChoice);
        
        $optionChoice = new ProductOptionChoice();
        $optionChoice->setName('Extra large');
        $optionChoice->setPrice(2.50);
        $option2->addChoice($optionChoice);
        
        $em->persist($option2);
        
       // Maak een product T-shirt aan
        $product = new Product();
        $product->setName('Super Cool Symfony T-shirt');
        $product->setPrice(20.0);
        $product->addOption($option1);
        $product->addOption($option2);
        $em->persist($product);
        
       // Maak een product Baseball cap aan
        $product = new Product();
        $product->setName('Super Cool Symfony Baseball Cap');
        $product->setPrice(14.5);
        $product->addOption($option1);
        $em->persist($product);
        
       // Maak een product Tea cup aan
        $product = new Product();
        $product->setName('Symfony Tea Cup');
        $product->setPrice(3.95);
        $em->persist($product);
        
        $em->flush();

        return new Response('Testdata is aangemaakt.');
    }
    
    /**
     * @Route("/products/show/{productId}", name="product_show")
     * @Method({"GET", "POST"})
     */
    public function showProductAction(Request $request, $productId)
    {
        $em = $this->getDoctrine()->getManager();
        
        $product = $em->getRepository('AppBundle:Product')->find($productId);
        
        if(null === $product) {
            throw $this->createNotFoundException('Dit product bestaat niet.');
        }
        
        $cartItem = new Cartitem($product);

        $form = $this->createForm('AppBundle\Form\CartItemType', $cartItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cartItem);
            $em->flush();

            $this->addFlash(
                'notice',
                'Uw bestelling is toegevoed aan de winkelwagen'
            );

            return $this->redirectToRoute('product_show', array('productId' => $productId));
        }

        return $this->render('default/show-product.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }
}
