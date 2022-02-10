<?php

namespace App\Controller\administration;

use App\Entity\Rfz;
use App\Repository\RfzRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RfzController extends AbstractController {

    private RfzRepository $RfzRepository;
    private ManagerRegistry $ManagerRegistry;

    public function __construct(RfzRepository $RfzRepository, ManagerRegistry $doctrine)
    {
        $this->RfzRepository = $RfzRepository;
        $this->ManagerRegistry = $doctrine;
    }

    /**
     * @Route ("/Admin/RouteursFederateursDeZone", name="Admin_Rfz")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $Rfzs = $paginator->paginate(
            $this->RfzRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/rfz.html.twig', [
            'Rfzs' => $Rfzs,
        ]);
    }

    /**
     * @Route ("/Admin/NewRouteursFederateursDeZone", name="Admin_Rfz_New")
     * @param Request $request
     * @return Response
     */
    public function newRfz(Request $request) : Response{
        $NewRfz = new Rfz();
        $Rfz = $request->request->get('rfz');
        $NewRfz->setRfz($Rfz);
        if ($this->isCsrfTokenValid("CreateRfz", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
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
     * @return Response
     */
    public function DeleteRfz(Request $request): Response{
        $Rfzs = $this->RfzRepository->findAll();
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
                $rfzToDelete = $this->RfzRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteRfz", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
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
     * @return Response
     */
    public function EditRfz(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Rfz = $this->RfzRepository->find($id);
        $RfzName = $request->request->get('rfzEdit');
        $Rfz->setRfz($RfzName);

        if ($this->isCsrfTokenValid("EditRfz", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Rfz);
            $em->flush();
        }

        $jsonData = array(
            'Rfz' => $Rfz->getRfz(),
        );

        return $this->json($jsonData, 200);
    }
}