<?php

namespace Metrique\GoogleTaxonomy;

class TaxonomyImporter
{
    public string $content;

    public function __construct(
        public string $url = 'https://www.google.com/basepages/producttype/taxonomy-with-ids.en-US.txt',
        public string $output = 'taxonomy.txt',
        public string $tab = '    ',
        public string $temp = 'temp/',
        public string $token = "\n",
    ) {
        $this->content = file_get_contents($this->url);

        file_exists('temp') ?: mkdir('temp');

        file_put_contents(
            $this->temp.$this->output,
            $this->toString()
        );
    }

    public static function import(): self
    {
        return new TaxonomyImporter();
    }

    public function toString(): string
    {
        $tab = $this->tab;

        $output = "[\n";

        foreach ($this->toArray() as $taxonomy) {
            $output .= "{$this->tab}['id' => {$taxonomy['id']}, 'category' => '{$taxonomy['category']}'],\n";
        }

        $output .= ']';

        return $output;
    }

    public function toArray(): array
    {
        $array = [];
        $token = strtok($this->content, $this->token);

        while (false !== $token) {
            if (is_array($this->parseToken($token))) {
                $array[] = $this->parseToken($token);
            }

            $token = strtok($this->token);
        }

        return $array;
    }

    private function parseToken(string $token): bool|array
    {
        $token = explode(' - ', trim($token), 2);

        if (2 !== count($token)) {
            return false;
        }

        $taxonomy = [
            'id' => $token[0],
            'category' => addslashes($token[1]),
        ];

        try {
            (new TaxonomyDataValidator())->validate([$taxonomy]);
        } catch (\DomainException $th) {
            return false;
        }

        return $taxonomy;
    }
}
