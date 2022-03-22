<?php

namespace App\Controller\gestion;

use App\Data\SearchDataFeb;
use App\Entity\Feb;
use App\form\filters\FebSearchForm;
use App\Repository\FebRepository;
use App\Repository\OrganismeRepository;
use App\Repository\PlanDeChargeRepository;
use App\Repository\SigleRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FebController extends AbstractController {

    private $ManagerRegistry;
    private $sigleRepository;
    private $febRepository;
    private $planDeChargeRepository;
    private $organismeRepository;

    public function __construct(ManagerRegistry $doctrine, SigleRepository $sigleRepository, FebRepository $febRepository, PlanDeChargeRepository $planDeChargeRepository, OrganismeRepository $organismeRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->sigleRepository = $sigleRepository;
        $this->febRepository = $febRepository;
        $this->planDeChargeRepository = $planDeChargeRepository;
        $this->organismeRepository = $organismeRepository;
    }


    /**
     * @Route ("/{role}/Feb", name="Feb")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        $Data = new SearchDataFeb();
        $Data->page =$request->get('page', 1);
        $form = $this->createForm(FebSearchForm::class, $Data);
        $form->handleRequest($request);

        $Febs = $this->febRepository->findFebSearch($Data);

        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        $sigles = $this->sigleRepository->findSigles();
        $Pdcs = $this->planDeChargeRepository->findAll();
        if ($request->get('Ajax')){
            return new JsonResponse([
                'content' => $this->renderView('gestion/feb/_content.html.twig', [
                    'Febs' => $Febs,
                    'Pdcs' => $Pdcs,
                    'Organismes' => $this->organismeRepository->findAllWithQuartier(),
                ]),
                'sorting' => $this->renderView('gestion/feb/_sorting.html.twig', [
                    'Febs' => $Febs,
                ]),
                'pagination' => $this->renderView('gestion/feb/_pagination.html.twig', [
                    'Febs' => $Febs,
                ]),
                'secondModal' => $this->renderView('gestion/_secondModal.html.twig'),
            ]);
        }
        return $this->render('gestion/feb/feb.html.twig', [
            'Febs' => $Febs,
            'Pdcs' => $Pdcs,
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'role' => $role[0],
            'title' => "Fiche d'expression de besoin",
            'form' => $form->createView(),
            'sigles' => $sigles,
        ]);
    }


    /**
     * @Route ("/NewFeb", name="Admin_Feb_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newFeb(Request $request) : Response{
        $NewFeb = new Feb();
        $FebName = $request->request->get('feb');
        $intitule = $request->request->get('intitule');
        $montant = $request->request->get('montant');
        $montant = number_format($montant,2,'.','');
        $idPdc = $request->request->get('Pdc');
        $Pdc = $this->planDeChargeRepository->find($idPdc);
        $idOrganismes = $request->request->all('organisme', []);
        foreach ($idOrganismes as $item){
            $NewFeb->addIdOrganisme($this->organismeRepository->find($item));
        }
        $NewFeb->setIntituleFeb($intitule);
        $NewFeb->setNumFeb($FebName);
        $NewFeb->setMontantFeb($montant);
        $NewFeb->setIdPdc($Pdc);
        if (!$idPdc){
            $jsonData = array(
                'message' => 'Veuillez entrer un plan de charge',
            );
        }
        else{
            if ($this->isCsrfTokenValid("CreateFeb", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewFeb);
                $em->flush();
            }
            $jsonData = array(
                'message' => "Fiche d'expression de besoin ajoutée",
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/DeleteFeb", name="Admin_Feb_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteFeb(Request $request): Response{
        $Febs = $this->febRepository->findAll();
        $nbFeb = count($Febs);
        $ChekedId = array();
        for ( $i = 0; $i < $nbFeb; $i++){
            if ($request->request->get('idChecked' . $Febs[$i]->getIdFeb())){
                $ChekedId[] = $Febs[$i]->getIdFeb();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $febToDelete = $this->febRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteFeb", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($febToDelete);
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
     * @Route ("/EditFeb/{id}", name="Admin_Feb_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditFeb(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Feb = $this->febRepository->find($id);
        $FebName = $request->request->get('febEdit');
        $intitule = $request->request->get('intituleEdit');
        $montant = $request->request->get('montantEdit');
        $montant = number_format($montant,2,'.','');
        $idPdc = $request->request->get('PdcEdit');
        $Pdc = $this->planDeChargeRepository->find($idPdc);
        $idOrganismes = $request->request->all('organismeEdit', []);
        foreach ($idOrganismes as $item){
            $Feb->addIdOrganisme($this->organismeRepository->find($item));
        }
        $Feb->setIntituleFeb($intitule);
        $Feb->setNumFeb($FebName);
        $Feb->setMontantFeb($montant);
        $Feb->setIdPdc($Pdc);
        $update = new DateTime();
        $update->format('Y-m-d\H:i:s');
        $Feb->setUpdateAt($update);

        if ($this->isCsrfTokenValid("EditFeb", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Feb);
            $em->flush();
        }

        $jsonData = array(
            'message' => "Fiche d'expression de besion modifiée",
        );

        return $this->json($jsonData, 200);
    }

}
