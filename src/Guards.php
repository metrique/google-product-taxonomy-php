<?php

namespace Metrique\GoogleTaxonomy;

use Metrique\GoogleTaxonomy\Exception\DomainException;

class Guards
{
    public static function guardAgainstInvalidId(mixed $id): void
    {
        if (!preg_match('/^([0-9]+)$/', $id)) {
            throw new DomainException(sprintf('Not a valid id: %s', $id));
        }
    }

    public static function guardAgainstInvalidCategory(mixed $category): void
    {
        if (!is_string($category)) {
            throw new DomainException(sprintf('Not a valid category: %s', $category));
        }
    }
}
