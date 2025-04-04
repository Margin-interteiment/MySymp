<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for creating a new blog.
 */
class CreateBlogController extends AbstractController
{
    /**
     * Displays the form for creating a blog and processes the submitted data.
     * 
     * @return Response
     */
    #[Route('/createBlog', name: 'createBlog')]
    public function createBlog(Request $request, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): Response
    {
        $article = new Article();

        $categories = $entityManager->getRepository(Category::class)->findAll();

        $form = $this
            ->createFormBuilder($article)
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
            ->add('category', EntityType::class, [
                'label' => 'Категорія',
                'class' => Category::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'attr' => ['class' => 'w-[300px] p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Створити',
                'attr' => ['class' => 'w-full bg-black text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out hover:bg-blue-600 mt-[60px]']
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $article->getCategory();

            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('articles_images_directory'),
                    $newFilename
                );
                $article->setImage($newFilename);
            }

            $article->setCreatedAt(new \DateTime());
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

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
            'titleOfHeader' => 'Blog photorealistic rendering as real photos',
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
