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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends AbstractController
{
    
     /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    private $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
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
     * @Route("/base/{id}", name="home_base")
     */
    public function base(Request $request, $id)
    
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        return $this->render('base.html.twig',['user'=>$user]);
    }
     
 
    
     /**
     * @Route("/search", name="search", methods={"POST"})
     */
    public function search(Request $request)
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
        return $this->render('recherche.html.twig', array( 'cars' => $results, 'user' => $user)); 
    }
     
 
    
     /**
     * @Route("/profil/{id}", name="home_profil")
     */
    public function profil(Request $request, $id)
    {
        
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
    return $this->render('profil.html.twig',['user'=>$user,]);
       
    }
    
}
