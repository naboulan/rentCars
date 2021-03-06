<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commentaire;
use App\Form\CommentType;
/**
 * @Route("/car")
 */
class CarController extends AbstractController
{
    
    
    /**
     * @Route("/", name="car_index", methods={"GET"})
     */
    public function index(CarRepository $carRepository): Response
    {
        $user = null;
        if ($this->getUser()) {
            $user = $this->getUser();
        }
        return $this->render('car/index.html.twig', [
            'cars' => $carRepository->findAll(),'user'=>$user
        ]);
        

    }

    /**
     * @Route("/new", name="car_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    { 
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = null;
        if ($this->getUser()) {
            $user = $this->getUser();
        }
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $car->setUser($this->getUser()); 
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form->createView(),'user'=>$user,
        ]);
    }
    
    /**
     * @Route("/{id}", name="car_show", methods={"GET"})
     */
    public function show(Car $car): Response
    {
        return $this->render('car/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="car_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Car $car): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_index', [
                'id' => $car->getId(),
            ]);
        }

        return $this->render('car/edit.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }
    

    /**
     * @Route("/{id}", name="car_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Car $car): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('car_index');
    }

    /**
     * @Route("/detail/{id}", name="car_detail", methods={"GET","POST"})
     */
    public function detail(Request $request, $id):Response
    {
       $car = $this->getDoctrine()->getRepository(Car::class)->find($id);

        $user = null;
        if ($this->getUser()) {
            $user = $this->getUser();
        }
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentType::class,$commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commentaire->setCar($car); 
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('car_detail', [
                'id' => $car->getId(),
            ]);
        }
        return $this->render('car/detail.html.twig',[
            'car'=> $car, 'user' => $user,'comment'=>$form->createView()
            
        ]);
    }

  
    

}