<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Controller for handling user login.
 */
class LoginController extends AbstractController
{
    /**
     * Displays the login page and processes user input.
     *
     * @param Request 
     * @return Response 
     */
    #[Route('/login', name: 'login')]
   

    public function enter(Request $request): Response
    {
       
        $formEnter = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'label' => 'Ваш email',
                'attr' => [
                    'placeholder' => 'Ваш email',
                    'class' => 'w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Ваш пароль',
                'attr' => [
                    'placeholder' => 'Ваш пароль',
                    'class' => 'w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Війти',
                'attr' => [
                    'class' => 'w-full bg-black text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out hover:bg-blue-600 mt-6'
                ]
            ])
            ->getForm();

      
        $formEnter->handleRequest($request);

        
        if ($formEnter->isSubmitted() && $formEnter->isValid()) {
            return $this->redirectToRoute('homepage');
        }

       
        return $this->render('login.html.twig', [
            'BackRegister' => '/images/back-register.png',
            'BgFooter' => '/images/bg-footer.png',
            'Clouds' => '/images/clouds.png',
            'PhotoForRegistration' => '/images/ForRegister.png',
            'BackForm' => '/images/FormBack.png',
            'BackForm2' => '/images/FormBack2.png',
            'formEnter' => $formEnter->createView(),
        ]);
    }
}
