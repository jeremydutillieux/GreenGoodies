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
            'assets/articles/001.webp',
            'assets/articles/002.webp',
            'assets/articles/003.webp',
            'assets/articles/004.webp',
            'assets/articles/005.webp',
            'assets/articles/006.webp',
            'assets/articles/007.webp',
            'assets/articles/008.webp',
            'assets/articles/009.webp',
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
