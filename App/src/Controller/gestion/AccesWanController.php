<?php

namespace App\Controller\gestion;

use App\Data\SearchDataAccesWan;
use App\Entity\AccesWan;
use App\Entity\TravauxAccesWan;
use App\form\filters\AccesWanSearchForm;
use App\Repository\AccesWanRepository;
use App\Repository\NatureAffaireRepository;
use App\Repository\PriorisationRepository;
use App\Repository\QuartiersRepository;
use App\Repository\SigleRepository;
use App\Repository\TravauxAccesWanRepository;
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

class AccesWanController extends AbstractController {

    private $ManagerRegistry;
    private $quartiersRepository;
    private $sigleRepository;
    private $priorisationRepository;
    private $accesWanRepository;
    private $natureAffaireRepository;
    private $travauxAccesWanRepository;

    public function __construct(ManagerRegistry $doctrine, QuartiersRepository $quartiersRepository, SigleRepository $sigleRepository, PriorisationRepository $priorisationRepository, AccesWanRepository $accesWanRepository, NatureAffaireRepository $natureAffaireRepository, TravauxAccesWanRepository $travauxAccesWanRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->quartiersRepository = $quartiersRepository;
        $this->sigleRepository = $sigleRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->accesWanRepository = $accesWanRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
        $this->travauxAccesWanRepository = $travauxAccesWanRepository;
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

        $numeroDemande = $this->travauxAccesWanRepository->findAll();

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
        $cout = $request->request->get('cout');
        $etat = $request->request->get('etat');
        $debit = $request->request->get('Debit');
        $comment = $request->request->get('comment');
        $origine = $request->request->get('origine');
        $DateDebut = $request->request->get('dateDebut');
        $DateFin = $request->request->get('dateFin');
        $dateDebut = new DateTime($DateDebut);
        $dateDebut->format('Y-m-d');
        $dateFin = new DateTime($DateFin);
        $dateFin->format('Y-m-d');
        $NewAccesWan = (new AccesWan())
            ->setIdAccess($IdAccess)
            ->setOrigine($origine)
            ->setIdQuartier($Quartier)
            ->setDebitOpera($debit)
            ->setTypeOpera($type)
            ->setEtatOpera($etat)
            ->setCommentaire($comment)
            ->setDateDebut($dateDebut)
            ->setDateFin($dateFin)
            ->setCoutMensuel($cout)
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
        $origine = $request->request->get('origineEdit');
        $cout = $request->request->get('coutEdit');
        $idQuartier = $request->request->get('quartierEdit');
        $Quartier = $this->quartiersRepository->find($idQuartier);
        $type = $request->request->get('typeEdit');
        $etat = $request->request->get('etatEdit');
        $debit = $request->request->get('DebitEdit');
        $comment = $request->request->get('commentEdit');
        $DateDebut = $request->request->get('dateDebutEdit');
        $DateFin = $request->request->get('dateFinEdit');
        $dateDebut = new DateTime($DateDebut);
        $dateDebut->format('Y-m-d');
        $dateFin = new DateTime($DateFin);
        $dateFin->format('Y-m-d');
        $AccesWan = $this->accesWanRepository->find($id)
            ->setIdAccess($IdAccess)
            ->setOrigine($origine)
            ->setIdQuartier($Quartier)
            ->setCoutMensuel($cout)
            ->setDebitOpera($debit)
            ->setTypeOpera($type)
            ->setEtatOpera($etat)
            ->setCommentaire($comment)
            ->setDateDebut($dateDebut)
            ->setDateFin($dateFin)
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

    /**
     * @route ("/Admin/ImportTravauxAccesWan", name="importTravauxAccesWan")
     * @param Request $request
     * @return JsonResponse
     */

    public function importTravauxAccesWan(Request $request) : JsonResponse
    {
        $file = $request->files->get('file','r');

        if($file == null){
            $jsonData = array([
                'message' => "Pas de travaux renseignés"
            ]);
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


            foreach ($result as $row){

                $idOpera = $this->accesWanRepository->findOneBy([
                    'idAccess' => $row['Nom de l accès']
                ]);

                $numeroDemande = $this->travauxAccesWanRepository->findOneBy([
                   'numeroDemande' => $row['n° Demande']
                ]);

                if($row['Date envoi client'] != ''){
                    $dateTravaux = new dateTime($row['Date envoi client']);
                    $dateTravaux->format('Y-m-d');
                }else{
                    $dateTravaux = null;
                }

                if($numeroDemande == '') {
                    $travauxOpera = (new TravauxAccesWan())
                        ->setIdOpera($idOpera)
                        ->setNumeroDemande($row['n° Demande'])
                        ->setDateTravauxOpera($dateTravaux)
                        ->setEtatTravauxOpera($row['ETAT PRODUCTION'])
                        ->setDebitFinTravauxOpera($row['Débit cible global']);

                    $em->persist($travauxOpera);
                    $em->flush();
                }

                else{
                    $numeroDemande
                        ->setDebitFinTravauxOpera($row['Débit cible global'])
                        ->setEtatTravauxOpera($row['ETAT PRODUCTION'])
                        ->setDateTravauxOpera($dateTravaux)
                        ->setIdOpera($idOpera);
                    

                    $em->persist($numeroDemande);
                    $em->flush();
                }

            }

            $jsonData = array([
                'message' => 'importation terminée'
            ]);
        }

        return $this->json($jsonData,200);
    }

    /**
     * @Route ("/Admin/ImportAccesWan", name="importAccesWan")
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

            foreach ( $result as $row) {

                $idAccess = $this->accesWanRepository->findOneBy([
                    'idAccess' => $row['Id. accès OPERA']
                ]);

                $quartier = $this->quartiersRepository->findOneBy([
                    'trigramme' => $row['Trigramme']
                ]);

                if ($row['Date début facturation OPERA'] != '') {
                    $dateDebut = new DateTime($row['Date début facturation OPERA']);
                    $dateDebut->format('Y-m-d');
                } else {
                    $dateDebut = null;
                }

                if ($row['Date fin facturation OPERA'] != '') {
                    $dateFin = new DateTime($row['Date fin facturation OPERA']);
                    $dateFin->format('Y-m-d');
                } else {
                    $dateFin = null;
                }

                if ($idAccess == '') {
                    $opera = (new AccesWan())
                        ->setIdAccess($row['Id. accès OPERA'])
                        ->setDebitOpera($row["Débit de  l'accès (Mbs)"])
                        ->setCoutMensuel($row["Coût mensuel HT"])
                        ->setOrigine($row['Origine'])
                        ->setDateDebut($dateDebut)
                        ->setDateFin($dateFin)
                        ->setIdQuartier($quartier)
                        ->setEtatOpera(1);
                    if ($row['Type Racc'] == 'Cuivre') {
                        $opera->setTypeOpera(1);
                    } elseif ($row['Type Racc'] == 'Fibre') {
                        $opera->setTypeOpera(2);
                    }
                    $em->persist($opera);
                    $em->flush();
                }
                else {
                    $idAccess
                        ->setDebitOpera($row["Débit de  l'accès (Mbs)"])
                        ->setCoutMensuel($row["Coût mensuel HT"])
                        ->setOrigine($row["Origine"])
                        ->setDateDebut($dateDebut)
                        ->setDateFin($dateFin)
                        ->setEtatOpera(1);
                    if ($row['Type Racc'] == 'Cuivre') {
                        $idAccess->setTypeOpera(1);
                    } elseif ($row['Type Racc'] == 'Fibre') {
                        $idAccess->setTypeOpera(2);
                    }
                    $em->persist($idAccess);
                    $em->flush();
                }
            }
            $jsonData = array(
                'message' => "Importation terminée",
            );
        }

        return $this->json($jsonData, 200);
    }



}