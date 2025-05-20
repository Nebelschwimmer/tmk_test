<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Enum\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Domain\Entity\Article\Article;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $article = new Article(
                $faker->sentence(2),
                $faker->text(),
                Status::getRandom(),
                random_int(0, 1000000)
            );
            $manager->persist($article);
        }
        $manager->flush();
    }
}
