<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for the "About Blog" page.
 */
class AboutController extends AbstractController
{
    /**
     * Displays the "About Blog" page.
     *
     * @return Response
     */
    #[Route('/about', name: 'about')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $currentDate = new \DateTime();

        $articles = $articleRepository->findAll();

        return $this->render('about.html.twig', [
            'title' => 'About Page',
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
            'PopularTopics' => 'Popular topics',
            'AboutTitle' => 'About Blog',
            'AboutTime' => '4 minutes',
            'AboutTextOne' => 'Seamlessly syndicate cutting-edge architectures rather than collaborative collaboration and idea-sharing. Proactively incubate visionary interfaces whereas premium benefits. Seamlessly negotiate ubiquitous leadership skills rather than parallel ideas. Dramatically visualize superior interfaces for best-of-breed alignments. Synergistically formulate performance-based users through customized relationships. Interactively deliver cross-platform ROI via granular systems. Intrinsicly enhance effective initiatives vis-a-vis orthogonal outsourcing. Rapidiously monetize market-driven opportunities with multifunctional users. Collaboratively enhance visionary opportunities through revolutionary schemas. Progressively network just-in-time customer service without real-time scenarios.',
            'AboutTextTwo' => 'Synergistically drive e-business leadership with unique synergy. Compellingly seize market positioning ROI and bricks-and-clicks e-markets. Proactively myocardinate timely platforms through distributed ideas. Professionally optimize enabled core competencies for leading-edge sources. Professionally enhance stand-alone leadership with innovative synergy. Rapidiously generate backend experiences vis-a-vis long-term high-impact relationships. Authoritatively supply market-driven mindshare and bricks-and-clicks opportunities. Holisticly create diverse innovation through adaptive communities. Efficiently empower seamless meta-services with impactful opportunities. Distinctively transition virtual outsourcing with focused e-tailers.',
            'AboutTextThree' => '"Monotonectally seize superior mindshare rather than efficient technology."',
            'AboutTextFour' => 'Compellingly enhance seamless resources through competitive content. Continually actualize 24/365 alignments for resource-leveling platforms. Energistically enhance high standards in models and professional expertise. Intrinsicly iterate extensible metrics for prospective opportunities. Continually develop leading-edge experiences through quality e-services.',
            'AboutBlogAuthor' => 'By Margarita',
            'AboutBlogAuthorOfDesc' => 'text & writer',
            'articles' => $articles,
        ]);
    }
}
