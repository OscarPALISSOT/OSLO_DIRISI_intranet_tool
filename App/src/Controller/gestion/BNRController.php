<?php

namespace App\Controller\gestion;

use App\Data\SearchDataBnr;
use App\Entity\Affaire;
use App\Entity\Feb;
use App\Entity\InfoBnr;
use App\Entity\PlanDeCharge;
use App\form\filters\BnrSearchForm;
use App\Repository\AffaireRepository;
use App\Repository\FebRepository;
use App\Repository\GrandsComptesRepository;
use App\Repository\InfoBnrRepository;
use App\Repository\NatureAffaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\PlanDeChargeRepository;
use App\Repository\PriorisationRepository;
use App\Repository\QuartiersRepository;
use App\Repository\SigleRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use League\Csv\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BNRController extends AbstractController {

    private $ManagerRegistry;
    private $organismeRepository;
    private $quartiersRepository;
    private $affaireRepository;
    private $sigleRepository;
    private $natureAffaireRepository;
    private $priorisationRepository;
    private $febRepository;
    private $infoBnrRepository;
    private $planDeChargeRepository;

    public function __construct(ManagerRegistry $doctrine, OrganismeRepository $organismeRepository, QuartiersRepository $quartiersRepository, AffaireRepository $affaireRepository, SigleRepository $sigleRepository, NatureAffaireRepository $natureAffaireRepository, PriorisationRepository $priorisationRepository, FebRepository $febRepository, InfoBnrRepository $infoBnrRepository, PlanDeChargeRepository $planDeChargeRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->organismeRepository = $organismeRepository;
        $this->quartiersRepository = $quartiersRepository;
        $this->affaireRepository = $affaireRepository;
        $this->sigleRepository = $sigleRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->febRepository = $febRepository;
        $this->infoBnrRepository = $infoBnrRepository;
        $this->planDeChargeRepository = $planDeChargeRepository;
    }


    /**
     * @Route ("/{role}/BNR", name="Bnr")
     * @param Paginator $paginator
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {

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
        if ($request->get('Ajax')){
            return new JsonResponse([
                'content' => $this->renderView('gestion/bnr/_content.html.twig', [
                    'Bnrs' => $Bnrs,
                    'Febs' => $this->febRepository->findAll(),
                    'Organismes' => $this->organismeRepository->findAllWithQuartier(),
                    'Quartiers' => $this->quartiersRepository->findAll(),
                    'Prios' => $this->priorisationRepository->findAll(),
                ]),
                'sorting' => $this->renderView('gestion/bnr/_sorting.html.twig', [
                    'Bnrs' => $Bnrs,
                ]),
                'pagination' => $this->renderView('gestion/bnr/_pagination.html.twig', [
                    'Bnrs' => $Bnrs,
                ]),
                'secondModal' => $this->renderView('gestion/_secondModal.html.twig'),
            ]);
        }
        return $this->render('gestion/bnr/bnr.html.twig', [
            'Bnrs' => $Bnrs,
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'Febs' => $this->febRepository->findAll(),
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
        $idPrio = $request->request->get('priority');
        $Prio = $this->priorisationRepository->find($idPrio);
        $Date = $request->request->get('date');
        $date = new DateTime($Date);
        $date->format('Y-m-d');
        $Comment = $request->request->get('comment');
        $idFeb = $request->request->get('feb');
        $Feb = $this->febRepository->find($idFeb);
        $NewBnr->setIdNatureAffaire($nature);
        $NewBnr->setNomAffaire($BnrName);
        $NewBnr->setObjectifAffaire($Objectif);
        $NewBnr->setMontantAffaire($montant);
        $NewBnr->setIdPriorisation($Prio);
        $NewBnr->setEcheanceAffaire($date);
        $NewBnr->setCommentaire($Comment);
        $NewBnr->setIdFeb($Feb);
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
        $BnrInfos = $this->infoBnrRepository->find($id);
        $DateDemande = $request->request->get('dateDemandeEdit');
        $dateDemande = new DateTime($DateDemande);
        $dateDemande->format('Y-m-d');
        $BnrInfos->setDateDemande($dateDemande);
        $MontantInfo = $request->request->get('montantInfoEdit');
        $BnrInfos->setMontantInfo($MontantInfo);
        $Impact = $request->request->get('impactEdit');
        $BnrInfos->setImpact($Impact);
        if ($this->isCsrfTokenValid("EditBnr", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($BnrInfos);
            $em->flush();
            $Bnr = $this->affaireRepository->find($BnrInfos->getIdAffaire());
            $BnrName = $request->request->get('bnrEdit');
            $Objectif = $request->request->get('objectifEdit');
            $montant = $request->request->get('montantEdit');
            $idPrio = $request->request->get('priorityEdit');
            $Prio = $this->priorisationRepository->find($idPrio);
            $Date = $request->request->get('dateEdit');
            $date = new DateTime($Date);
            $date->format('Y-m-d');
            $Comment = $request->request->get('commentEdit');
            $idFeb = $request->request->get('febEdit');
            $Feb = $this->febRepository->find($idFeb);
            $Bnr->setNomAffaire($BnrName);
            $Bnr->setObjectifAffaire($Objectif);
            $Bnr->setMontantAffaire($montant);
            $Bnr->setIdPriorisation($Prio);
            $Bnr->setEcheanceAffaire($date);
            $Bnr->setCommentaire($Comment);
            $Bnr->setIdFeb($Feb);
            $update = new DateTime();
            $update->format('Y-m-d\H:i:s');
            $Bnr->setUpdateAt($update);
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Bnr);
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


    /**
     * @Route ("/Admin/ImportBnr", name="importBnr")
     * @param Request $request
     * @return JsonResponse
     */
    public function import(Request $request) : JsonResponse
    {
        $file = $request->files->get('file', 'r');

        if ($file == null){
            $jsonData = array(
                'message' => "Erreur, veuillez renseignez un fichier.",
            );
        }
        else{

            $oldMessage = ',';

            $deletedFormat = '.';

            $str=file_get_contents($file->getRealPath());

            $str=str_replace($oldMessage, $deletedFormat,$str);
            file_put_contents($file->getRealPath(), $str);

            $oldMessage = ';';

            $deletedFormat = ',';

            $str=file_get_contents($file->getRealPath());

            $str=str_replace($oldMessage, $deletedFormat,$str);
            file_put_contents($file->getRealPath(), $str);
            $em = $this->ManagerRegistry->getManager();
            $csv = Reader::createFromPath($file->getRealPath());
            $csv->setHeaderOffset(0);
            $result = $csv->getRecords();

            $date = new DateTime();
            $date->format('Y-m-d');

            $nature = $this->natureAffaireRepository->findOneBy([
                'natureAffaire' => 'besoinNouveauReseau',
            ]);

            foreach ( $result as $row){
                $montant = floatval($row['Montant']);

                $bnr = (new Affaire())
                    ->setNomAffaire($row['Description Opération'])
                    ->setObjectifAffaire($row['Description Opération'])
                    ->setMontantAffaire($montant)
                    ->setEcheanceAffaire($date)
                    ->setIdNatureAffaire($nature)
                    ->setIdPriorisation($this->priorisationRepository->findOneBy([
                        'priorisation' => 'P1'
                    ]));
                ;
                if ($row['FEB'] !=''){
                    $feb = $this->febRepository->findOneBy([
                        'numFeb' => $row['FEB']
                    ]);
                    if ($feb != null){

                        $organisme = $this->organismeRepository->findOneBy([
                            'organisme' => $row['ENTITE'],
                        ]);
                        if ($organisme != null){
                            $feb->addIdOrganisme($organisme);
                        }
                    }
                    else{
                        $pdc = $this->planDeChargeRepository->findOneBy([
                            'numPdc' => $row['PDC']
                        ]);
                        if ($pdc == null){
                            $pdc = (new PlanDeCharge())
                                ->setNumPdc($row['PDC'])
                            ;
                            $em->persist($pdc);
                            $em->flush();
                        }
                        $feb = (new Feb())
                            ->setNumFeb($row['FEB'])
                            ->setIntituleFeb($row['Description Opération'])
                            ->setMontantFeb($montant)
                            ->setIdPdc($pdc)
                        ;
                        $em->persist($feb);
                        $em->flush();
                    }
                    $bnr->setIdFeb($feb);
                }

                $em->persist($bnr);
                $em->flush();
                $infoBnr = (new InfoBnr())
                    ->setIdAffaire($bnr)
                    ->setDateDemande($date)
                ;
                $em->persist($infoBnr);
                $em->flush();
            }

            $jsonData = array(
                'message' => "Importation terminée",
            );
        }

        return $this->json($jsonData, 200);
    }

}