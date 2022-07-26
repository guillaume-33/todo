<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{


    //methode permettant de créer un utilisateur et de l'enregister dans la basse de bonnes.
    // le mot de passe est protégé par le UserPasswordHasher, qui "crypte' le mot de passe.
    /**
     * @Route("/inscription", name="user_inscription")
     */
    public function incription(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher){
        $user= new User();
        $user->setRoles(['ROLES_USER']);

        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $userPassword =$form->get('password')->getData();
                $cryptPassword=$userPasswordHasher->hashPassword($user, $userPassword);

                $user->setPassword($cryptPassword);

                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Inscription Réussie');
                return $this->redirectToRoute('home');
            }
            return $this->render('user_inscription.html.twig',[
                                'form'=>$form->createView()
            ]);
    }
}