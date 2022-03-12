<?php

namespace App\Controller\administration\contact;

use App\Entity\Contact;
use App\Entity\Contactbdd;
use App\Entity\ContactCirisi;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\CirisiRepository;
use App\Repository\ContactbddRepository;
use App\Repository\ContactcirisiRepository;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use League\Csv\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{

    private ContactRepository $ContactRepository;
    private ContactcirisiRepository $ContactCirisiRepository;
    private ContactbddRepository $contactbddRepository;
    private ManagerRegistry $doctrine;
    private CirisiRepository $cirisiRepository;
    private BasesDeDefenseRepository $basesDeDefenseRepository;

    public function __construct(ContactRepository $ContactRepository, ContactcirisiRepository $ContactCirisiRepository, ContactbddRepository $contactbddRepository, ManagerRegistry $doctrine, CirisiRepository $cirisiRepository, BasesDeDefenseRepository $basesDeDefenseRepository)
    {
        $this->ContactRepository = $ContactRepository;
        $this->ContactCirisiRepository = $ContactCirisiRepository;
        $this->contactbddRepository = $contactbddRepository;
        $this->doctrine = $doctrine;
        $this->cirisiRepository = $cirisiRepository;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
    }

    /**
     * @Route ("/Admin/AdminContacts", name="Admin_contacts")
     * @return Response
     */
    public function index(): Response
    {
        $Contacts = $this->ContactRepository->findAll();
        $i = 0;
        foreach ($Contacts as $contact){
            if ($this->contactbddRepository->find($contact->getIdContact()) or $this->ContactCirisiRepository->find($contact->getIdContact())){
                unset($Contacts[$i]);
                $Contacts = array_values($Contacts);
            }
        }
        return $this->render('administration/Contact/AdminContacts.html.twig', [
            'nbContact' => count($Contacts),
            'nbContactCirisi' => count($this->ContactCirisiRepository->findAll()),
            'nbContactBdd' => count($this->contactbddRepository->findAll()),
        ]);
    }

    /**
     * @Route ("/Admin/ImportContact", name="importContact")
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
            $em = $this->doctrine->getManager();
            $csv = Reader::createFromPath($file->getRealPath());
            $csv->setHeaderOffset(0);
            $result = $csv->getRecords();

            foreach ( $result as $row){

                $contact = (new Contact())
                    ->setIntituleContact($row['Intitule'])
                    ->setEmailContact($row['Email'])
                    ->setNomContact($row['Nom'])
                    ->setPrenomContact($row['Prenom'])
                    ->setTelContact($row['TPH'])
                ;
                $em->persist($contact);
                $em->flush();

                if ($row['Cirisi'] != ''){
                    $contactCirisi = (new ContactCirisi())
                        ->setIntituleContact($row['Intitule'])
                        ->setEmailContact($row['Email'])
                        ->setNomContact($row['Nom'])
                        ->setPrenomContact($row['Prenom'])
                        ->setTelContact($row['TPH'])
                        ->setIdCirisi(
                            $this->cirisiRepository->findOneBy([
                                'cirisi' => $row['Cirisi']
                            ])
                        )
                        ->setIdContact($contact);
                    ;
                    $em->persist($contactCirisi);
                    $em->flush();
                }

                if ($row['Bdd'] != ''){
                    $contactBdd = (new Contactbdd())
                        ->setIntituleContact($row['Intitule'])
                        ->setEmailContact($row['Email'])
                        ->setNomContact($row['Nom'])
                        ->setPrenomContact($row['Prenom'])
                        ->setTelContact($row['TPH'])
                        ->setIdBaseDefense(
                            $this->basesDeDefenseRepository->findOneBy([
                                'baseDefense' => $row['Bdd']
                            ])
                        )
                        ->setIdContact($contact);
                    ;
                    $em->persist($contactBdd);
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
