<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\ValidationLocationType;
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

        if(!$endDate or !$startDate){
            return $this->render('car/detail.html.twig',[ 'car' => $car , 'user' => $user,'error' => 'Veuillez définir vos dates']);
        }

       
        $duree = $endDate->diff($startDate)->days;
       return $this->render('location/request_rent.html.twig',[
           'car'=> $car,'diff'=>$duree,'enddate'=>$endDate,'startdate'=>$startDate,'user'=>$user,
           
       ]);
    

    }  

    /**
     * @Route("/validation/rent/{id}", name="validation_rent")
     */
    public function ValidationRent(Request $request, $id, \Swift_Mailer $mailer)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = null;
        if ($this->getUser()) {
            $user = $this->getUser();
        }
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);

        $proprietaire = $car->getUser();
        $endDate = $this->session->get('endDate');
        $startDate = $this->session->get('startDate');
      

        $entityManager = $this->getDoctrine()->getManager();
        $location = new Location();

        $location->setdatedebut($startDate);
        $location->setdatefin($endDate);
        $location->setUser($this->getUser());
        $location->setValidateProp(false);

        $car->addLocations($location);

        $entityManager->persist($location);
        $entityManager->persist($car);

        $entityManager->flush();

        $this->sendRequestLocationToProps($mailer, $car, $location, $proprietaire);
      
          
       return $this->render('profil.html.twig',[
           'car'=> $car, 'user' => $user]);
        

    }

    
    public function sendRequestLocationToProps($mailer, $car, $location, $proprietaire)
    {

        $message = (new \Swift_Message('Demande de location'))
        ->setFrom('rentandgo@homtail.fr')
        ->setTo($proprietaire->getemail())
        ->setBody(
            $this->renderView(
                'emails/request_location.html.twig',
                ['car' => $car, 'location' => $location]
            ),
            'text/html'
        );

        $mailer->send($message);
    }


    /**
     * @Route("/confirmation/rent/{id}", name="confirmation_rent")
     */
    public function confirmationRent(Request $request, $id, \Swift_Mailer $mailer)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = null;
        if ($this->getUser()) {
            $user = $this->getUser();
        }

        $location = $this->getDoctrine()->getRepository(Location::class)->find($id);
        $proprietaire = $location->getCar()->getUser();   
        $duree = $location->getdatefin()->diff($location->getdatedebut())->days;   
        $form = $this->createForm(ValidationLocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            


            $this->sendResponseLocationToLoueur($mailer, $location->getCar(), $location);
          
            return $this->redirectToRoute('home');
        }

      
          
       return $this->render('location/request_rent_confirmation.html.twig',[
           'car'=> $location->getCar(), 'proprietaire' => $proprietaire, 'user' => $user, 
           'location' => $location,
           'diff' => $duree,
           'form' => $form->createView(),]);
        

    }


    public function sendResponseLocationToLoueur($mailer, $car, $location)
    {

        $message = (new \Swift_Message('Response de location'))
        ->setFrom('rentandgo@homtail.fr')
        ->setTo($location->getUser()->getemail())
        ->setBody(
            $this->renderView(
                'emails/response_location.html.twig',
                ['car' => $car, 'location' => $location]
            ),
            'text/html'
        );

        $mailer->send($message);
    }
   
}