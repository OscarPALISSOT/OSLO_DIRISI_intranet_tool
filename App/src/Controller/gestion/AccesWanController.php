<?php

namespace App\Controller\gestion;

use App\Data\SearchDataAccesWan;
use App\Entity\AccesWan;
use App\form\filters\AccesWanSearchForm;
use App\Repository\AccesWanRepository;
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

class AccesWanController extends AbstractController {

    private ManagerRegistry $ManagerRegistry;
    private QuartiersRepository $quartiersRepository;
    private SigleRepository $sigleRepository;
    private PriorisationRepository $priorisationRepository;
    private AccesWanRepository $accesWanRepository;

    public function __construct(ManagerRegistry $doctrine, QuartiersRepository $quartiersRepository, SigleRepository $sigleRepository, PriorisationRepository $priorisationRepository, AccesWanRepository $accesWanRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->quartiersRepository = $quartiersRepository;
        $this->sigleRepository = $sigleRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->accesWanRepository = $accesWanRepository;
    }


    /**
     * @Route ("/{role}/AccesWan", name="AccesWan")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        $Data = new SearchDataAccesWan();
        $Data->page =$request->get('page', 1);
        $form = $this->createForm(AccesWanSearchForm::class, $Data);
        $form->handleRequest($request);

        $AccesWans = $this->accesWanRepository->findAccesWanSearch($Data);

        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        $sigles = $this->sigleRepository->findSigles();
        if ($request->get('Ajax')){
            return new JsonResponse([
                'content' => $this->renderView('gestion/accesWan/_content.html.twig', [
                    'AccesWans' => $AccesWans,
                    'Quartiers' => $this->quartiersRepository->findAll(),
                ]),
                'sorting' => $this->renderView('gestion/accesWan/_sorting.html.twig', [
                    'AccesWans' => $AccesWans,
                ]),
                'pagination' => $this->renderView('gestion/accesWan/_pagination.html.twig', [
                    'AccesWans' => $AccesWans,
                ]),
                'secondModal' => $this->renderView('gestion/_secondModal.html.twig'),
            ]);
        }
        return $this->render('gestion/accesWan/AccesWan.html.twig', [
            'AccesWans' => $AccesWans,
            'Quartiers' => $this->quartiersRepository->findAll(),
            'role' => $role[0],
            'title' => $this->sigleRepository->findOneBy([
                'intituleSigle' => 'AccesWan'
            ]),
            'Prios' => $this->priorisationRepository->findAll(),
            'form' => $form->createView(),
            'sigles' => $sigles,
        ]);
    }


    /**
     * @Route ("/NewAccesWan", name="Admin_AccesWan_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newAccesWan(Request $request) : Response{
        $IdAccess = $request->request->get('IdAccess');
        $idQuartier = $request->request->get('quartier');
        $Quartier = $this->quartiersRepository->find($idQuartier);
        $type = $request->request->get('type');
        $etat = $request->request->get('etat');
        $debit = $request->request->get('Debit');
        $comment = $request->request->get('comment');
        $NewAccesWan = (new AccesWan())
            ->setIdAccess($IdAccess)
            ->setIdQuartier($Quartier)
            ->setDebitOpera($debit)
            ->setTypeOpera($type)
            ->setEtatOpera($etat)
            ->setCommentaire($comment)
        ;
        if ($this->isCsrfTokenValid("CreateAccesWan", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewAccesWan);
            $em->flush();

            $jsonData = array(
                'message' => $this->sigleRepository->findOneBy([
                        'intituleSigle' => 'AccesWan'
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
     * @Route ("/DeleteAccesWan", name="Admin_AccesWan_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteAccesWan(Request $request): Response{
        $AccesWans = $this->accesWanRepository->findAll();
        $nbAccesWan = count($AccesWans);
        $ChekedId = array();
        for ( $i = 0; $i < $nbAccesWan; $i++){
            if ($request->request->get('idChecked' . $AccesWans[$i]->getIdOpera())){
                $ChekedId[] = $AccesWans[$i]->getIdOpera();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $accesWanToDelete = $this->accesWanRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteAccesWan", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($accesWanToDelete);
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
     * @Route ("/EditAccesWan/{id}", name="Admin_AccesWan_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditAccesWan(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $IdAccess = $request->request->get('IdAccessEdit');
        $idQuartier = $request->request->get('quartierEdit');
        $Quartier = $this->quartiersRepository->find($idQuartier);
        $type = $request->request->get('typeEdit');
        $etat = $request->request->get('etatEdit');
        $debit = $request->request->get('DebitEdit');
        $comment = $request->request->get('commentEdit');
        $AccesWan = $this->accesWanRepository->find($id)
            ->setIdAccess($IdAccess)
            ->setIdQuartier($Quartier)
            ->setDebitOpera($debit)
            ->setTypeOpera($type)
            ->setEtatOpera($etat)
            ->setCommentaire($comment)
        ;
        if ($this->isCsrfTokenValid("EditAccesWan", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($AccesWan);
            $em->flush();

            $jsonData = array(
                'message' => $this->sigleRepository->findOneBy([
                        'intituleSigle' => 'AccesWan'
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