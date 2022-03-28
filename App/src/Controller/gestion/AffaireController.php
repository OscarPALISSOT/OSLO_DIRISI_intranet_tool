<?php

namespace App\Controller\gestion;

use App\Data\SearchDataAffaire;
use App\Entity\Affaire;
use App\form\filters\AffaireSearchForm;
use App\Repository\AffaireRepository;
use App\Repository\FebRepository;
use App\Repository\NatureAffaireRepository;
use App\Repository\OrganismeRepository;
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

class AffaireController extends AbstractController {

    private $ManagerRegistry;
    private $organismeRepository;
    private $sigleRepository;
    private $priorisationRepository;
    private $affaireRepository;
    private $quartiersRepository;
    private $febRepository;
    private $natureAffaireRepository;

    public function __construct(ManagerRegistry $doctrine, OrganismeRepository $organismeRepository, SigleRepository $sigleRepository, PriorisationRepository $priorisationRepository, AffaireRepository $affaireRepository, QuartiersRepository $quartiersRepository, FebRepository $febRepository, NatureAffaireRepository $natureAffaireRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->organismeRepository = $organismeRepository;
        $this->sigleRepository = $sigleRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->affaireRepository = $affaireRepository;
        $this->quartiersRepository = $quartiersRepository;
        $this->febRepository = $febRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
    }


    /**
     * @Route ("/{role}/Affaire", name="Affaire")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        $Data = new SearchDataAffaire();
        $Data->page =$request->get('page', 1);
        $form = $this->createForm(AffaireSearchForm::class, $Data);
        $form->handleRequest($request);

        $Affaires = $this->affaireRepository->findAffaireSearch($Data);
        dump($Affaires);

        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        $sigles = $this->sigleRepository->findSigles();
        if ($request->get('Ajax')){
            return new JsonResponse([
                'content' => $this->renderView('gestion/affaire/_content.html.twig', [
                    'Affaires' => $Affaires,
                    'Organismes' => $this->organismeRepository->findAllWithQuartier(),
                    'Febs' => $this->febRepository->findAll(),
                    'Natures' => $this->natureAffaireRepository->findAffairesNature(),
                    'sigles' => $sigles,
                    'Prios' => $this->priorisationRepository->findAll(),
                ]),
                'sorting' => $this->renderView('gestion/affaire/_sorting.html.twig', [
                    'Affaires' => $Affaires,
                ]),
                'pagination' => $this->renderView('gestion/affaire/_pagination.html.twig', [
                    'Affaires' => $Affaires,
                ]),
                'secondModal' => $this->renderView('gestion/_secondModal.html.twig'),
            ]);
        }
        return $this->render('gestion/affaire/affaire.html.twig', [
            'Affaires' => $Affaires,
            'Febs' => $this->febRepository->findAll(),
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'Natures' => $this->natureAffaireRepository->findAffairesNature(),
            'role' => $role[0],
            'title' => 'Affaire',
            'Prios' => $this->priorisationRepository->findAll(),
            'form' => $form->createView(),
            'sigles' => $sigles,
        ]);
    }


    /**
     * @Route ("/NewAffaire", name="Admin_Affaire_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newAffaire(Request $request) : Response{
        $NewAffaire = new Affaire();
        $idNature = $request->request->get('nature');
        $nature = $this->natureAffaireRepository->find($idNature);
        $AffaireName = $request->request->get('affaire');
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
        $NewAffaire = (new Affaire())
            ->setIdNatureAffaire($nature)
            ->setNomAffaire($AffaireName)
            ->setObjectifAffaire($Objectif)
            ->setMontantAffaire($montant)
            ->setIdPriorisation($Prio)
            ->setEcheanceAffaire($date)
            ->setCommentaire($Comment)
            ->setIdFeb($Feb)
        ;
        if ($this->isCsrfTokenValid("CreateAffaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewAffaire);
            $em->flush();

            $jsonData = array(
                'message' =>  'Affaire ajoutée',
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
     * @Route ("/DeleteAffaire", name="Admin_Affaire_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteAffaire(Request $request): Response{
        $Affaires = $this->affaireRepository->findAll();
        $nbAffaire = count($Affaires);
        $ChekedId = array();
        for ( $i = 0; $i < $nbAffaire; $i++){
            if ($request->request->get('idChecked' . $Affaires[$i]->getIdAffaire())){
                $ChekedId[] = $Affaires[$i]->getIdAffaire();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $affaireToDelete = $this->affaireRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteAffaire", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
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
     * @Route ("/EditAffaire/{id}", name="Admin_Affaire_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditAffaire(Request $request) : Response{
        $idAffaire = $request->request->get('idEdit');
        $idNature = $request->request->get('natureEdit');
        $nature = $this->natureAffaireRepository->find($idNature);
        $AffaireName = $request->request->get('affaireEdit');
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
        $Affaire = $this->affaireRepository->find($idAffaire)
            ->setIdNatureAffaire($nature)
            ->setNomAffaire($AffaireName)
            ->setObjectifAffaire($Objectif)
            ->setMontantAffaire($montant)
            ->setIdPriorisation($Prio)
            ->setEcheanceAffaire($date)
            ->setCommentaire($Comment)
            ->setIdFeb($Feb)
        ;

        if ($this->isCsrfTokenValid("EditAffaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Affaire);
            $em->flush();
            $jsonData = array(
                'message' => 'Affaire modifiée',
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