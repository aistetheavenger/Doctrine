<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/insertProduct", name="insertProduct")
     */
    public function addProduct()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setTitle("Lattee");
        $product->setPrice(2);
        $product->setActive(true);

        $category = new Category();
        $category->setTitle("Coffee");
        $category->addProduct($product);

        $entityManager->persist($category);
        $entityManager->flush();

        return new Response('Saved new product '.$product->getTitle().' in category: '. $category->getTitle());
    }

    /**
     * @Route("/deleteProduct/{id}", name="deleteProduct")
     */
    public function removeProduct(Product $product)
    {
        $entityManager = $this->getDoctrine()->getManager();        

        $entityManager->remove($product);
        $entityManager->flush();

        return new Response('Deleted product '.$product->getTitle());
    }
}