<?php

namespace App\Factory;

use App\Entity\Articles;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Articles>
 */
final class ArticlesFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    #[\Override]
    public static function class(): string
    {
        return Articles::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'descriptionCourte' => self::faker()->text(40),
            'descriptionLongue' => self::faker()->text(180),
            'nom' => self::faker()->text(20),
            'photo' => self::faker()->randomElement([
            'assets/articles/001.jpg',
            'assets/articles/002.jpg',
            'assets/articles/003.jpg',
            'assets/articles/004.jpg',
            'assets/articles/005.jpg',
            'assets/articles/006.jpg',
            'assets/articles/007.jpg',
            'assets/articles/008.jpg',
            'assets/articles/009.jpg',
            ]),
            'prix' => self::faker()->randomFloat(2,0.01,99.99),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Articles $articles): void {})
        ;
    }
}
