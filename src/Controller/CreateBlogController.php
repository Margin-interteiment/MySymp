<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Контролер для створення нового блогу.
 */
class CreateBlogController extends AbstractController
{
    /**
     * Відображає форму для створення блогу та обробляє введені дані.
     *
     * @return Response Відповідь із відрендереним шаблоном.
     */
    #[Route('/createBlog', name: 'createBlog')]
    public function createBlog(Request $request): Response
    {
       
        $form = $this->createFormBuilder()
            ->add('title', TextType::class, [
                'label' => 'Назва',
                'attr' => ['placeholder' => 'Назва блогу', 'class' => 'w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Опис',
                'attr' => ['placeholder' => 'Опис блогу', 'rows' => 4, 'class' => 'w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('image', FileType::class, [
                'label' => 'Завантажити зображення',
                'attr' => ['class' => 'w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Створити',
                'attr' => ['class' => 'w-full bg-black text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out hover:bg-blue-600 mt-[60px]']
            ])
            ->getForm();

      
        return $this->render('createBlog.html.twig', [
            'title' => 'Створити новий блог',
            'imageUrlForHeaderOne' => '/images/backForHeaderOne.png',
            'imageUrlForHeaderTwo' => '/images/backForHeaderTwo.png',
            'imageUrlForHeaderThree' => '/images/backForHeaderThree.png',
            'imageUrlForHeaderFour' => '/images/backForHeaderFour.png',
            'imageUrlForHeaderFive' => '/images/backForHeaderFive.png',
            'logo' => '/images/logo.png',
            'currentDate' => new \DateTime(),
            'homeLink' => 'Home',
            'aboutLink' => 'About Blog',
            'adventureText' => 'ADVENTURE',
            'titleOfHeader' => 'Richird Norton photorealistic rendering as real photos',
            'createBlogTitle' => 'Створити новий блог',
            'createBlogName' => 'Назва',
            'createBlogDesc' => 'Опис',
            'createBlogUpload' => 'Завантажити зображення',
            'createBlogBtn' => 'Створити',
            'createBlog' => 'Create Blog',
            'form' => $form->createView(),
        ]);
    }
}
