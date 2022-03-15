<?php

namespace App\Controller\gestion;

use App\Data\SearchDataInternetMilitaire;
use App\Entity\Affaire;
use App\Entity\InternetMilitaire;
use App\form\filters\InternetMilitaireSearchForm;
use App\Repository\AffaireRepository;
use App\Repository\ClassementDlRepository;
use App\Repository\FebRepository;
use App\Repository\GrandsComptesRepository;
use App\Repository\InternetMilitaireRepository;
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

class InternetMilitaireController extends AbstractController {

    private ManagerRegistry $ManagerRegistry;
    private OrganismeRepository $organismeRepository;
    private QuartiersRepository $quartiersRepository;
    private SigleRepository $sigleRepository;
    private NatureAffaireRepository $natureAffaireRepository;
    private PriorisationRepository $priorisationRepository;
    private FebRepository $febRepository;
    private GrandsComptesRepository $grandsComptesRepository;
    private ClassementDlRepository $classementDlRepository;
    private InternetMilitaireRepository $internetMilitaireRepository;

    public function __construct(ManagerRegistry $doctrine, OrganismeRepository $organismeRepository, QuartiersRepository $quartiersRepository, SigleRepository $sigleRepository, NatureAffaireRepository $natureAffaireRepository, PriorisationRepository $priorisationRepository, FebRepository $febRepository, GrandsComptesRepository $grandsComptesRepository, ClassementDlRepository $classementDlRepository, InternetMilitaireRepository $internetMilitaireRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->organismeRepository = $organismeRepository;
        $this->quartiersRepository = $quartiersRepository;
        $this->sigleRepository = $sigleRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->febRepository = $febRepository;
        $this->grandsComptesRepository = $grandsComptesRepository;
        $this->classementDlRepository = $classementDlRepository;
        $this->internetMilitaireRepository = $internetMilitaireRepository;
    }


    /**
     * @Route ("/{role}/InternetMilitaire", name="InternetMilitaire")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        $Data = new SearchDataInternetMilitaire();
        $Data->page =$request->get('page', 1);
        $form = $this->createForm(InternetMilitaireSearchForm::class, $Data);
        $form->handleRequest($request);

        $InternetMilitaires = $this->internetMilitaireRepository->findInternetMilitaireSearch($Data);

        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        $sigles = $this->sigleRepository->findSigles();
        if ($request->get('Ajax')){
            return new JsonResponse([
                'content' => $this->renderView('gestion/internetMilitaire/_content.html.twig', [
                    'InternetMilitaires' => $InternetMilitaires,
                    'Organismes' => $this->organismeRepository->findAllWithQuartier(),
                    'Febs' => $this->febRepository->findAll(),
                    'ClassementDls' =>$this->classementDlRepository->findAll(),
                    'GrandComptes' => $this->grandsComptesRepository->findAll(),
                    'Prios' => $this->priorisationRepository->findAll(),
                ]),
                'sorting' => $this->renderView('gestion/internetMilitaire/_sorting.html.twig', [
                    'InternetMilitaires' => $InternetMilitaires,
                ]),
                'pagination' => $this->renderView('gestion/internetMilitaire/_pagination.html.twig', [
                    'InternetMilitaires' => $InternetMilitaires,
                ]),
                'secondModal' => $this->renderView('gestion/_secondModal.html.twig'),
            ]);
        }
        return $this->render('gestion/internetMilitaire/InternetMilitaire.html.twig', [
            'InternetMilitaires' => $InternetMilitaires,
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'Febs' => $this->febRepository->findAll(),
            'ClassementDls' =>$this->classementDlRepository->findAll(),
            'GrandComptes' => $this->grandsComptesRepository->findAll(),
            'Quartiers' => $this->quartiersRepository->findAll(),
            'role' => $role[0],
            'title' => $this->sigleRepository->findOneBy([
                'intituleSigle' => 'internet_militaire'
            ]),
            'Prios' => $this->priorisationRepository->findAll(),
            'form' => $form->createView(),
            'sigles' => $sigles,
        ]);
    }


    /**
     * @Route ("/NewInternetMilitaire", name="Admin_InternetMilitaire_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newInternetMilitaire(Request $request) : Response{
        $masterId = $request->request->get('masterId');
        $idoOrga = $request->request->get('orga');
        $orga = $this->organismeRepository->find($idoOrga);
        $type = $request->request->get('type');
        $etat = $request->request->get('etat');
        $ipPfs = $request->request->get('ipPfs');
        $ipLanSubnet = $request->request->get('ipLanSubnet');
        $Date = $request->request->get('date');
        $date = new DateTime($Date);
        $date->format('Y-m-d');
        $comment = $request->request->get('comment');
        $NewInternetMilitaire = (new InternetMilitaire())
            ->setMasterId($masterId)
            ->setIdOrganisme($orga)
            ->setTypeInternetMilitaire($type)
            ->setEtatInternetMilitaire($etat)
            ->setIpPfs($ipPfs)
            ->setIpLanSubnet($ipLanSubnet)
            ->setDateDeValidation($date)
            ->setCommentaire($comment)
        ;
        if ($this->isCsrfTokenValid("CreateInternetMilitaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewInternetMilitaire);
            $em->flush();

            $jsonData = array(
                'message' => $this->sigleRepository->findOneBy([
                    'intituleSigle' => 'internet_militaire'
                ]) . ' ajouté',
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
     * @Route ("/DeleteInternetMilitaire", name="Admin_InternetMilitaire_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteInternetMilitaire(Request $request): Response{
        $InternetMilitaires = $this->infoInternetMilitaireRepository->findAll();
        $nbInternetMilitaire = count($InternetMilitaires);
        $ChekedId = array();
        for ( $i = 0; $i < $nbInternetMilitaire; $i++){
            if ($request->request->get('idChecked' . $InternetMilitaires[$i]->getIdInfoInternetMilitaire())){
                $ChekedId[] = $InternetMilitaires[$i]->getIdInfoInternetMilitaire();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $internetMilitaireToDelete = $this->infoInternetMilitaireRepository->find($item);
                $affaireToDelete = $this->affaireRepository->find($internetMilitaireToDelete->getIdAffaire());

                if ($this->isCsrfTokenValid("DeleteInternetMilitaire", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($internetMilitaireToDelete);
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
     * @Route ("/EditInternetMilitaire/{id}", name="Admin_InternetMilitaire_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditInternetMilitaire(Request $request) : Response{
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
        $InternetMilitaireInfo = $this->infoInternetMilitaireRepository->find($id)
            ->setAnneeCoeurAvTvx($coeurAvantTvx)
            ->setAnneeInternetMilitaire($Annee)
            ->setAnneeRenoCoeur($AnneeRenoCoeur)
            ->setIdClassementDl($classement)
            ->setRenoApres($renoApres)
            ->setRenoAvant($renoAvant)
            ->setSemestreInternetMilitaire($semestre)
            ->setClassification($classification);
        ;
        if ($this->isCsrfTokenValid("EditInternetMilitaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($InternetMilitaireInfo);
            $em->flush();
            $InternetMilitaireName = $request->request->get('internetMilitaireEdit');
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
            $InternetMilitaire = $this->affaireRepository->find($InternetMilitaireInfo->getIdAffaire())
                ->setNomAffaire($InternetMilitaireName)
                ->setObjectifAffaire($Objectif)
                ->setMontantAffaire(floatval($montant))
                ->setIdPriorisation($Prio)
                ->setEcheanceAffaire($date)
                ->setCommentaire($Comment)
                ->setIdFeb($Feb)
                ->setUpdateAt($update)
            ;
            $em->persist($InternetMilitaire);
            $em->flush();
            $jsonData = array(
                'message' => $this->sigleRepository->findOneBy([
                        'intituleSigle' => 'internet_militaire'
                    ]) .' modifié',
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