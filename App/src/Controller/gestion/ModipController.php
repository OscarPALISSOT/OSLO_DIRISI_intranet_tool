<?php

namespace App\Controller\gestion;

use App\Data\SearchDataModip;
use App\Entity\Affaire;
use App\Entity\InfoModip;
use App\form\filters\ModipSearchForm;
use App\Repository\AffaireRepository;
use App\Repository\FebRepository;
use App\Repository\GrandsComptesRepository;
use App\Repository\InfoModipRepository;
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

class ModipController extends AbstractController {

    private ManagerRegistry $ManagerRegistry;
    private OrganismeRepository $organismeRepository;
    private QuartiersRepository $quartiersRepository;
    private AffaireRepository $affaireRepository;
    private SigleRepository $sigleRepository;
    private NatureAffaireRepository $natureAffaireRepository;
    private PriorisationRepository $priorisationRepository;
    private FebRepository $febRepository;
    private GrandsComptesRepository $grandsComptesRepository;
    private InfoModipRepository $infoModipRepository;

    public function __construct(ManagerRegistry $doctrine, OrganismeRepository $organismeRepository, QuartiersRepository $quartiersRepository, AffaireRepository $affaireRepository, SigleRepository $sigleRepository, NatureAffaireRepository $natureAffaireRepository, PriorisationRepository $priorisationRepository, FebRepository $febRepository, GrandsComptesRepository $grandsComptesRepository, InfoModipRepository $infoModipRepository)
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
        $this->infoModipRepository = $infoModipRepository;
    }


    /**
     * @Route ("/{role}/MODIP", name="Modip")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        $Data = new SearchDataModip();
        $Data->page =$request->get('page', 1);
        $form = $this->createForm(ModipSearchForm::class, $Data);
        $form->handleRequest($request);

        $Modips = $this->infoModipRepository->findModipSearch($Data);

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
        return $this->render('gestion/modip/Modip.html.twig', [
            'Modips' => $Modips,
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'Febs' => $this->febRepository->findAll(),
            'GrandComptes' => $this->grandsComptesRepository->findAll(),
            'Quartiers' => $this->quartiersRepository->findAll(),
            'role' => $role[0],
            'title' => $this->sigleRepository->findOneBy([
                'intituleSigle' => 'modifLan'
            ]),
            'Prios' => $this->priorisationRepository->findAll(),
            'form' => $form->createView(),
            'sigles' => $sigles,
        ]);
    }


    /**
     * @Route ("/NewModip", name="Admin_Modip_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newModip(Request $request) : Response{
        $nature = $this->natureAffaireRepository->findOneBy([
            'natureAffaire' => 'besoinNouveauReseau',
        ]);
        $NewModip = new Affaire();
        $ModipName = $request->request->get('modip');
        $Objectif = $request->request->get('objectif');
        $montant = $request->request->get('montant');
        $idOrganismes = $request->request->all('organisme', []);
        foreach ($idOrganismes as $item){
            $NewModip->addIdOrganisme($this->organismeRepository->find($item));
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
        $NewModip->setIdNatureAffaire($nature);
        $NewModip->setNomAffaire($ModipName);
        $NewModip->setObjectifAffaire($Objectif);
        $NewModip->setMontantAffaire($montant);
        $NewModip->setIdPriorisation($Prio);
        $NewModip->setEcheanceAffaire($date);
        $NewModip->setEtatAffaire($State);
        $NewModip->setCommentaire($Comment);
        $NewModip->setIdFeb($Feb);
        $NewModip->setIdGrandsComptes($GrandCompte);
        if ($this->isCsrfTokenValid("CreateModip", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewModip);
            $em->flush();
            $NewModipInfos = new InfoModip();
            $NewModipInfos->setIdAffaire($NewModip);
            $DateDemande = $request->request->get('dateDemande');
            $dateDemande = new DateTime($DateDemande);
            $dateDemande->format('Y-m-d');
            $NewModipInfos->setDateDemande($dateDemande);
            $MontantInfo = $request->request->get('montantInfo');
            $NewModipInfos->setMontantInfo($MontantInfo);
            $Impact = $request->request->get('impact');
            $NewModipInfos->setImpact($Impact);
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewModipInfos);
            $em->flush();
            $jsonData = array(
                'message' => 'MODIP ajouté',
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
     * @Route ("/DeleteModip", name="Admin_Modip_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteModip(Request $request): Response{
        $Modips = $this->infoModipRepository->findAll();
        $nbModip = count($Modips);
        $ChekedId = array();
        for ( $i = 0; $i < $nbModip; $i++){
            if ($request->request->get('idChecked' . $Modips[$i]->getIdInfoModip())){
                $ChekedId[] = $Modips[$i]->getIdInfoModip();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $modipToDelete = $this->infoModipRepository->find($item);
                $affaireToDelete = $this->affaireRepository->find($modipToDelete->getIdAffaire());

                if ($this->isCsrfTokenValid("DeleteModip", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($modipToDelete);
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
     * @Route ("/EditModip/{id}", name="Admin_Modip_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditModip(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Modip = $this->affaireRepository->find($id);
        $ModipName = $request->request->get('modipEdit');
        $Objectif = $request->request->get('objectifEdit');
        $montant = $request->request->get('montantEdit');
        $idOrganismes = $request->request->all('organismeEdit', []);
        foreach ($idOrganismes as $item){
            $Modip->addIdOrganisme($this->organismeRepository->find($item));
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
        $Modip->setNomAffaire($ModipName);
        $Modip->setObjectifAffaire($Objectif);
        $Modip->setMontantAffaire($montant);
        $Modip->setEtatAffaire($State);
        $Modip->setIdGrandsComptes($GrandCompte);
        $Modip->setIdPriorisation($Prio);
        $Modip->setEcheanceAffaire($date);
        $Modip->setCommentaire($Comment);
        $Modip->setIdFeb($Feb);
        $update = new DateTime();
        $update->format('Y-m-d-H:i:s');
        $Modip->setUpdateAt($update);
        if ($this->isCsrfTokenValid("EditModip", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Modip);
            $em->flush();
            $ModipInfos = $this->infoModipRepository->find($Modip->getIdAffaire());
            $DateDemande = $request->request->get('dateDemandeEdit');
            $dateDemande = new DateTime($DateDemande);
            $dateDemande->format('Y-m-d');
            $ModipInfos->setDateDemande($dateDemande);
            $MontantInfo = $request->request->get('montantInfoEdit');
            $ModipInfos->setMontantInfo($MontantInfo);
            $Impact = $request->request->get('impactEdit');
            $ModipInfos->setImpact($Impact);
            $em = $this->ManagerRegistry->getManager();
            $em->persist($ModipInfos);
            $em->flush();
            $jsonData = array(
                'message' => 'MODIP modifié',
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