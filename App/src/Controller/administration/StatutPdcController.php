<?php

namespace App\Controller\administration;

use App\Entity\StatutPdc;
use App\Repository\StatutPdcRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatutPdcController extends AbstractController {

    private $StatutPdcRepository;
    private $ManagerRegistry;

    public function __construct(StatutPdcRepository $StatutPdcRepository, ManagerRegistry $doctrine)
    {
        $this->StatutPdcRepository = $StatutPdcRepository;
        $this->ManagerRegistry = $doctrine;
    }

    /**
     * @Route ("/Admin/StatutPdc", name="Admin_StatutPdc")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $StatutPdcs = $paginator->paginate(
            $this->StatutPdcRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/statutPdc.html.twig', [
            'StatutPdcs' => $StatutPdcs,
        ]);
    }

    /**
     * @Route ("/Admin/NewStatutPdc", name="Admin_StatutPdc_New")
     * @param Request $request
     * @return Response
     */
    public function newStatutPdc(Request $request) : Response{
        $NewStatutPdc = new StatutPdc();
        $StatutPdc = $request->request->get('statutPdc');
        $NewStatutPdc->setStatutPdc($StatutPdc);
        if ($this->isCsrfTokenValid("CreateStatutPdc", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewStatutPdc);
            $em->flush();
        }
        $jsonData = array(
            'message' => 'Statut ajouté',
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteStatutPdc", name="Admin_StatutPdc_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteStatutPdc(Request $request): Response{
        $StatutPdcs = $this->StatutPdcRepository->findAll();
        $nbStatutPdc = count($StatutPdcs);
        $ChekedId = array();
        for ( $i = 0; $i < $nbStatutPdc; $i++){
            if ($request->request->get('idChecked' . $StatutPdcs[$i]->getIdStatutPdc())){
                $ChekedId[] = $StatutPdcs[$i]->getIdStatutPdc();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $statutPdcToDelete = $this->StatutPdcRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteStatutPdc", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($statutPdcToDelete);
                    $em->flush();
                }

            }
            $jsonData = array(
                'message' => "Suppression terminée",
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/EditStatutPdc/{id}", name="Admin_StatutPdc_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditStatutPdc(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $StatutPdc = $this->StatutPdcRepository->find($id);
        $StatutPdcName = $request->request->get('statutPdcEdit');
        $StatutPdc->setStatutPdc($StatutPdcName);

        if ($this->isCsrfTokenValid("EditStatutPdc", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($StatutPdc);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Statut modifié',
        );

        return $this->json($jsonData, 200);
    }
}