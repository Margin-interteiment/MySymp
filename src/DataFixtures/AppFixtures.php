<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
     
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setName("User$i");
            $user->setEmail("user$i@example.com");
            $user->setPassword("password$i"); 

            $manager->persist($user);
            $users[] = $user; 
        }

       
        $category = new Category();
        $category->setName("Nature");
        $manager->persist($category);

        
        for ($i = 1; $i <= 2; $i++) {
            $article = new Article();
            $article->setTitle("Назва статті № $i");
            $article->setDescription("Опис статті № $i");
            $article->setImage("image$i.jpg");
            $article->setCreatedAt(new \DateTime());
            $article->setUser($users[0]); 
            $article->setCategory($category);

            $manager->persist($article);
        }

        $manager->flush();
    }
}
