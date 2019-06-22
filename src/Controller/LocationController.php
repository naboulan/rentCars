<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\location as Location;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/location")
 */
class LocationController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/request/rent/{id}", name="request_rent")
     */
    public function requestRent(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = null;
        if ($this->getUser()) {
            $user = $this->getUser();
        }
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);

        $endDate = $this->session->get('endDate');
        $startDate = $this->session->get('startDate');
        $duree = $endDate->diff($startDate)->days;
       return $this->render('location/request_rent.html.twig',[
           'car'=> $car,'diff'=>$duree,'enddate'=>$endDate,'startdate'=>$startDate,'user'=>$user,
           
       ]);
    

    }  
    /**
     * @Route("/validation/rent/{id}", name="validation_rent")
     */
    public function ValidationRent(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);

        $endDate = $this->session->get('endDate');
        $startDate = $this->session->get('startDate');
//jbjbj
        $entityManager = $this->getDoctrine()->getManager();
        $location = new Location();

        $location->setdatedebut($startDate);
        $location->setdatefin($endDate);
        $location->setUser($this->getUser());

        $car->addLocations($location);

        $entityManager->persist($location);
        $entityManager->persist($car);

        $entityManager->flush();
//khkhk
          
       return $this->render('profil.html.twig',[
           'car'=> $car]);
        

    }
   
}