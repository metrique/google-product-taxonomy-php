<?php

namespace Metrique\GoogleTaxonomy\Tests;

use Metrique\GoogleTaxonomy\Enum\TaxonomyEnum;
use Metrique\GoogleTaxonomy\Exception\OutOfBoundsException;
use Metrique\GoogleTaxonomy\Taxonomy;
use Metrique\GoogleTaxonomy\TaxonomyDataValidator;
use Metrique\GoogleTaxonomy\Tests\Stub\TaxonomyStub;

class TaxonomyTest extends TestCase
{
    public array $stub;
    public Taxonomy $taxonomy;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = new TaxonomyDataValidator();
        $this->stub = TaxonomyStub::toArray();
        $this->taxonomy = new Taxonomy(
            $this->validator->validate($this->stub)
        );
    }

    protected function randomStub(): array
    {
        return $this->stub[
            random_int(0, count($this->stub) - 1)
        ];
    }

    public function testLookupById()
    {
        foreach ([
            $this->randomStub(),
            $this->randomStub(),
            $this->randomStub(),
        ] as $stub) {
            $this->assertEquals(
                $stub,
                $this->taxonomy->lookupId($stub['id'])
            );
            $this->assertIsArray(
                $this->validator->validate([
                    $this->taxonomy->lookupId($stub['id']),
                ])
            );
        }
    }

    public function testInvalidLookupById()
    {
        $this->expectException(OutOfBoundsException::class);
        $this->taxonomy->lookupId(0);
    }

    public function testLookupByCategory()
    {
        foreach ([
            $this->randomStub(),
            $this->randomStub(),
            $this->randomStub(),
        ] as $stub) {
            $this->assertEquals(
                $stub,
                $this->taxonomy->lookupCategory($stub['category'])
            );
            $this->assertIsArray(
                $this->validator->validate([
                    $this->taxonomy->lookupCategory($stub['category']),
                ])
            );
        }
    }

    public function testInvalidLookupByCategory()
    {
        $this->expectException(OutOfBoundsException::class);
        $this->taxonomy->lookupCategory('');
    }

    public function testSearch()
    {
        foreach ([
            'Snazzlepops' => 0,
            'Bird Food' => 1,
            'Bird Supplies' => 10,
        ] as $term => $expectedCount) {
            $this->assertCount(
                $expectedCount,
                $this->taxonomy->search($term)
            );
        }
    }

    public function testCount()
    {
        $this->assertIsInt(
            $this->taxonomy->count()
        );

        $this->assertEquals(
            count($this->stub),
            $this->taxonomy->count()
        );
    }

    public function testAll()
    {
        $this->assertIsArray(
            $this->taxonomy->all()
        );

        $this->assertEquals(
            $this->stub,
            $this->taxonomy->all()
        );
    }

    public function testIterator(): void
    {
        $i = 0;
        foreach ($this->taxonomy->iterator(TaxonomyEnum::ID) as $key => $value) {
            ++$i;
        }

        $this->assertEquals(
            count($this->taxonomy),
            $i,
            'Compare iterated count to count($taxonomy).');
    }
}
