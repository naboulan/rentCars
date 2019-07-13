<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\location;
use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber;
use Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber;
use Knp\Component\Pager\Event;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
class DefaultController extends AbstractController
{
   

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session,PaginatorInterface $paginator)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->paginator = $paginator;
    }
    /**
     * @Route("/", name="home")
     */
    public function home()
    {   $user = null;
        if ($this->getUser()) {
            $user = $this->getUser();
        }
        $cars = $this->entityManager->getRepository(Car::class)->findlate();

        return $this->render('home.html.twig', array( 'cars' => $cars, 'user'=>$user));

    }

    /**
     * @Route("/deconnection", name="home_logout")
     */
    public function logout()
    {
        
    }
   

   
    
     /**
     * @Route("/search", name="search", methods={ "GET","POST"})
     */
    public function search(Request $request )
    {
        $user = null;
        if ($this->getUser()) {
            $user = $this->getUser();
        }
        
        $filters = [ 'city' => $request->request->get('city'),
                     'dated' => $request->request->get('dated'),
                     'datef' => $request->request->get('datef')
                    ];

                
        $endDate = new \DateTime ($filters['datef']);
        $startDate =  new \DateTime ($filters['dated']);

        $this->session->set('endDate', $endDate);
        $this->session->set('startDate', $startDate);
        $this->session->set('city', $filters['city']);

        $cars = $this->entityManager->getRepository(Car::class)->searchBy($filters);

        foreach($cars as $car) {
            if(count($car->getLocations()) == 0) {               
                $results [] = $car;
                continue;
            }

            foreach($car->getLocations() as $location){
                if($location->getdatedebut() > $endDate || $location->getdatefin() < $startDate){
                    $results [] = $car;
                }
            }
        }
        //$paginator= $this -> get('knp_paginator');
        $resultat=$this->paginator-> paginate(
            $results,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );
        return $this->render('recherche.html.twig', array( 'cars' => $resultat, 'user' => $user)); 
    }
     
 
    
     /**
     * @Route("/profil/{id}", name="home_profil")
     */
    public function profil(Request $request, $id)
    {
       
       $utilisateur=$this->getUser();

       $locationsInporegress = $this->getDoctrine()->getRepository(location::class)
       ->findByLocationInProgress($utilisateur);

       $locationsValid = $this->getDoctrine()->getRepository(location::class)
       ->findByLocationValid( $utilisateur);

       $locationsHistory = $this->getDoctrine()->getRepository(location::class)
       ->findByLocationHistory( $utilisateur);
       
       $locations = $this->getDoctrine()->getRepository(location::class)
       ->findBy( ['User'=>$utilisateur], ['id' => 'DESC' ] );
        
    return $this->render('profil.html.twig',[
        'user'=>$utilisateur,
        'locationsInProgress' => $locationsInporegress,
        'locationsValid' => $locationsValid,
        'locationsHistory' => $locationsHistory,
         'locations'=> $locations ,
        ]);
       
    }
    /**
     * @Route("/test", name="test_profil")
     */
    public function test()
    {
       
        
        
        
    return $this->render('test.html.twig');
       
    }
    
}
