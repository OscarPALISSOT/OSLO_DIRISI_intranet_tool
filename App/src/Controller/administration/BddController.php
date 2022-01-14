<?php

namespace App\Controller\administration;

use App\Entity\BasesDeDefense;
use App\Form\BddFormType;
use App\Repository\BasesDeDefenseRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BddController extends AbstractController {
    
    private BasesDeDefenseRepository $BasesDeDefenseRepository;

    public function __construct(BasesDeDefenseRepository $basesDeDefense)
    {
        $this->BasesDeDefenseRepository = $basesDeDefense;
    }

    /**
     * @Route ("/Admin/BasesDeDefense", name="Admin_Bdd")
     * @return Response
     */
    public function index() : Response{

        return $this->render('administration/bdd/bdd.html.twig', [
            'Bdds'=>$this->BasesDeDefenseRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Admin/BasesDeDefense/{id}", name="Admin_Bdd_edit")
     * @param Request $request
     * @param BasesDeDefense $basesDeDefense
     * @return Response
     */
    public function editBdd(Request $request, BasesDeDefense $basesDeDefense, ManagerRegistry $doctrine) : Response{
        $form = $this->createForm(BddFormType::class, $basesDeDefense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('Admin_Bdd');
        }

        return $this->render('administration/bdd/bddEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}