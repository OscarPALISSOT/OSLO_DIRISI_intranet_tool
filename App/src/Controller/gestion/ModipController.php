<?php

namespace App\Controller\gestion;

use App\Data\SearchDataModip;
use App\Entity\Affaire;
use App\Entity\InfoModip;
use App\form\filters\ModipSearchForm;
use App\Repository\AffaireRepository;
use App\Repository\ClassementDlRepository;
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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    private ClassementDlRepository $classementDlRepository;

    public function __construct(ManagerRegistry $doctrine, OrganismeRepository $organismeRepository, QuartiersRepository $quartiersRepository, AffaireRepository $affaireRepository, SigleRepository $sigleRepository, NatureAffaireRepository $natureAffaireRepository, PriorisationRepository $priorisationRepository, FebRepository $febRepository, GrandsComptesRepository $grandsComptesRepository, InfoModipRepository $infoModipRepository, ClassementDlRepository $classementDlRepository)
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
        $this->classementDlRepository = $classementDlRepository;
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
        if ($request->get('Ajax')){
            return new JsonResponse([
                'content' => $this->renderView('gestion/modip/_content.html.twig', [
                    'Modips' => $Modips,
                    'Organismes' => $this->organismeRepository->findAllWithQuartier(),
                    'Febs' => $this->febRepository->findAll(),
                    'ClassementDls' =>$this->classementDlRepository->findAll(),
                    'GrandComptes' => $this->grandsComptesRepository->findAll(),
                    'Prios' => $this->priorisationRepository->findAll(),
                ]),
                'sorting' => $this->renderView('gestion/modip/_sorting.html.twig', [
                    'Modips' => $Modips,
                ]),
                'pagination' => $this->renderView('gestion/modip/_pagination.html.twig', [
                    'Modips' => $Modips,
                ]),
                'secondModal' => $this->renderView('gestion/_secondModal.html.twig'),
            ]);
        }
        return $this->render('gestion/modip/Modip.html.twig', [
            'Modips' => $Modips,
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'Febs' => $this->febRepository->findAll(),
            'ClassementDls' =>$this->classementDlRepository->findAll(),
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
            'natureAffaire' => 'modifLan',
        ]);
        $ModipName = $request->request->get('modip');
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
        $NewModip = (new Affaire())
            ->setIdNatureAffaire($nature)
            ->setNomAffaire($ModipName)
            ->setObjectifAffaire($Objectif)
            ->setMontantAffaire($montant)
            ->setIdPriorisation($Prio)
            ->setEcheanceAffaire($date)
            ->setCommentaire($Comment)
            ->setIdFeb($Feb)
        ;
        if ($this->isCsrfTokenValid("CreateModip", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewModip);
            $em->flush();
            $coeurAvantTvx = $request->request->get('AnneeCoeurAvantTvx');
            $Annee = $request->request->get('Annee');
            $AnneeRenoCoeur = $request->request->get('AnneeRenoCoeur');
            $idclassement = $request->request->get('classement');
            $classement = $this->classementDlRepository->find($idclassement);
            $renoApres = $request->request->get('renoApres');
            $renoAvant = $request->request->get('renoAvant');
            $semestre = $request->request->get('semestre');
            $classification = $request->request->get('classification');
            $NewModipInfos = (new InfoModip())
                ->setIdAffaire($NewModip)
                ->setAnneeCoeurAvTvx($coeurAvantTvx)
                ->setAnneeModip($Annee)
                ->setAnneeRenoCoeur($AnneeRenoCoeur)
                ->setIdClassementDl($classement)
                ->setRenoApres($renoApres)
                ->setRenoAvant($renoAvant)
                ->setSemestreModip($semestre)
                ->setClassification($classification);
            ;

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
        $coeurAvantTvx = $request->request->get('AnneeCoeurAvantTvxEdit');
        $Annee = $request->request->get('AnneeEdit');
        $AnneeRenoCoeur = $request->request->get('AnneeRenoCoeurEdit');
        $idclassement = $request->request->get('classementEdit');
        $classement = $this->classementDlRepository->find($idclassement);
        $renoApres = $request->request->get('renoApresEdit');
        $renoAvant = $request->request->get('renoAvantEdit');
        $semestre = $request->request->get('semestreEdit');
        $classification = $request->request->get('classificationEdit');
        $ModipInfo = $this->infoModipRepository->find($id)
            ->setAnneeCoeurAvTvx($coeurAvantTvx)
            ->setAnneeModip($Annee)
            ->setAnneeRenoCoeur($AnneeRenoCoeur)
            ->setIdClassementDl($classement)
            ->setRenoApres($renoApres)
            ->setRenoAvant($renoAvant)
            ->setSemestreModip($semestre)
            ->setClassification($classification);
        ;
        if ($this->isCsrfTokenValid("EditModip", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($ModipInfo);
            $em->flush();
            $ModipName = $request->request->get('modipEdit');
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
            $update = new DateTime();
            $update->format('Y-m-d-H:i:s');
            $Modip = $this->affaireRepository->find($ModipInfo->getIdAffaire())
                ->setNomAffaire($ModipName)
                ->setObjectifAffaire($Objectif)
                ->setMontantAffaire(floatval($montant))
                ->setIdPriorisation($Prio)
                ->setEcheanceAffaire($date)
                ->setCommentaire($Comment)
                ->setIdFeb($Feb)
                ->setUpdateAt($update)
            ;
            $em->persist($Modip);
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