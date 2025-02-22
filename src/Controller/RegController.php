<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Контролер для обробки реєстрації користувачів.
 */
class RegController extends AbstractController
{
    /**
     * Відображає сторінку реєстрації та створює форму реєстрації.
     *
     * @return Response Відповідь із відрендереним шаблоном.
     */
    #[Route('/Registration', name: 'Registration')]
    public function Registration(): Response
    {
        
        $formReg = $this->createFormBuilder()
            ->add('name', TextType::class, [
                'label' => "Ваше ім'я",
                'attr' => [
                    'placeholder' => 'Ваше ім\'я',
                    'class' => 'w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500'
                ]
            ])
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
                'label' => 'Зареєструватися',
                'attr' => [
                    'class' => 'w-full bg-black text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out hover:bg-blue-600 mt-6'
                ]
            ])
            ->getForm();

        
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
