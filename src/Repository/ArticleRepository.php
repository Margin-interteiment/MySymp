<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $article, bool $flush = true): void
    {
        $this->getEntityManager()->persist($article);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?Article
    { 
        return $this->find($id);
    }

    public function update(Article $article, bool $flush = true): void
    {
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(Article $article, bool $flush = true): void
    {
        $this->getEntityManager()->remove($article);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllArticles(): array
    {
        return $this->findAll();
    }
}
