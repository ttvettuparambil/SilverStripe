<?php
namespace DNADesign\Elemental\GraphQL\Types;

use SilverStripe\Dev\Deprecation;
use GraphQL\Type\Definition\CustomScalarType;
use SilverStripe\GraphQL\TypeCreator;

if (!class_exists(TypeCreator::class)) {
    return;
}
/**
 * Creates a "scalar" type that is a single dimension object - represented as an associative array on the PHP side.
 *
 * @deprecated 4.8.0 Use silverstripe/graphql:^4 functionality instead
 */
class ObjectType extends TypeCreator
{
    public function __construct()
    {
        Deprecation::notice('4.8.0', 'Use silverstripe/graphql:^4 functionality instead', Deprecation::SCOPE_CLASS);
        parent::__construct();
    }

    public function toType()
    {
        return new CustomScalarType([
            'name' => 'ObjectType',
            'serialize' => function ($value) {
                return (object) $value;
            },
            'parseValue' => function ($value) {
                return (array) $value;
            },
            'parseLiteral' => function ($ast) {
                return $ast->value;
            },
        ]);
    }
}
