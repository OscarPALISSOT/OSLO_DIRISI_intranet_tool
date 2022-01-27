<?php

namespace App\Controller\contacts;

use App\Repository\ContactbddRepository;
use App\Repository\ContactCirisiRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {

    private ContactRepository $contactRepository;
    private ContactCirisiRepository $contactCirisiRepository;
    private ContactbddRepository $contactbddRepository;

    public function __construct(ContactRepository $contactRepository, ContactCirisiRepository $contactCirisiRepository, ContactbddRepository $contactbddRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->contactCirisiRepository = $contactCirisiRepository;
        $this->contactbddRepository = $contactbddRepository;
    }


    /**
     * @Route ("/Contact", name="contact")
     * @return Response
     */
    public function index() : Response{
        $Contacts = $this->contactRepository->findAll();
        $i = 0;
        foreach ($Contacts as $contact){
            if ($this->contactbddRepository->find($contact->getIdContact()) or $this->contactCirisiRepository->find($contact->getIdContact())){
                unset($Contacts[$i]);
                $Contacts = array_values($Contacts);
            }
        }
        return $this->render('contacts/contact.html.twig', [
            'contacts' => $Contacts,
        ]);
    }

    /**
     * @Route ("/ContactCirisi", name="contactCirisi")
     * @return Response
     */
    public function indexCirisi() : Response{
        return $this->render('contacts/contactCirisi.html.twig', [
            'contacts' => $this->contactCirisiRepository->findAllWithCirisi(),
        ]);
    }

    /**
     * @Route ("/ContactBdd", name="contactBdd")
     * @return Response
     */
    public function indexBdd() : Response{
        return $this->render('contacts/contactBdd.html.twig', [
            'contacts' => $this->contactbddRepository->findAllWithBdd(),
        ]);
    }


}