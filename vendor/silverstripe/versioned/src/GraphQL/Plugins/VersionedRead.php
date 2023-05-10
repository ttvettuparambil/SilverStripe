<?php


namespace SilverStripe\Versioned\GraphQL\Plugins;

use SilverStripe\GraphQL\Schema\Field\ModelQuery;
use SilverStripe\GraphQL\Schema\Interfaces\ModelQueryPlugin;
use SilverStripe\GraphQL\Schema\Schema;
use SilverStripe\Versioned\GraphQL\Resolvers\VersionedResolver;
use SilverStripe\Versioned\Versioned;
use SilverStripe\View\ViewableData;

// GraphQL dependency is optional in versioned,
// and the following implementation relies on existence of this class (in GraphQL v4)
if (!interface_exists(ModelQueryPlugin::class)) {
    return;
}

class VersionedRead implements ModelQueryPlugin
{
    const IDENTIFIER = 'readVersion';

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    /**
     * @param ModelQuery $query
     * @param Schema $schema
     * @param array $config
     */
    public function apply(ModelQuery $query, Schema $schema, array $config = []): void
    {
        $class = $query->getModel()->getSourceClass();
        if (!ViewableData::has_extension($class, Versioned::class)) {
            return;
        }

        // The versioned argument only affects global reading state. Should not
        // apply to nested queries.
        $rootQuery = $schema->getQueryType()->getFieldByName($query->getName());
        if (!$rootQuery) {
            return;
        }

        $query->addResolverAfterware([VersionedResolver::class, 'resolveVersionedRead']);
        $query->addArg('versioning', 'VersionedInputType');
    }
}
