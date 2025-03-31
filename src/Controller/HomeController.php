<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Controller for the homepage.
 */
class HomeController extends AbstractController
{
    /**
     * Renders the homepage.
     * 
     * @return Response
     */
    #[Route('/', name: 'homepage')]
    public function home(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $session = $request->getSession();
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
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
