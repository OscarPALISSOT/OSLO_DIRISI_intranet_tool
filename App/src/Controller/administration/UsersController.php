<?php

namespace App\Controller\administration;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController {

    private ManagerRegistry $ManagerRegistry;
    private UsersRepository $usersRepository;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UsersRepository $usersRepository, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher)
    {
        $this->ManagerRegistry = $doctrine;
        $this->usersRepository = $usersRepository;
        $this->hasher = $hasher;
    }

    /**
     * @Route ("/Admin/Users", name="Admin_Users")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/users.html.twig', [
            'Users' => $this->usersRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Admin/NewUser", name="Admin_User_New")
     * @param Request $request
     * @return Response
     */
    public function newUsers(Request $request) : Response{
        $NewUsers = new Users();
        $Users = $request->request->get('User');
        $pwd = $request->request->get('pwd');
        $roleRequest = $request->request->get('role');
        switch ($roleRequest){
            case 'admin':
                $role = ['ROLE_ADMIN'];
                break;
            case 'brc':
                $role = ['ROLE_BRC'];
                break;
            case 'bpt':
                $role = ['ROLE_BPT'];
                break;
            case 'bcs':
                $role = ['ROLE_BCS'];
                break;
        }
        $NewUsers->setUser($Users);
        $NewUsers->setPassword($this->hasher->hashPassword($NewUsers, $pwd));
        $NewUsers->setRoles($role);
        if ($this->isCsrfTokenValid("CreateUser", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewUsers);
            $em->flush();
        }
        $jsonData = array(
            'Users' => $Users,
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteRouteursFederateursDeZone", name="Admin_User_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteUsers(Request $request): Response{
        $Userss = $this->UsersRepository->findAll();
        $nbUsers = count($Userss);
        $ChekedId = array();
        for ( $i = 0; $i < $nbUsers; $i++){
            if ($request->request->get('idChecked' . $Userss[$i]->getIdUsers())){
                $ChekedId[] = $Userss[$i]->getIdUsers();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'Users' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $UsersToDelete = $this->UsersRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteUsers", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($UsersToDelete);
                    $em->flush();
                }

            }
            $jsonData = array(
                'Users' => "Suppression terminée",
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/EditRouteursFederateursDeZone/{id}", name="Admin_User_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditUsers(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Users = $this->UsersRepository->find($id);
        $UsersName = $request->request->get('UsersEdit');
        $Users->setUsers($UsersName);

        if ($this->isCsrfTokenValid("EditUsers", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Users);
            $em->flush();
        }

        $jsonData = array(
            'Users' => $Users->getUsers(),
        );

        return $this->json($jsonData, 200);
    }
}