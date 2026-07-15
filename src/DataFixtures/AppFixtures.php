<?php

namespace App\DataFixtures;

use App\Factory\ArticlesFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ArticlesFactory::createMany(10);
    }
}
