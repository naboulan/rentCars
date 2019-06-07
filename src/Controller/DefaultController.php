<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('home.html.twig');
        
    }

    /**
     * @Route("/deconnection", name="home_logout")
     */
    public function logout()
    {
        
    }
    /**
     * @Route("/profil", name="home_profil")
     */
    public function profil()
    {
        return $this->render('profil.html.twig');  
    }
}
