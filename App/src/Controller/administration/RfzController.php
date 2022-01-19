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
     * @Route ("/Admin/DeleteRouteursFederateursDeZone", name="Admin_Rfz_Delete")
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @param RfzRepository $rfzRepository
     * @return Response
     */
    public function DeleteRfz(Request $request, ManagerRegistry $doctrine, RfzRepository $rfzRepository): Response{
        $Rfzs = $rfzRepository->findAll();
        $nbRfz = count($Rfzs);
        $ChekedId = array();
        for ( $i = 0; $i < $nbRfz; $i++){
            if ($request->request->get('idChecked' . $Rfzs[$i]->getIdRfz())){
                $ChekedId[] = $Rfzs[$i]->getIdRfz();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'Rfz' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $rfzToDelete = $rfzRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteRfz", $request->get('_token'))){
                    $em = $doctrine->getManager();
                    $em->remove($rfzToDelete);
                    $em->flush();
                }

            }
            $jsonData = array(
                'Rfz' => "Suppression terminée",
            );
        }

        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/EditRouteursFederateursDeZone/{id}", name="Admin_Rfz_Edit")
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @param RfzRepository $rfzRepository
     * @return Response
     */
    public function CheckedRfz(Request $request, ManagerRegistry $doctrine, RfzRepository $rfzRepository) : Response{

        if ($this->isCsrfTokenValid("Rfz", $request->get('_token'))){
            if ($request->request->get('action') == 'edit'){
                if (count($ChekedId) == 1){
                    $Rfz = $rfzRepository->find($ChekedId[0]);
                    $RfzName = $request->request->get('rfzEdit');
                    $Rfz->setRfz($RfzName);

                    $em = $doctrine->getManager();
                    $em->persist($Rfz);
                    //$em->flush();

                    $jsonData = array(
                        'Rfz' => $Rfz->getRfz(),
                    );
                }
                else{
                    $jsonData = array(
                        'Rfz' => "Vous ne pouvez modifiez qu'un seul routeur à la fois",
                    );
                }
            }
        }

        return $this->json($jsonData, 200);
    }
}