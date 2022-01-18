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
     * @Route ("/Admin/NewRouteursFederateursDeZone", name="Admin_Rfz_New")
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function newRfz(Request $request, ManagerRegistry $doctrine) : Response{
        $NewRfz = new Rfz();
        $Rfz = $request->request->get('rfz');
        $NewRfz->setRfz($Rfz);
        if ($this->isCsrfTokenValid("createRfz", $request->get('_token'))){
            $em = $doctrine->getManager();
            $em->persist($NewRfz);
            $em->flush();
        }
        $jsonData = array(
            'Rfz' => $Rfz,
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/RouteursFederateursDeZone/{id}", name="Admin_Rfz_Edit")
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @param RfzRepository $rfzRepository
     * @param $id
     * @return Response
     */
    public function editRfz(Request $request, ManagerRegistry $doctrine, RfzRepository $rfzRepository, $id) : Response{
        $Rfz = $rfzRepository->find($id);
        $RfzName = $request->request->get('rfzEdit');
        $Rfz->setRfz($RfzName);

        if ($this->isCsrfTokenValid("editRfz", $request->get('_token'))){
            $em = $doctrine->getManager();
            $em->persist($Rfz);
            $em->flush();
        }

        $jsonData = array(
            'Rfz' => $Rfz->getRfz(),
        );
        return $this->json($jsonData, 200);
    }
}