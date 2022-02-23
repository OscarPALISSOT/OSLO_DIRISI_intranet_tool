<?php

namespace App\Controller\gestion;

use App\Data\SearchDataPdc;
use App\Entity\Affaire;
use App\Entity\PlanDeCharge;
use App\form\filters\PdcSearchForm;
use App\Repository\PlanDeChargeRepository;
use App\Repository\SigleRepository;
use App\Repository\StatutPdcRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdcController extends AbstractController {

    private ManagerRegistry $ManagerRegistry;
    private SigleRepository $sigleRepository;
    private StatutPdcRepository $statutPdcRepository;
    private PlanDeChargeRepository $planDeChargeRepository;

    public function __construct(ManagerRegistry $doctrine, SigleRepository $sigleRepository, StatutPdcRepository $statutPdcRepository, PlanDeChargeRepository $planDeChargeRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->sigleRepository = $sigleRepository;
        $this->statutPdcRepository = $statutPdcRepository;
        $this->planDeChargeRepository = $planDeChargeRepository;
    }


    /**
     * @Route ("/{role}/PDC", name="Pdc")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        //$Data = new SearchDataPdc();
        //$Data->page =$request->get('page', 12);
        //$form = $this->createForm(PdcSearchForm::class, $Data);
        //$form->handleRequest($request);

        $Pdcs = $this->planDeChargeRepository->findAll();

        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        $sigles = $this->sigleRepository->findSigles();
        /*if ($request->isXmlHttpRequest()){
            return new JsonResponse([
                'content' => $this->renderView('')
            ])
        }*/

        return $this->render('gestion/pdc/Pdc.html.twig', [
            'Pdcs' => $Pdcs,
            'Statuts' => $this->statutPdcRepository->findAll(),
            'role' => $role[0],
            'title' => 'Plan de charge',
            //'form' => $form->createView(),
            'sigles' => $sigles,
        ]);
    }


    /**
     * @Route ("/NewPdc", name="Admin_Pdc_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newPdc(Request $request) : Response{
        $NewPdc = new PlanDeCharge();
        $PdcName = $request->request->get('pdc');
        $montant = $request->request->get('montant');
        $idStatut = $request->request->get('statut');
        $statut = $this->statutPdcRepository->find($idStatut);
        $NewPdc->setNumPdc($PdcName);
        $NewPdc->setMontantPdc($montant);
        $NewPdc->setIdStatutPdc($statut);
        if (!$idStatut){
            $jsonData = array(
                'message' => 'Veuillez entrer un statut',
            );
        }
        else{
            if ($this->isCsrfTokenValid("CreatePdc", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewPdc);
                $em->flush();
            }
            $jsonData = array(
                'message' => 'Ligne de plan de charge ajoutée',
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/DeletePdc", name="Admin_Pdc_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeletePdc(Request $request): Response{
        $Pdcs = $this->planDeChargeRepository->findAll();
        $nbPdc = count($Pdcs);
        $ChekedId = array();
        for ( $i = 0; $i < $nbPdc; $i++){
            if ($request->request->get('idChecked' . $Pdcs[$i]->getIdPdc())){
                $ChekedId[] = $Pdcs[$i]->getIdPdc();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $pdcToDelete = $this->planDeChargeRepository->find($item);

                if ($this->isCsrfTokenValid("DeletePdc", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($pdcToDelete);
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
     * @Route ("/EditPdc/{id}", name="Admin_Pdc_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditPdc(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Pdc = $this->planDeChargeRepository->find($id);
        $PdcName = $request->request->get('pdcEdit');
        $montant = $request->request->get('montantEdit');
        $idStatut = $request->request->get('statutEdit');
        $statut = $this->statutPdcRepository->find($idStatut);
        $Pdc->setNumPdc($PdcName);
        $Pdc->setMontantPdc($montant);
        $Pdc->setIdStatutPdc($statut);

        if ($this->isCsrfTokenValid("EditPdc", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Pdc);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Ligne de plan de charge modifiée',
        );

        return $this->json($jsonData, 200);
    }

}