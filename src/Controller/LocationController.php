<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\LocationType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/location")
 */
class LocationController extends AbstractController
{
    
    /**
     * @Route("/request/rent/{id}", name="request_rent")
     */
    public function requestRent(Request $request, $id)
    {

        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);

        $form = $this->createForm(LocationType::class);
        $form->handleRequest($request);
        
     /*   if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $hash= $encoder->encodePassword($user,$user->getmdp());
            $user->setmdp($hash);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }*/

       return $this->render('location/request_rent.html.twig',[
           'car'=> $car,
           'form' => $form->createView(),
           
       ]);

    }  
    
    

}