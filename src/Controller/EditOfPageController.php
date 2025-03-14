<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Controller for editing an article.
 */
class EditOfPageController extends AbstractController
{
    #[Route('/article/{id}/edit', name: 'article_edit_form', methods: ['GET', 'POST'])]
    public function EditOfPage(int $id, Request $request, ArticleRepository $articleRepository, EntityManagerInterface $entityManager): Response
    {
        $articleOfPage = $articleRepository->find($id);

        $form = $this->createFormBuilder($articleOfPage)
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
                'required' => false,
                'attr' => ['class' => 'w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500'],
                'data_class' => null 
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Зберегти зміни',
                'attr' => ['class' => 'w-full bg-black text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out hover:bg-blue-600 mt-[60px]']
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('articles_images_directory'), 
                    $newFilename
                );

                $articleOfPage->setImage($newFilename);
            }

            $entityManager->flush(); 
        }

        return $this->render('article/edit.html.twig', [
            'article' => $articleOfPage,
            'form' => $form->createView(),
            'imageUrlForHeaderOne' => '/images/backForHeaderOne.png',
            'imageUrlForHeaderTwo' => '/images/backForHeaderTwo.png',
            'imageUrlForHeaderThree' => '/images/backForHeaderThree.png',
            'imageUrlForHeaderFour' => '/images/backForHeaderFour.png',
            'imageUrlForHeaderFive' => '/images/backForHeaderFive.png',
            'logo' => '/images/logo.png',
            'currentDate' => new \DateTime(),
            'homeLink' =>'Home', 
            'aboutLink' => 'About Blog',
            'createBlog' => 'Create Blog', 
            'adventureText' => 'ADVENTURE', 
            'titleOfHeader' =>  'Blog photorealistic rendering as real photos', 
            'MyTopics' => 'My topics',
            'PopularTopics' => 'Popular topics',
            'ImageForFashion' => '/images/fashionInfo.png',
            'fashionOfText' => 'FASHION', 
            'fashionOfTitle' => 'Blog photorealistic rendering as real photos', 
            'fashionOfParagraph' => 'Effectively enhance collaborative platforms with well-designed features. Ensure seamless content creation and engagement for a credible blogging experience.', 
            'IconLogout' => '/images/IconLogout.png',
        ]);
    }
}
