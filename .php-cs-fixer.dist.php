<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;
$config = new PhpCsFixer\Config('google-taxonomy-php', 'google-taxonomy-php style guide');

$config
    ->setRules([
        // default
        '@PSR1' => true,
        '@PSR2' => true,
        '@PSR12' => true,
        '@Symfony' => true,
        'yoda_style' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;

return $config;