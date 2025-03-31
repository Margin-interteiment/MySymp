<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for user registration handling.
 */
class RegController extends AbstractController
{
    /**
     * Displays the registration page and creates the registration form.
     *
     * @return Response
     */
    #[Route('/registration', name: 'registration')]
    public function Registration(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $formReg = $this->createForm(UserRegistrationType::class, $user);
        $formReg->handleRequest($request);

        if ($formReg->isSubmitted() && $formReg->isValid()) {
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser) {
                $this->addFlash('error', 'This email already exists in database;');
                return $this->redirectToRoute('registration');
            }

            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('reg.html.twig', [
            'BackRegister' => '/images/back-register.png',
            'BgFooter' => '/images/bg-footer.png',
            'Clouds' => '/images/clouds.png',
            'PhotoForRegistration' => '/images/ForRegister.png',
            'BackForm' => '/images/FormBack.png',
            'BackForm2' => '/images/FormBack2.png',
            'formReg' => $formReg->createView(),
        ]);
    }
}
