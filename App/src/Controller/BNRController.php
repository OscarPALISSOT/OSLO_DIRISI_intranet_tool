<?php

namespace App\Controller;

use App\Entity\Bnr;
use App\Repository\BnrRepository;
use App\Repository\OrganismeRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BNRController extends AbstractController {

    private BnrRepository $bnrRepository;
    private ManagerRegistry $ManagerRegistry;
    private OrganismeRepository $organismeRepository;

    public function __construct(BnrRepository $bnrRepository, ManagerRegistry $doctrine, OrganismeRepository $organismeRepository)
    {
        $this->bnrRepository = $bnrRepository;
        $this->ManagerRegistry = $doctrine;
        $this->organismeRepository = $organismeRepository;
    }


    /**
     * @Route ("/{role}/BNR", name="Bnr")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $Bnrs = $paginator->paginate(
            $this->bnrRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        $Organismes = $this->organismeRepository->findAllWithQuartier();
        return $this->render('pages/Bnr.html.twig', [
            'Bnrs' => $Bnrs,
            'Organismes' => $Organismes,
        ]);
    }


    /**
     * @Route ("/NewBnr", name="Admin_Bnr_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newBnr(Request $request) : Response{
        $NewBnr = new Bnr();
        $Bnr = $request->request->get('bnr');
        $montant = $request->request->get('montant');
        $idOrganisme = $request->request->get('organisme');
        $Organisme = $this->organismeRepository->find($idOrganisme);
        $Prio = $request->request->get('priority');
        $Date = $request->request->get('date');
        $date = new DateTime($Date);
        $date->format('Y-m-d');
        $Sate = $request->request->get('state');
        $Comment = $request->request->get('comment');
        $NewBnr->setObjBnr($Bnr);
        $NewBnr->setMontantFeb($montant);
        $NewBnr->setIdOrganisme($Organisme);
        $NewBnr->setPrioBnr($Prio);
        $NewBnr->setEcheanceBnr($date);
        $NewBnr->setEtatBnr($Sate);
        $NewBnr->setCommentaireBnr($Comment);
        if (!$idOrganisme){
            $jsonData = array(
                'Bnr' => 'Veuillez entrer un organisme',
            );
        }
        else{
            if ($this->isCsrfTokenValid("CreateBnr", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewBnr);
                $em->flush();
            }
            $jsonData = array(
                'Bnr' => $Bnr,
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/DeleteBnr", name="Admin_Bnr_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteBnr(Request $request): Response{
        $Bnrs = $this->bnrRepository->findAll();
        $nbBnr = count($Bnrs);
        $ChekedId = array();
        for ( $i = 0; $i < $nbBnr; $i++){
            if ($request->request->get('idChecked' . $Bnrs[$i]->getIdBnr())){
                $ChekedId[] = $Bnrs[$i]->getIdBnr();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'Bnr' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $bnrToDelete = $this->bnrRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteBnr", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($bnrToDelete);
                    $em->flush();
                }

            }
            $jsonData = array(
                'Bnr' => "Suppression terminée",
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/EditBnr/{id}", name="Admin_Bnr_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditBnr(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Bnr = $this->bnrRepository->find($id);
        $BnrName = $request->request->get('bnrEdit');
        $montant = $request->request->get('montantEdit');
        $idOrganisme = $request->request->get('organismeEdit');
        $Organisme = $this->organismeRepository->find($idOrganisme);
        $Prio = $request->request->get('priorityEdit');
        $Date = $request->request->get('dateEdit');
        $date = new DateTime($Date);
        $date->format('Y-m-d');
        $Sate = $request->request->get('stateEdit');
        $Comment = $request->request->get('commentEdit');
        $Bnr->setObjBnr($BnrName);
        $Bnr->setMontantFeb($montant);
        $Bnr->setIdOrganisme($Organisme);
        $Bnr->setPrioBnr($Prio);
        $Bnr->setEcheanceBnr($date);
        $Bnr->setEtatBnr($Sate);
        $Bnr->setCommentaireBnr($Comment);

        if ($this->isCsrfTokenValid("EditBnr", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Bnr);
            $em->flush();
        }

        $jsonData = array(
            'Bnr' => $Bnr->getObjBnr(),
        );

        return $this->json($jsonData, 200);
    }

}