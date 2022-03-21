<?php

namespace App\Controller\administration;

use App\Entity\BasesDeDefense;
use App\Entity\Cirisi;
use App\Entity\ClassementDl;
use App\Entity\EtatPdc;
use App\Entity\GrandsComptes;
use App\Entity\NatureAffaire;
use App\Entity\Organisme;
use App\Entity\Priorisation;
use App\Entity\Quartiers;
use App\Entity\Rfz;
use App\Entity\Sigle;
use App\Entity\StatutPdc;
use App\Entity\SupportInternetMilitaire;
use App\Entity\Users;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\CirisiRepository;
use App\Repository\ClassementDlRepository;
use App\Repository\ContactRepository;
use App\Repository\EtatPdcRepository;
use App\Repository\GrandsComptesRepository;
use App\Repository\NatureAffaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\PriorisationRepository;
use App\Repository\QuartiersRepository;
use App\Repository\RfzRepository;
use App\Repository\SigleRepository;
use App\Repository\StatutPdcRepository;
use App\Repository\SupportInternetMilitaireRepository;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController {

    private $RfzRepository;
    private $BasesDeDefenseRepository;
    private $ContactRepository;
    private $cirisiRepository;
    private $quartiersRepository;
    private $organismeRepository;
    private $usersRepository;
    private $sigleRepository;
    private $grandsComptesRepository;
    private $priorisationRepository;
    private $natureAffaireRepository;
    private $statutPdcRepository;
    private $doctrine;
    private $etatPdcRepository;
    private $classementDlRepository;
    private $supportInternetMilitaireRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $hasher;

    public function __construct(BasesDeDefenseRepository $basesDeDefenseRepository, RfzRepository $RfzRepository, ContactRepository $contactRepository, CirisiRepository $cirisiRepository, QuartiersRepository $quartiersRepository, OrganismeRepository $organismeRepository, UsersRepository $usersRepository, SigleRepository $sigleRepository, GrandsComptesRepository $grandsComptesRepository, PriorisationRepository $priorisationRepository, NatureAffaireRepository $natureAffaireRepository, StatutPdcRepository $statutPdcRepository, ManagerRegistry $doctrine, EtatPdcRepository $etatPdcRepository, UserPasswordEncoderInterface $hasher, ClassementDlRepository $classementDlRepository, SupportInternetMilitaireRepository $supportInternetMilitaireRepository)
    {
        $this->RfzRepository = $RfzRepository;
        $this->BasesDeDefenseRepository = $basesDeDefenseRepository;
        $this->ContactRepository = $contactRepository;
        $this->cirisiRepository = $cirisiRepository;
        $this->quartiersRepository = $quartiersRepository;
        $this->organismeRepository = $organismeRepository;
        $this->usersRepository = $usersRepository;
        $this->sigleRepository = $sigleRepository;
        $this->grandsComptesRepository = $grandsComptesRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
        $this->statutPdcRepository = $statutPdcRepository;
        $this->doctrine = $doctrine;
        $this->etatPdcRepository = $etatPdcRepository;
        $this->classementDlRepository = $classementDlRepository;
        $this->supportInternetMilitaireRepository = $supportInternetMilitaireRepository;
        $this->hasher = $hasher;
    }

    /**
     * @Route ("/Admin", name="Admin")
     * @return Response
     */
    public function index() : Response{
        $sigles = $this->sigleRepository->findSigles();
        return $this->render('administration/admin.html.twig', [
            'nbBdd' => count($this->BasesDeDefenseRepository->findAll()),
            'nbRfz' => count($this->RfzRepository->findAll()),
            'nbContact' => count($this->ContactRepository->findAll()),
            'nbCirisi' => count($this->cirisiRepository->findAll()),
            'nbQuartier' => count($this->quartiersRepository->findAll()),
            'nbOrganisme' => count($this->organismeRepository->findAll()),
            'nbUser' => count($this->usersRepository->findAll()),
            'nbSigle' => count($this->sigleRepository->findAll()),
            'nbPriorisation' => count($this->priorisationRepository->findAll()),
            'nbGrandComptes' => count($this->grandsComptesRepository->findAll()),
            'nbNatureAffaire' => count($this->natureAffaireRepository->findAll()),
            'nbStatutPdc' => count($this->statutPdcRepository->findAll()),
            'nbEtatPdc' => count($this->etatPdcRepository->findAll()),
            'nbClassementDl' => count($this->classementDlRepository->findAll()),
            'nbSupportInternetMilitaire' => count($this->supportInternetMilitaireRepository->findAll()),
            'sigles' => $sigles,
        ]);
    }

    /**
     * @Route ("/Admin/ImportDataBase", name="importDatabase")
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

            $oldMessage = ';';

            $deletedFormat = ',';

            $str=file_get_contents($file->getRealPath());

            $str=str_replace($oldMessage, $deletedFormat,$str);
            file_put_contents($file->getRealPath(), $str);

            $em = $this->doctrine->getManager();
            $csv = Reader::createFromPath($file->getRealPath());
            $csv->setHeaderOffset(0);
            $result = $csv->getRecords();

            foreach ( $result as $row){

                $rfz = $this->RfzRepository->findOneBy([
                    'rfz' => $row['Rfz'],
                ]);
                if ( $rfz == null){
                    $rfz = (new Rfz())
                        ->setRfz($row['Rfz'])
                    ;
                    $em->persist($rfz);
                    $em->flush();
                }

                $bdd = $this->BasesDeDefenseRepository->findOneBy([
                    'baseDefense' => $row['Bdd'],
                ]);

                if ($bdd == null){
                    $bdd = (new BasesDeDefense())
                        ->setBaseDefense($row['Bdd'])
                        ->setIdRfz($rfz)
                    ;
                    $em->persist($bdd);
                    $em->flush();
                }

                $cirisi = $this->cirisiRepository->findOneBy([
                    'cirisi' => $row['Cirisi'],
                ]);
                if ($cirisi == null){
                    $cirisi = (new Cirisi())
                        ->setCirisi($row['Cirisi'])
                        ->setIdBaseDefense($bdd)
                    ;
                    $em->persist($cirisi);
                    $em->flush();
                }

                $quartier = $this->quartiersRepository->findOneBy([
                    'trigramme' => $row['Trigramme'],
                ]);
                if ($quartier == null){
                    $quartier = (new Quartiers())
                        ->setQuartier($row['Quartier'])
                        ->setTrigramme($row['Trigramme'])
                        ->setAdresseQuartier($row['adresse'])
                        ->setIdBaseDefense($bdd)
                    ;
                    $em->persist($quartier);
                    $em->flush();
                }

                $organisme = (new Organisme())
                    ->setOrganisme($row['Organisme'])
                    ->setIdQuartier($quartier)
                ;
                $em->persist($organisme);
                $em->flush();
            }

            $jsonData = array(
                'message' => "Importation terminée",
            );
        }

        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/ImportInfo", name="importInfo")
     * @param Request $request
     * @return JsonResponse
     */
    public function importInfo(Request $request) : JsonResponse
    {
        $file = $request->files->get('file', 'r');

        if ($file == null){
            $jsonData = array(
                'message' => "Erreur, veuillez renseignez un fichier.",
            );
        }
        else{
            $oldMessage = ';';

            $deletedFormat = ',';

            $str=file_get_contents($file->getRealPath());

            $str=str_replace($oldMessage, $deletedFormat,$str);
            file_put_contents($file->getRealPath(), $str);
            $em = $this->doctrine->getManager();
            $csv = Reader::createFromPath($file->getRealPath());
            $csv->setHeaderOffset(0);
            $result = $csv->getRecords();

            foreach ( $result as $row){

                if ($row['sigle'] != ''){
                    $sigle = (new Sigle())
                        ->setSigle($row['sigle'])
                        ->setIntituleSigle($row['intituleSigle'])
                    ;
                    $em->persist($sigle);
                    $em->flush();
                }

                if ($row['grandComptes'] != ''){
                    $grandCompte = (new GrandsComptes())
                        ->setGrandsComptes($row['grandComptes'])
                    ;
                    $em->persist($grandCompte);
                    $em->flush();
                }

                if ($row['priorisation'] != ''){
                    $prio = (new Priorisation())
                        ->setPriorisation($row['priorisation'])
                    ;
                    $em->persist($prio);
                    $em->flush();
                }

                if ($row['natureAffaire'] != ''){
                    $nature = (new NatureAffaire())
                        ->setNatureAffaire($row['natureAffaire'])
                    ;
                    $em->persist($nature);
                    $em->flush();
                }

                if ($row['statutPdc'] != ''){
                    $statut = (new StatutPdc())
                        ->setStatutPdc($row['statutPdc'])
                    ;
                    $em->persist($statut);
                    $em->flush();
                }

                if ($row['etatPdc'] != ''){
                    $etat = (new EtatPdc())
                        ->setEtatPdc($row['etatPdc'])
                    ;
                    $em->persist($etat);
                    $em->flush();
                }
                if ($row['ClassementDl'] != ''){
                    $classement = (new ClassementDl())
                        ->setClassementDl($row['ClassementDl'])
                    ;
                    $em->persist($classement);
                    $em->flush();
                }

                if ($row['support'] != ''){
                    $Support = (new SupportInternetMilitaire())
                        ->setSupport($row['support'])
                    ;
                    $em->persist($Support);
                    $em->flush();
                }

                if ($row['users'] != ''){
                    $user = new Users();
                    $user->setUsername($row['users']);
                    $user->setPassword($this->hasher->hashPassword($user, $row['mdp']));
                    $role = [$row['role']];
                    $user->setRoles($role);
                    $em->persist($user);
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