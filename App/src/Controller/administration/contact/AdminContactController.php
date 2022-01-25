<?php

namespace App\Controller\administration\contact;

use App\Repository\ContactbddRepository;
use App\Repository\ContactCirisiRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{

    private ContactRepository $ContactRepository;
    private ContactCirisiRepository $ContactCirisiRepository;
    private ContactbddRepository $contactbddRepository;

    public function __construct(ContactRepository $ContactRepository, ContactCirisiRepository $ContactCirisiRepository, ContactbddRepository $contactbddRepository)
    {
        $this->ContactRepository = $ContactRepository;
        $this->ContactCirisiRepository = $ContactCirisiRepository;
        $this->contactbddRepository = $contactbddRepository;
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
}
