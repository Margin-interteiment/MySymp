<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowController extends AbstractController
{
    #[Route('/article/{id}', name: 'article_show')]
    public function show(int $id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Статя не знайдена...');
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'imageUrlForHeaderOne' => '/images/backForHeaderOne.png',
            'imageUrlForHeaderTwo' => '/images/backForHeaderTwo.png',
            'imageUrlForHeaderThree' => '/images/backForHeaderThree.png',
            'imageUrlForHeaderFour' => '/images/backForHeaderFour.png',
            'imageUrlForHeaderFive' => '/images/backForHeaderFive.png',
            'logo' => '/images/logo.png',
            'currentDate' => new \DateTime(),
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
        ]);
    }
}
