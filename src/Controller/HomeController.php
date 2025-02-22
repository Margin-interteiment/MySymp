<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Контролер для головної сторінки
 */
class HomeController extends AbstractController
{
    /**
     * Головна сторінка сайту
     * 
     * @return Response Відповідь з рендерингом шаблону
     */
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        
        $currentDate = new \DateTime();

        
        return $this->render('base.html.twig', [
            'title' => 'Blog Page',
            'imageUrlForHeaderOne' => '/images/backForHeaderOne.png',
            'imageUrlForHeaderTwo' => '/images/backForHeaderTwo.png',
            'imageUrlForHeaderThree' => '/images/backForHeaderThree.png',
            'imageUrlForHeaderFour' => '/images/backForHeaderFour.png',
            'imageUrlForHeaderFive' => '/images/backForHeaderFive.png',
            'logo' => '/images/logo.png',
            'currentDate' => $currentDate, 
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