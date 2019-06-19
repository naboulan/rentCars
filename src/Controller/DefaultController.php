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

use Doctrine\ORM\EntityManagerInterface;
/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    
     /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $cars = $this->entityManager->getRepository(Car::class)->findlate();
        return $this->render('home.html.twig', array( 'cars' => $cars));

    }

    /**
     * @Route("/deconnection", name="home_logout")
     */
    public function logout()
    {
        
    }
   

    /**
     * @Route("/base", name="home_base")
     */
    public function base()
    
    {
        
        return $this->render('base.html.twig'); 
    }
     
 
    
     /**
     * @Route("/search", name="search", methods={"POST"})
     */
    public function search(Request $request)
    {
        $filters = [ 'city' => $request->request->get('city'),
                     'dated' => $request->request->get('dated'),
                     'datef' => $request->request->get('datef')
                    ];

                
        $endDate = new \DateTime ($filters['datef']);
        $startDate =  new \DateTime ($filters['dated']);

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
        return $this->render('recherche.html.twig', array( 'cars' => $results)); 
    }
     
 
    
     /**
     * @Route("/profil", name="home_profil")
     */
    public function profil()
    {
       return $this->render('profil.html.twig');
    }
    
}
