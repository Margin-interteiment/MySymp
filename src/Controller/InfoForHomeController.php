<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for the homepage.
 */
class InfoForHomeController extends AbstractController
{
    /**
     * Renders the homepage.
     *
     * @return Response
     */
    #[Route('/', name: 'homepage')]
    public function home(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, Request $request): Response
    {
        $currentDate = new \DateTime();

        $categories = $categoryRepository->findAll();

        $categoryId = $request->query->get('category');
        if ($categoryId) {
            $articles = $articleRepository->findBy(['category' => $categoryId]);
        } else {
            $articles = $articleRepository->findAll();
        }

        return $this->render('infoForHome.html.twig', [
            'title' => 'Blog Page',
            'imageUrlForHeaderOne' => '/images/backForHeaderOne.png',
            'imageUrlForHeaderTwo' => '/images/backForHeaderTwo.png',
            'imageUrlForHeaderThree' => '/images/backForHeaderThree.png',
            'imageUrlForHeaderFour' => '/images/backForHeaderFour.png',
            'imageUrlForHeaderFive' => '/images/backForHeaderFive.png',
            'logo' => '/images/logo.png',
            'currentDate' => $currentDate,
            'homeLink' => 'Home',
            'aboutLink' => 'About Blog',
            'createBlog' => 'Create Blog',
            'adventureText' => 'ADVENTURE',
            'titleOfHeader' => 'Blog photorealistic rendering as real photos',
            'MyTopics' => 'My topics',
            'PopularTopics' => 'Popular topics',
            'ImageForFashion' => '/images/fashionInfo.png',
            'fashionOfText' => 'FASHION',
            'fashionOfTitle' => 'Blog photorealistic rendering as real photos',
            'fashionOfParagraph' => 'Effectively enhance collaborative platforms with well-designed features. Ensure seamless content creation and engagement for a credible blogging experience.',
            'IconLogout' => '/images/IconLogout.png',
            'articles' => $articles,
            'categories' => $categories,
            'dots' => '/images/dots.png',
        ]);
    }

    /**
     * Redirects to the edit page of a specific article.
     * 
     * @return Response
     */
    #[Route('/article/edit/{id}', name: 'article_edit', methods: ['GET'])]
    public function edit(int $id): Response
    {
        return $this->redirectToRoute('article_edit_form', ['id' => $id]);
    }

    /**
     * Deletes an article by ID.
     * 
     * @return JsonResponse
     */
    #[Route('/article/delete', name: 'article_delete', methods: ['POST'])]
    public function deleteArticle(Request $request, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $articleId = $data['id'] ?? null;

        if (!$articleId) {
            return new JsonResponse(['error' => 'Нема потрібного ID'], 400);
        }

        $article = $articleRepository->find($articleId);
        if (!$article) {
            return new JsonResponse(['error' => 'Статя не знайдена...'], 404);
        }

        $entityManager->remove($article);
        $entityManager->flush();

        return new JsonResponse(['success' => 'Статя видалена']);
    }
}
