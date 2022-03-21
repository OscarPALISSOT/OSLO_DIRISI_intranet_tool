<?php

namespace App\Controller\administration;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController {

    private $ManagerRegistry;
    private $usersRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $hasher;

    public function __construct(UsersRepository $usersRepository, ManagerRegistry $doctrine, UserPasswordEncoderInterface $hasher)
    {
        $this->ManagerRegistry = $doctrine;
        $this->usersRepository = $usersRepository;
        $this->hasher = $hasher;
    }

    /**
     * @Route ("/Admin/Users", name="Admin_Users")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $Users = $paginator->paginate(
            $this->usersRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/users.html.twig', [
            'Users' => $Users,
        ]);
    }

    /**
     * @Route ("/Admin/NewUser", name="Admin_User_New")
     * @param Request $request
     * @return Response
     */
    public function newUsers(Request $request) : Response{
        $NewUsers = new Users();
        $UserName = $request->request->get('User');
        $pwd = $request->request->get('pwd');
        $roleRequest = $request->request->get('role');
        switch ($roleRequest){
            case 'admin':
                $role = ['ROLE_ADMIN'];
                break;
            case 'BRC':
                $role = ['BRC'];
                break;
            case 'BPT':
                $role = ['BPT'];
                break;
            case 'BCS':
                $role = ['BCS'];
                break;
        }
        $NewUsers->setUser($UserName);
        $NewUsers->setPassword($this->hasher->hashPassword($NewUsers, $pwd));
        $NewUsers->setRoles($role);
        if ($this->isCsrfTokenValid("CreateUser", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewUsers);
            $em->flush();
        }
        $jsonData = array(
            'message' => 'Utilisateur ajouté',
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteUsers", name="Admin_User_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteUsers(Request $request): Response{
        $Users = $this->usersRepository->findAll();
        $nbUsers = count($Users);
        $ChekedId = array();
        for ( $i = 0; $i < $nbUsers; $i++){
            if ($request->request->get('idChecked' . $Users[$i]->getIdUser())){
                $ChekedId[] = $Users[$i]->getIdUser();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $UsersToDelete = $this->usersRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteUser", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($UsersToDelete);
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
     * @Route ("/Admin/EditUser/{id}", name="Admin_User_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditUsers(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $User = $this->usersRepository->find($id);
        $UserName = $request->request->get('UserEdit');
        $roleRequest = $request->request->get('roleEdit');
        switch ($roleRequest){
            case 'admin':
                $role = ['ROLE_ADMIN'];
                break;
            case 'BRC':
                $role = ['BRC'];
                break;
            case 'BPT':
                $role = ['BPT'];
                break;
            case 'BCS':
                $role = ['BCS'];
                break;
        }
        $User->setUsername($UserName);
        $User->setRoles($role);

        if ($this->isCsrfTokenValid("EditUser", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($User);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Utilisateur modifié',
        );

        return $this->json($jsonData, 200);
    }
}