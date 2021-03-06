<?php

namespace App\Factory;

use App\Entity\Quote;
use App\Repository\QuoteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Quote>
 *
 * @method static      Quote|Proxy createOne(array $attributes = [])
 * @method static      Quote[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static      Quote|Proxy find(object|array|mixed $criteria)
 * @method static      Quote|Proxy findOrCreate(array $attributes)
 * @method static      Quote|Proxy first(string $sortedField = 'id')
 * @method static      Quote|Proxy last(string $sortedField = 'id')
 * @method static      Quote|Proxy random(array $attributes = [])
 * @method static      Quote|Proxy randomOrCreate(array $attributes = [])
 * @method static      Quote[]|Proxy[] all()
 * @method static      Quote[]|Proxy[] findBy(array $attributes)
 * @method static      Quote[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static      Quote[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static      QuoteRepository|RepositoryProxy repository()
 * @method Quote|Proxy create(array|callable $attributes = [])
 */
final class QuoteFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'content' => self::faker()->text(),
            'meta' => self::faker()->sentence(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Quote $quote) {})
        ;
    }

    protected static function getClass(): string
    {
        return Quote::class;
    }
}
