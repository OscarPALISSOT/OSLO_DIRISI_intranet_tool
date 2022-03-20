<?php

namespace App\Controller\administration;

use App\Entity\EtatPdc;
use App\Repository\EtatPdcRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtatPdcController extends AbstractController {

    private EtatPdcRepository $EtatPdcRepository;
    private ManagerRegistry $ManagerRegistry;

    public function __construct(EtatPdcRepository $EtatPdcRepository, ManagerRegistry $doctrine)
    {
        $this->EtatPdcRepository = $EtatPdcRepository;
        $this->ManagerRegistry = $doctrine;
    }

    /**
     * @Route ("/Admin/EtatPdc", name="Admin_EtatPdc")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $EtatPdcs = $paginator->paginate(
            $this->EtatPdcRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/etatPdc.html.twig', [
            'EtatPdcs' => $EtatPdcs,
        ]);
    }

    /**
     * @Route ("/Admin/NewEtatPdc", name="Admin_EtatPdc_New")
     * @param Request $request
     * @return Response
     */
    public function newEtatPdc(Request $request) : Response{
        $NewEtatPdc = new EtatPdc();
        $EtatPdc = $request->request->get('etatPdc');
        $NewEtatPdc->setEtatPdc($EtatPdc);
        if ($this->isCsrfTokenValid("CreateEtatPdc", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewEtatPdc);
            $em->flush();
        }
        $jsonData = array(
            'message' => 'État ajouté',
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteEtatPdc", name="Admin_EtatPdc_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteEtatPdc(Request $request): Response{
        $EtatPdcs = $this->EtatPdcRepository->findAll();
        $nbEtatPdc = count($EtatPdcs);
        $ChekedId = array();
        for ( $i = 0; $i < $nbEtatPdc; $i++){
            if ($request->request->get('idChecked' . $EtatPdcs[$i]->getIdEtatPdc())){
                $ChekedId[] = $EtatPdcs[$i]->getIdEtatPdc();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $etatPdcToDelete = $this->EtatPdcRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteEtatPdc", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($etatPdcToDelete);
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
     * @Route ("/Admin/EditEtatPdc/{id}", name="Admin_EtatPdc_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditEtatPdc(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $EtatPdc = $this->EtatPdcRepository->find($id);
        $EtatPdcName = $request->request->get('etatPdcEdit');
        $EtatPdc->setEtatPdc($EtatPdcName);

        if ($this->isCsrfTokenValid("EditEtatPdc", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($EtatPdc);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'État modifié',
        );

        return $this->json($jsonData, 200);
    }
}
