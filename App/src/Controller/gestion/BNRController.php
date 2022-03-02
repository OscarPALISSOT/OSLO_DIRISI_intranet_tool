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
        $Objectif = $request->request->get('objectif');
        $montant = $request->request->get('montant');
        $idOrganismes = $request->request->all('organisme', []);
        foreach ($idOrganismes as $item){
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
        $NewBnr->setNomAffaire($BnrName);
        $NewBnr->setObjectifAffaire($Objectif);
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
        $Bnrs = $this->infoBnrRepository->findAll();
        $nbBnr = count($Bnrs);
        $ChekedId = array();
        for ( $i = 0; $i < $nbBnr; $i++){
            if ($request->request->get('idChecked' . $Bnrs[$i]->getIdInfoBnr())){
                $ChekedId[] = $Bnrs[$i]->getIdInfoBnr();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $bnrToDelete = $this->infoBnrRepository->find($item);
                $affaireToDelete = $this->affaireRepository->find($bnrToDelete->getIdAffaire());

                if ($this->isCsrfTokenValid("DeleteBnr", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($bnrToDelete);
                    $em->flush();
                    $em->remove($affaireToDelete);
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
        $Bnr->setIdNatureAffaire(
            $this->natureAffaireRepository->findOneBy([
                'natureAffaire' => 'besoinNouveauReseau',
            ])
        );
        $BnrName = $request->request->get('bnrEdit');
        $Objectif = $request->request->get('objectifEdit');
        $montant = $request->request->get('montantEdit');
        $idOrganismes = $request->request->all('organismeEdit', []);
        foreach ($idOrganismes as $item){
            $Bnr->addIdOrganisme($this->organismeRepository->find($item));
        }
        $idPrio = $request->request->get('priorityEdit');
        $Prio = $this->priorisationRepository->find($idPrio);
        $Date = $request->request->get('dateEdit');
        $date = new DateTime($Date);
        $date->format('Y-m-d');
        $State = $request->request->get('stateEdit');
        $Comment = $request->request->get('commentEdit');
        $idFeb = $request->request->get('febEdit');
        $idGrandsComptes = $request->request->get('grandCompteEdit');
        $GrandCompte = $this->grandsComptesRepository->find($idGrandsComptes);
        $Feb = $this->febRepository->find($idFeb);
        $Bnr->setNomAffaire($BnrName);
        $Bnr->setObjectifAffaire($Objectif);
        $Bnr->setMontantAffaire($montant);
        $Bnr->setEtatAffaire($State);
        $Bnr->setIdGrandsComptes($GrandCompte);
        $Bnr->setIdPriorisation($Prio);
        $Bnr->setEcheanceAffaire($date);
        $Bnr->setCommentaire($Comment);
        $Bnr->setIdFeb($Feb);
        $update = new DateTime();
        $update->format('Y-m-d-H:i:s');
        $Bnr->setUpdateAt($update);
        if ($this->isCsrfTokenValid("EditBnr", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Bnr);
            $em->flush();
            $BnrInfos = $this->infoBnrRepository->findOneBy([
                'idInfoBnr' => $Bnr->getIdAffaire(),
            ]);
            $DateDemande = $request->request->get('dateDemandeEdit');
            $dateDemande = new DateTime($DateDemande);
            $dateDemande->format('Y-m-d');
            $BnrInfos->setDateDemande($dateDemande);
            $MontantInfo = $request->request->get('montantInfoEdit');
            $BnrInfos->setMontantInfo($MontantInfo);
            $Impact = $request->request->get('impactEdit');
            $BnrInfos->setImpact($Impact);
            $em = $this->ManagerRegistry->getManager();
            $em->persist($BnrInfos);
            $em->flush();
            $jsonData = array(
                'message' => 'BNR modifié',
            );
        }
        else{
            $jsonData = array(
                'message' => "Erreur lors de la modification",
            );
        }

        return $this->json($jsonData, 200);
    }

}