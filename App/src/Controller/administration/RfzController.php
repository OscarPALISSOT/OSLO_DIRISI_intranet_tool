<?php

namespace App\Controller\administration;

use App\Entity\Rfz;
use App\Form\RfzFormType;
use App\Repository\RfzRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RfzController extends AbstractController {

    private RfzRepository $RfzRepository;

    public function __construct(RfzRepository $Rfz)
    {
        $this->RfzRepository = $Rfz;
    }

    /**
     * @Route ("/Admin/RouteursFederateursDeZone", name="Admin_Rfz")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/rfz/rfz.html.twig', [
            'Rfzs'=>$this->RfzRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Admin/RouteursFederateursDeZone/{id}", name="Admin_Rfz_edit")
     * @param Request $request
     * @param Rfz $Rfz
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function editrfz(Request $request, Rfz $Rfz, ManagerRegistry $doctrine) : Response{
        $form = $this->createForm(RfzFormType::class, $Rfz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('Admin_Rfz');
        }

        return $this->render('administration/rfz/rfzEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}