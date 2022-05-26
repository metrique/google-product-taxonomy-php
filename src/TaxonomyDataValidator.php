<?php

namespace Metrique\GoogleTaxonomy;

use DomainException;
use Metrique\GoogleTaxonomy\Enum\TaxonomyEnum;

class TaxonomyDataValidator
{
    public function validate(array $data): array
    {
        foreach ($data as $entry) {
            $this->assertEntryHasRequiredKeys($entry);
        }

        return $data;
    }

    private function assertEntryHasRequiredKeys(array $entry): void
    {
        if (!isset($entry[TaxonomyEnum::ID->value])) {
            throw new DomainException('Each data entry must have a valid id.');
        }

        Guards::guardAgainstInvalidId($entry[TaxonomyEnum::ID->value]);

        if (!isset($entry[TaxonomyEnum::CATEGORY->value])) {
            throw new DomainException('Each data entry must have a valid category key.');
        }

        Guards::guardAgainstInvalidCategory($entry[TaxonomyEnum::CATEGORY->value]);
    }
}
