<?php

namespace Metrique\GoogleTaxonomy;

use Metrique\GoogleTaxonomy\Enum\TaxonomyEnum;

interface TaxonomyInterface
{
    public function lookup(TaxonomyEnum $key, string $value): array;

    public function lookupId(int $id): array;

    public function lookupCategory(string $category): array;

    public function search(string $query): array;
}
