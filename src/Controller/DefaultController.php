<?php
    
namespace App\Controller;
    
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
    
class DefaultController extends AbstractController
{
   /**
     * @Route("/{reactRouting}", name="Home", defaults={"reactRouting": null})
    */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }
}