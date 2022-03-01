<?php

namespace App\Controller\gestion;

use App\Data\SearchDataBnr;
use App\Entity\Affaire;
use App\Entity\InfoBnr;
use App\form\filters\BnrSearchForm;
use App\Repository\AffaireRepository;
use App\Repository\FebRepository;
use App\Repository\GrandsComptesRepository;
use App\Repository\InfoBnrRepository;
use App\Repository\NatureAffaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\PriorisationRepository;
use App\Repository\QuartiersRepository;
use App\Repository\SigleRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BNRController extends AbstractController {

    private ManagerRegistry $ManagerRegistry;
    private OrganismeRepository $organismeRepository;
    private QuartiersRepository $quartiersRepository;
    private AffaireRepository $affaireRepository;
    private SigleRepository $sigleRepository;
    private NatureAffaireRepository $natureAffaireRepository;
    private PriorisationRepository $priorisationRepository;
    private FebRepository $febRepository;
    private GrandsComptesRepository $grandsComptesRepository;
    private InfoBnrRepository $infoBnrRepository;

    public function __construct(ManagerRegistry $doctrine, OrganismeRepository $organismeRepository, QuartiersRepository $quartiersRepository, AffaireRepository $affaireRepository, SigleRepository $sigleRepository, NatureAffaireRepository $natureAffaireRepository, PriorisationRepository $priorisationRepository, FebRepository $febRepository, GrandsComptesRepository $grandsComptesRepository, InfoBnrRepository $infoBnrRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->organismeRepository = $organismeRepository;
        $this->quartiersRepository = $quartiersRepository;
        $this->affaireRepository = $affaireRepository;
        $this->sigleRepository = $sigleRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->febRepository = $febRepository;
        $this->grandsComptesRepository = $grandsComptesRepository;
        $this->infoBnrRepository = $infoBnrRepository;
    }


    /**
     * @Route ("/{role}/BNR", name="Bnr")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        $Data = new SearchDataBnr();
        $Data->page =$request->get('page', 1);
        $form = $this->createForm(BnrSearchForm::class, $Data);
        $form->handleRequest($request);

        $Bnrs = $this->infoBnrRepository->findBnrSearch($Data);

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
        return $this->render('gestion/bnr/Bnr.html.twig', [
            'Bnrs' => $Bnrs,
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'Febs' => $this->febRepository->findAll(),
            'GrandComptes' => $this->grandsComptesRepository->findAll(),
            'Quartiers' => $this->quartiersRepository->findAll(),
            'role' => $role[0],
            'title' => $this->sigleRepository->findOneBy([
                'intituleSigle' => 'besoinNouveauReseau'
            ]),
            'Prios' => $this->priorisationRepository->findAll(),
            'form' => $form->createView(),
            'sigles' => $sigles,
        ]);
    }


    /**
     * @Route ("/NewBnr", name="Admin_Bnr_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newBnr(Request $request) : Response{
        $nature = $this->natureAffaireRepository->findOneBy([
            'natureAffaire' => 'besoinNouveauReseau',
        ]);
        $NewBnr = new Affaire();
        $BnrName = $request->request->get('bnr');
        $montant = $request->request->get('montant');
        $idOrganismes = $request->request->all('organisme', []);
        $Organisme = [];
        foreach ($idOrganismes as $item){
            //array_push( $Organisme, $this->organismeRepository->find($item));
            $NewBnr->addIdOrganisme($this->organismeRepository->find($item));
        }
        $idPrio = $request->request->get('priority');
        $Prio = $this->priorisationRepository->find($idPrio);
        $Date = $request->request->get('date');
        $date = new DateTime($Date);
        $date->format('Y-m-d');
        $State = $request->request->get('state');
        $Comment = $request->request->get('comment');
        $idFeb = $request->request->get('feb');
        $idGrandsComptes = $request->request->get('grandCompte');
        $GrandCompte = $this->grandsComptesRepository->find($idGrandsComptes);
        $Feb = $this->febRepository->find($idFeb);
        $NewBnr->setIdNatureAffaire($nature);
        $NewBnr->setObjectifAffaire($BnrName);
        $NewBnr->setMontantAffaire($montant);
        $NewBnr->setIdPriorisation($Prio);
        $NewBnr->setEcheanceAffaire($date);
        $NewBnr->setEtatAffaire($State);
        $NewBnr->setCommentaire($Comment);
        $NewBnr->setIdFeb($Feb);
        $NewBnr->setIdGrandsComptes($GrandCompte);
        if ($this->isCsrfTokenValid("CreateBnr", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewBnr);
            $em->flush();
            $NewBnrInfos = new InfoBnr();
            $NewBnrInfos->setIdAffaire($NewBnr);
            $DateDemande = $request->request->get('dateDemande');
            $dateDemande = new DateTime($DateDemande);
            $dateDemande->format('Y-m-d');
            $NewBnrInfos->setDateDemande($dateDemande);
            $MontantInfo = $request->request->get('montantInfo');
            $NewBnrInfos->setMontantInfo($MontantInfo);
            $Impact = $request->request->get('impact');
            $NewBnrInfos->setImpact($Impact);
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewBnrInfos);
            $em->flush();
            $jsonData = array(
                'message' => 'BNR ajouté',
            );
        }
        else{
            $jsonData = array(
                'message' => "Erreur lors de l'ajout",
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
        $Bnrs = $this->affaireRepository->findAll();
        $nbBnr = count($Bnrs);
        $ChekedId = array();
        for ( $i = 0; $i < $nbBnr; $i++){
            if ($request->request->get('idChecked' . $Bnrs[$i]->getIdBnr())){
                $ChekedId[] = $Bnrs[$i]->getIdBnr();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $bnrToDelete = $this->affaireRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteBnr", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($bnrToDelete);
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
     * @Route ("/EditBnr/{id}", name="Admin_Bnr_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditBnr(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Bnr = $this->affaireRepository->find($id);
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
            'message' => 'BNR modifié',
        );

        return $this->json($jsonData, 200);
    }

}